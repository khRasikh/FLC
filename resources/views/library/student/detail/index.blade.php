@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />--}}
    <link rel="stylesheet" href="{{ asset('assets/css/select2.min.css') }}" />
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
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                    @include('library.includes.buttons')
                        <!-- PAGE CONTENT BEGINS -->
                        <hr class="hr-6">
                        @include('includes.flash_messages')

                        @include($view_path.'.detail.includes.indicator')

                        <div class="space-2"></div>

                        <div id="user-profile-2" class="user-profile">
                            <div class="tabbable  ">
                                <ul class="nav nav-tabs  padding-18 hidden-print ">
                                    <li class="active">
                                        <a data-toggle="tab" href="#profile">
                                            <i class="green ace-icon fa fa-user bigger-140"></i>
                                            PROFILE
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#taken">
                                            <i class="purple ace-icon fa fa-book bigger-140"></i>
                                            BOOK TAKEN
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#issue">
                                            <i class="pink ace-icon fa fa-arrow-right bigger-140"></i>
                                            ISSUE BOOK
                                        </a>
                                    </li>

                                    <li>
                                        <a data-toggle="tab" href="#history">
                                            <i class="green ace-icon fa fa-history bigger-140"></i>
                                            HISTORY
                                        </a>
                                    </li>

                                </ul>

                                <div class="tab-content no-border padding-24">
                                    <div id="profile" class="tab-pane  in active">
                                        @include($view_path.'.detail.includes.profile')
                                    </div><!-- /#home -->

                                    <div id="history" class="tab-pane">
                                        @include($view_path.'.detail.includes.book_history')
                                    </div><!-- /#Library -->

                                    <div id="taken" class="tab-pane">
                                        @include($view_path.'.detail.includes.book_taken')
                                    </div>

                                    <div id="issue" class="tab-pane ">
                                        @include($view_path.'.detail.includes.issue')

                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
   {{-- @include('includes.scripts.jquery_validation_scripts')--}}
    <!-- inline scripts related to this page -->
   @include('library.includes.issueBook_Script')

@endsection