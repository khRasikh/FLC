@include('user-staff.layouts.includes.header')

    <body class="no-skin">

        @include('user-staff.layouts.includes.nav')

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try{ace.settings.loadState('main-container')}catch(e){}
            </script>

           @include('user-staff.layouts.includes.menu')

            @yield('content')

            @include('user-staff.layouts.includes.footer')

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- page specific plugin scripts -->
        <!-- ace scripts -->
        <script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
        <script src="{{ asset('assets/js/ace.min.js') }}"></script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                var $sidebar = $('.sidebar').eq(0);
                if( !$sidebar.hasClass('h-sidebar') ) return;

                $(document).on('settings.ace.top_menu' , function(ev, event_name, fixed) {
                    if( event_name !== 'sidebar_fixed' ) return;

                    var sidebar = $sidebar.get(0);
                    var $window = $(window);

                    //return if sidebar is not fixed or in mobile view mode
                    var sidebar_vars = $sidebar.ace_sidebar('vars');
                    if( !fixed || ( sidebar_vars['mobile_view'] || sidebar_vars['collapsible'] ) ) {
                        $sidebar.removeClass('lower-highlight');
                        //restore original, default marginTop
                        sidebar.style.marginTop = '';

                        $window.off('scroll.ace.top_menu')
                        return;
                    }


                    var done = false;
                    $window.on('scroll.ace.top_menu', function(e) {

                        var scroll = $window.scrollTop();
                        scroll = parseInt(scroll / 4);//move the menu up 1px for every 4px of document scrolling
                        if (scroll > 17) scroll = 17;


                        if (scroll > 16) {
                            if(!done) {
                                $sidebar.addClass('lower-highlight');
                                done = true;
                            }
                        }
                        else {
                            if(done) {
                                $sidebar.removeClass('lower-highlight');
                                done = false;
                            }
                        }

                        sidebar.style['marginTop'] = (17-scroll)+'px';
                    }).triggerHandler('scroll.ace.top_menu');

                }).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);

                $(window).on('resize.ace.top_menu', function() {
                    $(document).triggerHandler('settings.ace.top_menu', ['sidebar_fixed' , $sidebar.hasClass('sidebar-fixed')]);
                });


            });
        </script>

        @yield('js')

    </body>
</html>
