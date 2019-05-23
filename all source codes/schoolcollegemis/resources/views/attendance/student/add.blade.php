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
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->

                         {!! Form::open(['route' => $base_route.'.store', 'method' => 'POST', 'class' => 'form-horizontal',
                                                  'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                            @include($view_path.'.includes.form')

                            @include($view_path.'.includes.student')

                           <div class="form-group">
                               <label class="pos-rel">
                                   {!! Form::radio('send_alert', 1, false, ['class' => 'ace', "required"]) !!}
                                   <span class="lbl"></span> <span class="label label-info" >Send Alert When Attendance Save </span>
                               </label>

                               <label class="pos-rel">
                                   {!! Form::radio('send_alert', 0, true, ['class' => 'ace', "required"]) !!}
                                   <span class="lbl"></span> <span class="label label-warning" >Alert Not Required</span>
                               </label>
                           </div>

                            <div class="clearfix form-actions">
                                <div class="col-md-12 align-right">
                                    <button class="btn" type="reset">
                                        <i class="icon-undo bigger-110"></i>
                                        Reset
                                    </button>
                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn btn-info" type="submit" id="submit-attendance">
                                        <i class="icon-ok bigger-110"></i>
                                        Save Attendance
                                    </button>
                                </div>
                            </div>

                            <div class="hr hr-24"></div>

                            {!! Form::close() !!}
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
   @include('includes.scripts.datepicker_script')

    <script>

        function loadSemesters($this) {
            var year = $('select[name="years_id"]').val();
            var month = $('select[name="months_id"]').val();
            var exam = $('select[name="exams_id"]').val();
            var faculty = $('select[name="faculty"]').val();

            if (year == 0) {
                toastr.info("Please, Select Year", "Info:");
                return false;
            }

            if (month == 0) {
                toastr.info("Please, Select Month", "Info:");
                return false;
            }

            if (exam == 0) {
                toastr.info("Please, Select Exam Type", "Info:");
                return false;
            }

            if (faculty == 0) {
                toastr.info("Please, Select Faculty", "Info:");
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('student.find-semester') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    faculty_id: $this.value
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if (data.error) {
                        toastr.warning(data.error, "Warning");
                    } else {
                        $('.semester_select').html('').append('<option value="0">Select Semester</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                       // toastr.success(data.success, "Success:");
                    }
                }
            });

        }

        function loadStudent($this) {
            var date = $('input[name="date"]').val();
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semester_select"]').val();

            if (date == "") {
                toastr.info("Please, Select Date", "Info:");
                return false;
            }

            if (faculty == 0) {
                toastr.info("Please, Select Faculty", "Info:");
                return false;
            }

            if (semester == 0) {
                toastr.info("Please, Select Semester", "Info:");
                return false;
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('attendance.student-html') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: date,
                    faculty_id: faculty,
                    semester_id: semester
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if(data.error){
                        toastr.warning(data.error, "Warning:");
                    }else{
                        if(data.exist){
                            $('#student_wrapper').empty();
                            $('#student_wrapper').append(data.exist);
                            $('#studentsTable tr:last').after(data.students);
                        }else{
                            $('#student_wrapper').empty();
                            $('#student_wrapper').append(data.students);
                        }
                        //toastr.success(data.message, "Success:");
                    }
                }
            });
        }

        /*Submit Now*/
        $('#submit-attendance').click(function () {
            var date = $('input[name="date"]').val();
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semester_select"]').val();

            if (date == "") {
                toastr.info("Please, Select Date", "Info:");
                return false;
            }

            if (faculty == 0) {
                toastr.info("Please, Select Faculty", "Info:");
                return false;
            }

            if (semester == 0) {
                toastr.info("Please, Select Semester", "Info:");
                return false;
            }

            location.href = url;

        });
        /*End Submit Now*/
    </script>

@endsection