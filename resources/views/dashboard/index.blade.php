@extends('layouts.master')
@section('css')
    <!-- page specific plugin styles -->

   {{-- <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}" />
    <![endif]-->


    <!-- ace settings handler -->
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{ asset('assets/js/html5shiv.min.js')  }}"></script>
    <script src="{{ asset('assets/js/respond.min.js')  }}"></script>
    <![endif]-->
--}}
    <!-- inline styles related to this page -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

    @endsection
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                @include('layouts.includes.template_setting')
                <div class="page-header">
                    @include('includes.flash_messages')
                    @include('dashboard.includes.notice')
                    @include('dashboard.includes.buttons')
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">

                    <!-- PAGE CONTENT BEGINS -->
                        {{--Chart Begans--}}
                            @role(['super-admin','admin','account'])
                                <div class="row">
                                    <div class="col-md-10">
                                        <div>{!! $data['feeSalaryChart']->container() !!}</div>
                                    </div>
                                    <div class="col-md-2">
                                        <div>{!! $data['feeCompare']->container() !!}</div>
                                    </div>
                                    <div class="col-md-12">
                                        <div>{!! $data['transactionChart']->container() !!}</div>
                                    </div>
                                </div>
                            @endrole
                        {{--chart end--}}

                        <div class="row">
                            <div class="col-sm-9">
                                @role(['super-admin','admin','account'])
                                    @include('dashboard.includes.account')
                                @endrole
                                @role(['super-admin','admin','library'])
                                    @include('dashboard.includes.library')
                                @endrole
                                @role(['super-admin','admin'])
                                @include('dashboard.includes.attendence')
                                @endrole
                            </div><!-- /.col -->
                            <div class="col-sm-3">
                                @include('dashboard.includes.summary')
                            </div><!-- /.col -->
                            {{--Faculty wise Student Status Summary--}}
                        </div>

        </div><!-- /.row -->
        <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
</div><!-- /.row -->
</div><!-- /.page-content -->
</div>
</div><!-- /.main-content -->
@endsection
@section('js')
<!-- page specific plugin scripts -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js" charset="utf-8"></script>
 {!! $data['feeSalaryChart']->script() !!}
 {!! $data['feeCompare']->script() !!}
 {!! $data['transactionChart']->script() !!}
@endsection