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
                        @include($view_path.'.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Students & Parents Message
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('info.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('info.smsemail.includes.buttons')
                    @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.studentguardian.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                        {!! Form::open(['route' => $base_route.'.student-guardian.send', 'method' => 'POST', 'class' => 'form-horizontal',
                                'id' => 'group_message_send_form', "enctype" => "multipart/form-data"]) !!}
                            @include($view_path.'.studentguardian.includes.form')
                            @include($view_path.'.studentguardian.includes.table')
                        {!! Form::close() !!}
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


                if (status !== '' ) {

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


            /*message*/
            $('.email').css('display', 'none');
            /*Send Message */
            $('#group-message-send-btn').click(function () {
                /*type*/
                $sms = $('#typeSms').is(':checked');
                $email = $('#typeEmail').is(':checked');

                /*Group*/
                $student = $('#toStudent').is(':checked');
                $guardian = $('#toGuardian').is(':checked');
                $father = $('#toFather').is(':checked');
                $mother = $('#toMother').is(':checked');

                var subject = $('input[name="subject"]').val();
                var emailMessage = document.getElementById("summernote");
                var emailMessage = (emailMessage.value).length; // This will now contain text of textarea

                var message = document.getElementById("smsmessage");
                var message = (message.value).length; // This will now contain text of textarea

                if($sms || $email){
                    if($sms && message < 8){
                        toastr.info("Message is Required With More Than 8 Character. When target is SMS", "Info:");
                        return false;
                    }

                    if($email && subject === ''){
                        toastr.info("Subject is Required. When target is Email", "Info:");
                        return false;
                    }

                    if($email && emailMessage < 12){
                        toastr.info("Message is Required With More Than 12 Character. When target is SMS", "Info:");
                        return false;
                    }

                    if($student || $guardian || $father || $mother){
                        /*Check Student List Select Or not*/
                        $chkIds = document.getElementsByName('chkIds[]');
                        var $chkCount = 0;
                        $length = $chkIds.length;

                        for (var $i = 0; $i < $length; $i++) {
                            if ($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked) {
                                $chkCount++;
                            }
                        }

                        if ($chkCount <= 0) {
                            toastr.info("Please, Select At Least One Student Record.", "Info:");
                            return false;
                        }

                        //var $this = $(this);
                        var form = $('#group_message_send_form');

                    }else{
                        toastr.info("Please, Select At Least One Target Group", "Info:");
                        return false;
                    }
                }else{
                    toastr.info("Please, Select Message Type", "Info:");
                    return false;
                }
            });
            /*Message End*/

        });

        function messageTypeCondition(f) {
            //alert('ok');
            $sms = $('#typeSms').is(':checked');
            $email = $('#typeEmail').is(':checked');
            if($sms) {
                $('.email').css('display', 'none');
                $('.sms').css('display', 'block');
            }

            if($email) {
                $('.email').css('display', 'block');
                $('.sms').css('display', 'none');
            }


        }

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
                       toastr.info(data.message);
                   } else {
                       $('.semester_select').html('').append('<option value="0">Select Semester</option>');
                       $.each(data.semester, function(key,valueObj){
                           $('.semester_select').append('<option value="'+valueObj.id+'">'+valueObj.semester+'</option>');
                       });
                   }
               }
           });

       }

    </script>
    @include('includes.scripts.summarnote')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
@endsection