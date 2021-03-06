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
                            Add Fees
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                        @include('account.fees.includes.buttons')
                        @include('includes.flash_messages')
                        @if (isset($data['row']) && $data['row']->count() > 0)
                            @include($base_route.'.includes.edit')
                        @else
                        <!-- PAGE CONTENT BEGINS -->
                            <div class="form-horizontal">
                                @include($view_path.'.includes.form')
                                <div class="hr hr-18 dotted hr-double"></div>
                            </div>
                            @include($base_route.'.includes.add')
                            @include($view_path.'.includes.table')
                        @endif
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
                var facility = $('select[name="facility"]').val();
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

                if (facility !== '' & facility >0) {

                    if (flag) {

                        url += '&facility=' + facility;

                    } else {

                        url += '?facility=' + facility;
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
                        }
                    }
                });

            });

            /*Add Fees */

            $('#fee-add-btn').click(function () {
                var fee_head = $('select[name="fee_head[]"]').val();

                if(fee_head !== undefined) {
                    $chkIds = document.getElementsByName('chkIds[]');
                    var $chkCount = 0;
                    $length = $chkIds.length;

                    for(var $i = 0; $i < $length; $i++){
                        if($chkIds[$i].type == 'checkbox' && $chkIds[$i].checked){
                            $chkCount++;
                        }
                    }

                    if($chkCount <= 0){
                        toastr.warning("Please, Select At Least One Student Record.");
                        return false;
                    }

                    var form = $('#fee_add_form');

                }else{
                    toastr.warning('Please, Add At Least One Fee Head.');
                    return false;
                }


            });
            /*Add Fees End*/

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
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
@endsection