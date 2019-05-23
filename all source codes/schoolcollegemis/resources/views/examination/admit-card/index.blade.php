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
                        @include('examination.admit-card.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Print
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12 ">
                    {{--@include('examination.admit-card.includes.buttons')--}}
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include('examination.admit-card.includes.form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->

                @include('examination.admit-card.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#filter-btn').click(function () {
                var url = '{{ $data['url'] }}';
                var flag = false;
                var reg_no = $('input[name="reg_no"]').val();
                var reg_start_date = $('input[name="reg_start_date"]').val();
                var reg_end_date = $('input[name="reg_end_date"]').val();
                var faculty = $('select[name="faculty"]').val();
                var semester = $('select[name="semester_select[]"]').val();
                var status = $('select[name="status"]').val();

                if (reg_no !== '') {
                    url += '?reg_no=' + reg_no;
                    flag = true;
                }

                if (reg_start_date !== '') {

                    if (flag) {

                        url += '&reg-start-date=' + reg_start_date;

                    } else {

                        url += '?reg-start-date=' + reg_start_date;
                        flag = true;

                    }
                }

                if (reg_end_date !== '') {

                    if (flag) {

                        url += '&reg-end-date=' + reg_end_date;

                    } else {

                        url += '?reg-end-date=' + reg_end_date;
                        flag = true;

                    }
                }


                if (faculty !== '' & faculty >0) {

                    if (flag) {

                        url += '&faculty=' + faculty;

                    } else {

                        url += '?faculty=' + faculty;
                        flag = true;

                    }
                }

                if (semester !== '' & semester >0) {

                    if (flag) {

                        url += '&semester=' + semester;

                    } else {

                        url += '?semester=' + semester;
                        flag = true;

                    }
                }


                if (status !== '') {

                    if (status !== 'all') {

                        if (flag) {

                            url += '&status=' + status;

                        } else {

                            url += '?status=' + status;

                        }

                    }
                }

                location.href = url;

            });

            $('#print-btn').click(function () {
                var url = '{{ $data['url'] }}';
                var year = $('select[name="years_id"]').val();
                var month = $('select[name="months_id"]').val();
                var exam = $('select[name="exams_id"]').val();
                var faculty = $('select[name="target_faculty"]').val();
                var semester = $('select[name="semester_select"]').val();

                if (year == 0) {
                    toastr.info('Please Select Year','Info:');
                    return false;
                }

                if (month == 0) {
                    toastr.info('Please Select Month','Info:');
                    return false;
                }


                if (exam == 0) {
                    toastr.info('Please Select Schedule Exam','Info:');
                    return false;
                }

                if (faculty == 0) {
                    toastr.info('Please Select Faculty','Info:');
                    return false;
                }

                if (semester == 0) {
                    toastr.info('Please Select Semester','Info:');
                    return false;
                }


                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;
                for (var $i = 0; $i < $length; $i++) {
                    if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                        $chkCount++;
                    }
                }

                if ($chkCount <= 0) {
                    toastr.info("Please, Select At Least One Record.", "Info:");
                    return false;
                }


               /* if(flag == true){
                    location.href = url;
                }else{
                    toastr.info("Please, Select Your Target Schedule", "Info:");
                    return false;
                }*/
                //location.href = url;
            });

        });

        function loadSemesters($this) {

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
                        $.notify(data.message, "warning");
                    } else {
                        $('.semester_select').html('').append('<option value="0">Select Semester</option>');
                        $.each(data.semester, function(key,valueObj){
                            $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                        });
                    }
                }
            });

        }

        function loadSubject($this) {
            var year = $('select[name="years_id"]').val();
            var month = $('select[name="months_id"]').val();
            var exam = $('select[name="exams_id"]').val();
            var faculty = $('select[name="faculty"]').val();
            var semester = $('select[name="semester_select"]').val();

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

            if (semester == 0) {
                toastr.info("Please, Select Semester", "Info:");
                return false;
            }

            if (!semester)
                toastr.warning("Please, Choose Semester.", "Warning");
            else {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('exam.mark-ledger.find-subject') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        years_id: year,
                        months_id: month,
                        exams_id: exam,
                        faculty_id: faculty,
                        semester_id: semester
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);
                        if (data.error) {
                            $('.schedule_subject').html('')
                            toastr.warning(data.error, "Warning:");
                        } else {
                            $('.schedule_subject').html('').append('<option value="0">Select Subject</option>');
                            $.each(data.subjects, function (key, valueObj) {
                                $('.schedule_subject').append('<option value="' + valueObj.id + '">' + valueObj.title + '</option>');
                            });
                            toastr.success(data.success, "Success:");
                        }
                    }
                });
            }

        }

    </script>
    {{--@include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')--}}
    @include('includes.scripts.dataTable_scripts')
    {{--@include('includes.scripts.datepicker_script')--}}

    @endsection