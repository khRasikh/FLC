@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            {{ $panel }} Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                    @if (isset($data['row']) && $data['row']->count() > 0)
                        @include($base_route.'.includes.edit')
                    @else
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                <div class="hr hr-18 dotted hr-double"></div>
                            </div>
                        {!! Form::open(['route' => $base_route.'.store', 'id' => 'tr_add_form']) !!}
                            @include($base_route.'.includes.add')
                        {!! Form::close() !!}
                    @endif
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {
            /*Change Field Value on Capital Letter When Keyup*/
            $(function() {
                $('.upper').keyup(function() {
                    this.value = this.value.toUpperCase();
                });
            });
            /*end capital function*/

            $('#load-tr-html').click(function () {

                $.ajax({
                    type: 'POST',
                    url: '{{ route('account.transaction.tr-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                           /* toastr.error(data.message, "error");*/
                        } else {

                            $('#transaction_wrapper').append(data.html);
                            $(document).find('option[value="0"]').attr("value", "");
                        }
                    }
                });

            });

            /*Add Transaction */

            $('#tr-add-btn').click(function () {
                var tr_head = $('select[name="tr_head[]"]').val();

                if(tr_head !== undefined) {
                    var form = $('#tr_add_form');
                }else{
                    toastr.warning("Please, Add At Least One Transaction.");
                    return false;
                }


            });
            /*Add Transaction End*/

        });


    </script>

    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.table_tr_sort')
    @include('includes.scripts.datepicker_script')
@endsection