@extends('layouts.master')

@section('css')
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
                        <small>
                            Test Taker
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Create
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    <!-- PAGE CONTENT BEGINS -->
                        @include('includes.validation_error_messages')
                        <form method="post" action="{{route('placement_test_update',$test->id)}}" class="form-horizontal" id="validation-form">
                            {{csrf_field()}}
                        <h4 class="header large lighter blue"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Placement Test</h4>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Name</label>
                            <div class="col-sm-4">
                                <input type="text" name="title" class="form-control border-form" required="required" value="{{$test->title}}">
                                @include('includes.form_fields_validation_message', ['name' => 'title'])
                            </div>
                        </div>
                        <div class="clearfix form-actions">
                            <div class="col-md-12 align-right">
                                <button class="btn" type="reset">
                                    <i class="icon-undo bigger-110"></i>
                                    Reset
                                </button>

                                <button class="btn btn-info" type="submit">
                                    <i class="icon-ok bigger-110"></i>
                                    Register
                                </button>
                            </div>
                        </div>

                        <div class="hr hr-24"></div>

                        </form>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection

@section('js')

    @include('includes.scripts.jquery_validation_scripts')
    <script src="{{ asset('assets/js/notify.min.js') }}"></script>
    <script>

        $(document).ready(function () {

            /*function passCheck(){
                alert('Attention!, Please Enter Value Greater Than 0');
                pass = $("#pass").val();
                repeatpass = $("#repeatpass").val();
                if(pass == repeatpass){
                    $.notify("Please, Choose Your Target Year.", "warning");
                }
            }*/

            jqueryValidation(
                {
                    "name": {
                        required: true,
                    },
                    "email": {
                        required: true,
                    },
                    "password": {
                        required: true,
                    },
                    "contact_number": {
                        required: true,
                    },
                    "address": {
                        required: true,
                    }

                },
                {
                    "name": {
                        required: "Please, Add User Name.",
                    },
                    "email": {
                        required: "Please, Add User Email.",
                    },
                    "password": {
                        required: "Please, Add User Password.",
                    },
                    "contact_number": {
                        required: "Please, Add Contact Number.",
                    },
                    "address": {
                        required: "Please, Add Address.",
                    }
                }
            );


        });
        /*'name', 'email', 'password', 'profile_image', 'contact_number', 'address','user_type',*/
    </script>
    @include('includes.scripts.datepicker_script')
@endsection
