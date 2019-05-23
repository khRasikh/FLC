@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    <h1>
                        Student
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Registration Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                    @include('includes.flash_messages')
                    @include('includes.validation_error_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="space-2"></div>

                        <div id="user-profile-2" class="user-profile">
                            <div class="tabbable  ">
                                    <ul class="nav nav-tabs  padding-18 hidden-print ">
                                        <li class="active">
                                            <a data-toggle="tab" href="#profile">
                                                <i class="green ace-icon fa fa-user bigger-140"></i>
                                                Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a data-toggle="tab" href="#academicInfo">
                                                <i class="green ace-icon fa fa-university bigger-140"></i>
                                                Academic
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#fees">
                                                <i class="orange ace-icon fa fa-calculator bigger-140"></i>
                                                Fees
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#library">
                                                <i class="purple ace-icon fa fa-book bigger-140"></i>
                                                Library
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#attendance">
                                                <i class="blue ace-icon fa fa-calendar bigger-140"></i>
                                                Attendance
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#examscore">
                                                <i class="blue ace-icon fa fa-certificate bigger-140"></i>
                                                Exam
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#hostel">
                                                <i class="blue ace-icon fa fa-bed bigger-140"></i>
                                                Hostel
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#transport">
                                                <i class="blue ace-icon fa fa-car bigger-140"></i>
                                                Transport
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#documents">
                                                <i class="pink ace-icon fa fa-files-o bigger-140"></i>
                                                Docs
                                            </a>
                                        </li>

                                        <li>
                                            <a data-toggle="tab" href="#notes">
                                                <i class="red ace-icon fa fa-sticky-note-o bigger-140"></i>
                                                Notes
                                            </a>
                                        </li>
                                        @ability('super-admin', 'user-add')
                                        <li>
                                            <a data-toggle="tab" href="#login-access">
                                                <i class="red ace-icon fa fa-key bigger-140"></i>
                                                Login Access
                                            </a>
                                        </li>
                                        @endability

                                    </ul>

                                    <div class="tab-content no-border padding-24">
                                        <div id="profile" class="tab-pane in active">
                                           @include($view_path.'.detail.includes.profile')
                                        </div><!-- /#home -->

                                        <div id="academicInfo" class="tab-pane">
                                            @include($view_path.'.detail.includes.academicInfo')
                                        </div><!-- /#AcademicInfo -->

                                        <div id="fees" class="tab-pane">
                                            @include($view_path.'.detail.includes.fees')
                                        </div><!-- /#home -->

                                        <div id="library" class="tab-pane">
                                            @include($view_path.'.detail.includes.library')
                                        </div><!-- /#Library -->

                                        <div id="attendance" class="tab-pane">
                                            @include($view_path.'.detail.includes.attendance')
                                        </div><!-- /#attendence -->

                                        <div id="examscore" class="tab-pane">
                                            @include($view_path.'.detail.includes.examscore')
                                        </div><!-- /#examscore -->

                                        <div id="hostel" class="tab-pane">
                                            @include($view_path.'.detail.includes.hostel')
                                        </div><!-- /#Hostel -->

                                        <div id="transport" class="tab-pane">
                                            @include($view_path.'.detail.includes.transport')
                                        </div><!-- /#Transport -->

                                        <div id="documents" class="tab-pane">
                                            @include($view_path.'.detail.includes.documents')
                                        </div><!-- /#Documents -->

                                        <div id="notes" class="tab-pane">
                                            @include($view_path.'.detail.includes.notes')
                                        </div><!-- /#Notes -->
                                        @ability('super-admin', 'user-add')
                                        <div id="login-access" class="tab-pane">
                                            @include($view_path.'.detail.includes.login-access')
                                        </div><!-- /#Login Detail -->
                                        @endability


                                    </div>
                            </div>

                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    </div>
@endsection

@section('js')
    <!-- inline scripts related to this page -->
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.paymentgateway.khalti')

@endsection