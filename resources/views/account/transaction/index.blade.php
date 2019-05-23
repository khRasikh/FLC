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
                            Detail
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('account.includes.buttons')
                    <div class="col-xs-12 ">
                    @include($view_path.'.includes.buttons')
                        @include('includes.flash_messages')
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.includes.form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    @endsection


@section('js')
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.jquery_validation_scripts')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        $(document).ready(function () {

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var tr_head = $('select[name="tr_head"]').val();
                var tr_date_start = $('input[name="tr_date_start"]').val();
                var tr_date_end = $('input[name="tr_date_end"]').val();

                if (tr_head !== '' && tr_head > 0) {
                     url += '?tr_head=' + tr_head;
                     flag = true;
                }

                if (tr_date_start !== '') {

                    if (flag) {

                        url += '&tr_date_start=' + tr_date_start;

                    } else {

                        url += '?tr_date_start=' + tr_date_start;
                        flag = true;

                    }
                }

                if (tr_date_end !== '') {

                    if (flag) {

                        url += '&tr_date_end=' + tr_date_end;

                    } else {

                        url += '?tr_date_end=' + tr_date_end;
                        flag = true;

                    }
                }

                location.href = url;

            });

        });

    </script>
@endsection