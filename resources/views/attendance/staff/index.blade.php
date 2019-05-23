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
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('attendance.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                            {!! Form::open(['route' => $base_route, 'method' => 'GET', 'class' => 'form-horizontal',
                                                      'id' => 'validation-form', "enctype" => "multipart/form-data"]) !!}
                                <div class="form-horizontal">
                                @include($view_path.'.includes.search_form')
                                <div class="hr hr-18 dotted hr-double"></div>
                            {!! Form::close() !!}
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')

    <script>

        function loadStaff($this) {
            var date = $('input[name="date"]').val();
            var designation = $('select[name="designation"]').val();

            if (date == "") {
                toastr.info("Please, Select Date", "Info:");
                return false;
            }

            if (designation == 0) {
                toastr.info("Please, Select Designation", "Info:");
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '{{ route('attendance.staff-html') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    date: date,
                    designation_id: designation,
                },
                success: function (response) {
                    var data = $.parseJSON(response);
                    if(data.error){
                        toastr.warning(data.error, "Warning:");
                    }else{
                        if(data.exist){
                            $('#staff_wrapper').empty();
                            $('#staff_wrapper').append(data.exist);
                            $('#staffsTable tr:last').after(data.staffs);
                        }else{
                            $('#staff_wrapper').empty();
                            $('#staff_wrapper').append(data.staffs);
                        }
                        //toastr.success(data.message, "Success:");
                    }
                }
            });
        }

        /*Schedule Now*/
        $('#submit-attendance').click(function () {
            var url = '{{ $data['url'] }}';
            var designation = $('select[name="designation"]').val();

            if (designation == 0) {
                toastr.info("Please, Select Designation", "Info:");
                return false;
            }

            location.href = url;

        });
        /*End Schedule Now*/
    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

@endsection