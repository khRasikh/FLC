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
                        @include($view_path.'.issue-history.includes.breadcrumb-primary')
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            History
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    @include('library.includes.buttons')
                    <div class="col-xs-12 ">
                    @include('includes.flash_messages')
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="form-horizontal">
                            @include($view_path.'.issue-history.includes.search_form')
                            <div class="hr hr-18 dotted hr-double"></div>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @include($view_path.'.issue-history.includes.table')
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection


@section('js')
    @include('includes.scripts.jquery_validation_scripts')
    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        /*Change Field Value on Capital Letter When Keyup*/
        $(function() {
            $('.upper').keyup(function() {
                this.value = this.value.toUpperCase();
            });
        });

        $(document).ready(function () {

            $('#filter-btn').click(function () {

                var url = '{{ $data['url'] }}';
                var flag = false;
                var book = $('select[name="book"]').val();
                var category = $('select[name="category"]').val();
                var status = $('select[name="status"]').val();

                var issued_start = $('input[name="issued_start"]').val();
                var issued_end = $('input[name="issued_end"]').val();

                var return_start = $('input[name="return_start"]').val();
                var return_end = $('input[name="return_end"]').val();

                var due_start = $('input[name="due_start"]').val();
                var due_end = $('input[name="due_end"]').val();

                /*if (reg_no !== '') {
                    url += '?reg_no=' + reg_no;
                    flag = true;
                }*/


                if (book !== '' & book >0) {

                    if (flag) {

                        url += '&book=' + book;

                    } else {

                        url += '?book=' + book;
                        flag = true;

                    }
                }

                if (category !== '' & category >0) {

                    if (flag) {

                        url += '&category=' + category;

                    } else {

                        url += '?category=' + category;
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

                if (issued_start !== '') {

                    if (flag) {

                        url += '&issued-start=' + issued_start;

                    } else {

                        url += '?issued-start=' + issued_start;
                        flag = true;

                    }
                }

                if (issued_end !== '') {

                    if (flag) {

                        url += '&issued-end=' + issued_end;

                    } else {

                        url += '?issued-end=' + issued_end;
                        flag = true;

                    }
                }

                if (return_start !== '') {

                    if (flag) {

                        url += '&return-start=' + return_start;

                    } else {

                        url += '?return-start=' + return_start;
                        flag = true;

                    }
                }

                if (return_end !== '') {

                    if (flag) {

                        url += '&return-end=' + return_end;

                    } else {

                        url += '?return-end=' + return_end;
                        flag = true;

                    }
                }

                if (due_start !== '') {

                    if (flag) {

                        url += '&due-start=' + due_start;

                    } else {

                        url += '?due-start=' + due_start;
                        flag = true;

                    }
                }

                if (due_end !== '') {

                    if (flag) {

                        url += '&due-end=' + due_end;

                    } else {

                        url += '?due-end=' + due_end;
                        flag = true;

                    }
                }


                location.href = url;

            });

        });



    </script>
    @include('includes.scripts.inputMask_script')
    @include('includes.scripts.delete_confirm')
    @include('includes.scripts.bulkaction_confirm')
    @include('includes.scripts.dataTable_scripts')
    @include('includes.scripts.datepicker_script')

@endsection