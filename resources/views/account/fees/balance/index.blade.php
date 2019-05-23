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
                            Balance Fees Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('account.fees.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.balance.includes.form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.balance.includes.table')
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

            /*Send Due Reminder*/

            $('table th input:checkbox').on('click' , function(){
                var that = this;
                $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

            });

            $('.message-send-btn').click(function () {
                $sms = $('#typeSms').is(':checked');
                $email = $('#typeEmail').is(':checked');
                if($sms || $email){
                    $chkIds = document.getElementsByName('chkIds[]');
                    var $chkCount = 0;
                    $length = $chkIds.length;

                    for(var $i = 0; $i < $length; $i++){
                        if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                            $chkCount++;
                        }
                    }

                    if($chkCount <= 0){
                        toastr.info("Please, Select At Least One Record.","Info:");
                        return false;
                    }

                    var $this = $(this);
                    var form = $('#send_reminder_message');

                    bootbox.confirm("You are selected "+$chkCount+" Recored. Are you sure, You Want Send Due Reminder Message?", function(result) {
                        if(result) {
                            $('#send_reminder_message').submit();
                        }
                    });

                }else{
                    toastr.info("Please, Select Reminder Message Type", "Info:");
                    return false;
                }
            });


            $('.bulk-due-slip').click(function () {
                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;
                student = new Array();

                for(var $i = 0; $i < $length; $i++){
                    if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                        student[$i] = $chkIds[$i].value;
                        $chkCount++;
                    }
                }

                if ($chkCount <= 0) {
                    toastr.info("Please, Select At Least One Record.", "Info:");
                    return false;
                }

                student = student.filter(function (t) {
                    return (t !== (undefined || null || ''));
                });

                $.ajax({
                    type: 'POST',
                    url: '{{ route('print-out.fees.bulk-due-detail-slip') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        student:student
                    },
                    success: function (response) {
                        toastr.info("ok");
                       /* var w = window.open();
                        $(w.document.body).html(response);*/
                        //var w = window.open();
                        //Append Search unordered list
                        //var newWindow = window.open("", "new window", "width=200, height=100");
                        //var newWindow = window.open("", "new window", "width=900, height=1000");
                        document.write(response);
                        //window.open(document.write(response));
                        //var newWindow = window.open(response, '_blank');

                        //write the data to the document of the newWindow
                        //newWindow.document.write(response);
                        //newWindow.print();
                    }
                });


            });

            $('.short-due-slip').click(function () {
                $chkIds = document.getElementsByName('chkIds[]');
                var $chkCount = 0;
                $length = $chkIds.length;
                student = new Array();

                for(var $i = 0; $i < $length; $i++){
                    if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                        student[$i] = $chkIds[$i].value;
                        $chkCount++;
                    }
                }

                if ($chkCount <= 0) {
                    toastr.info("Please, Select At Least One Record.", "Info:");
                    return false;
                }

                student = student.filter(function (t) {
                    return (t !== (undefined || null || ''));
                });


                $.ajax({
                    type: 'POST',
                    url: '{{ route('print-out.fees.bulk-due-slip') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                        student:student
                    },
                    success: function (response) {
                        toastr.info("ok");
                        /* var w = window.open();
                         $(w.document.body).html(response);*/
                        //var w = window.open();
                        //Append Search unordered list
                        //var newWindow = window.open("", "new window", "width=200, height=100");
                        //var newWindow = window.open("", "new window", "width=900, height=1000");
                        document.write(response);
                        //window.open(document.write(response));
                        //var newWindow = window.open(response, '_blank');

                        //write the data to the document of the newWindow
                        //newWindow.document.write(response);
                        //newWindow.print();
                    }
                });


            });




            /*Due Reminder End*/
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

            $('#load-fee-html').click(function () {

                $.ajax({
                    type: 'POST',
                    url: '{{ route('account.fees.master.fee-html') }}',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function (response) {
                        var data = $.parseJSON(response);

                        if (data.error) {
                            //$.notify(data.message, "warning");
                        } else {

                            $('#fee_wrapper').append(data.html);
                            $(document).find('option[value="0"]').attr("value", "");
                            //$(document).find('option[value="0"]').attr("disabled", "disabled");
                            //$.notify(data.message, "success");
                        }
                    }
                });

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
    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

@endsection