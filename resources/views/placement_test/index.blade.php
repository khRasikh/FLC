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
            @if(session()->has('success'))
                <div class="alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            @if(session()->has('failed'))
                <div class="alert alert-success">
                    {{session()->get('failed')}}
                </div>
            @endif
            <div class="row">
                            <div class="col-md-12">
                                <div class="widget-box transparent">
                                    <div class="widget-header">
                                        <h4 class="widget-title lighter smaller">
                                            <i class="ace-icon fa fa-calendar blue"></i>Test Taker List
                                        </h4>
                                    </div>
                                    <div class="widget-body">
                                        <div class="widget-main padding-4">
                                            <div class="tab-content padding-8">
                                                <div id="booklet-tab" class="tab-pane active">
                                                    <div class="table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead class="thin-border-bottom">
                                <tr>
                                    <th style="width: 8%;">#</th>
                                    <th>Name</th>
                                    <th style="width:134px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $count = 1;
                                    if($test){
                                ?>
                        @foreach($test as $t)
                            <tr>
                                <td >{{$count++}}</td>
                                <td>{{$t->title}}</td>
                                <td>
                                    <a href="{{route('placement_test_edit',$t->id)}}" class="btn btn-sm btn-primary">edit</a>
                                    <a href="{{route('placement_test_delete',$t->id)}}" class="btn btn-sm btn-danger">delete</a>
                                </td>
                            </tr>
                        @endforeach
                         <?php
                    }
                    else{
                        echo "<tr><td colspan='3'>NO Record Found</td></tr>";
                    }
                ?>
                                            </tbody>
                                        </table>

                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->
                    </div>
                </div>
                <div class="col-md-12">
                    <form method="post" action="{{route('placement_test_store')}}">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control" placeholder="add new placement test" required>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-sm btn-primary">add</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
@endsection
@section('js')
@endsection