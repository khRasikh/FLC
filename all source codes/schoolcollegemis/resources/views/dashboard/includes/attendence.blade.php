<div class="widget-box transparent" id="recent-box">
    <div class="widget-header">
        <h4 class="widget-title lighter smaller">
            <i class="ace-icon fa fa-calendar blue"></i>Attendence
        </h4>

        <div class="widget-toolbar no-border">
            <ul class="nav nav-tabs" id="recent-tab">
                <li class="active">
                    <a data-toggle="tab" href="#booklet-tab">Booklet</a>
                </li>

                {{--<li>
                    <a data-toggle="tab" href="#studentAttendence-tab">Student Attendence</a>
                </li>

                <li>
                    <a data-toggle="tab" href="#staffAttendence-tab">Staff Attendence</a>
                </li>--}}
            </ul>
        </div>
    </div>

    <div class="widget-body">
        <div class="widget-main padding-4">
            <div class="tab-content padding-8">
                <div id="booklet-tab" class="tab-pane active">
                    @include('dashboard.includes.attendance.booklet')
                </div>

               {{-- <div id="studentAttendence-tab" class="tab-pane">
                    @include('dashboard.includes.account.payroll')
                </div>

                <div id="staffAttendence-tab" class="tab-pane">
                    @include('dashboard.includes.account.transaction')
                </div><!-- /.#member-tab -->--}}
            </div>
        </div><!-- /.widget-main -->
    </div><!-- /.widget-body -->
</div><!-- /.widget-box -->