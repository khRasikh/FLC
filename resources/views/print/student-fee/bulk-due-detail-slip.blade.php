@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0 )
        @foreach($data['student'] as $student)
            <div class="main-content" >
                <div class="main-content-inner">
                    <div class="page-content">
                        @include('layouts.includes.template_setting')
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="space-6"></div>
                                <div class="row">
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="widget-box transparent">
                                                <div class="widget-header widget-header-large">
                                                    <h3 class="widget-title grey lighter no-margin-bottom">
                                                        <i class="ace-icon fa fa-calculator green"></i> Due Detail Slip -{{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                                    </h3>

                                                    <div class="widget-toolbar no-border invoice-info">
                                                        <span class="invoice-info-label">User:</span>
                                                        <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>

                                                        <br/>
                                                        <span class="invoice-info-label">Date:</span>
                                                        <span class="blue">{{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}</span>
                                                    </div>

                                                    <div class="widget-toolbar hidden-480">
                                                        <a href="#" onclick="window.print()">
                                                            <i class="ace-icon fa fa-print bigger-180"></i>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="widget-body">
                                                    <div class="widget-main padding-24">
                                                        <div class="print-info">
                                                            <table class="table  no-border">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <span>Reg No. : </span>{{ $student->reg_no }}
                                                                        <hr class="hr-2 no-border">
                                                                        <span>Name : </span><strong>{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</strong>
                                                                        <hr class="hr-2 no-border">
                                                                        <span>Level: </span>{{ ViewHelper::getFacultyTitle($student->faculty) }}
																		<hr class="hr-2 no-border">
                                                                        <span class="margin-left">{{ ViewHelper::getSemesterTitle($student->semester) }}</span>
                                                                    </td>
                                                                    <td class="text-right">
                                                                        {!! isset($generalSetting->print_header)?$generalSetting->print_header:'-' !!}
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="space"></div>

                                                        <div>
                                                            <table class="table table-striped table-bordered no-margin-bottom">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th class="center"></th>
                                                                        <th></th>
                                                                        <th>Head</th>
                                                                        <th>Due Date</th>
                                                                        <th>Amount</th>
                                                                        <th>Di</th>
                                                                        <th>Fi</th>
                                                                        <th>Paid</th>
                                                                        <th>Due</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    @php($i=1)
                                                                        @foreach($student->master as $feeMaster)
                                                                            @if(isset($feeMaster->due) && $feeMaster->due >0)
                                                                                <tr>
                                                                                    <td class="center">{{ $i }}</td>
                                                                                    <td>
                                                                                        {{ ViewHelper::getSemesterById($feeMaster->semester) }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ ViewHelper::getFeeHeadById($feeMaster->fee_head) }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ \Carbon\Carbon::parse($feeMaster->fee_due_date)->format('Y-m-d') }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->fee_amount?$feeMaster->fee_amount:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->discount?$feeMaster->discount:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->fine?$feeMaster->fine:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->paid_amount?$feeMaster->paid_amount:'-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        {{ $feeMaster->due?$feeMaster->due:'-'  }}
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                        @endforeach
                                                                        <tr style="font-size: 14px; background: orangered;color: white;">
                                                                            <td colspan="4">Total</td>
                                                                            <td>{{ $student->fee_amount?$student->fee_amount:'-' }}</td>
                                                                            <td>{{ $student->discount?$student->discount:'-' }}</td>
                                                                            <td>{{ $student->fine?$student->fine:'-' }}</td>
                                                                            <td>{{ $student->paid_amount?$student->paid_amount:'-' }}</td>
                                                                            <td>
                                                                                {{ $student->balance?$student->balance:'-' }}
                                                                            </td>

                                                                        </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>

                                                        <div class="hr hr8 hr-dotted"></div>


                                                        <div class="row text-uppercase">
                                                            <div class="col-sm-5 pull-right align-right">
                                                                <strong>Total Due :</strong>{{$student->balance}}/-
                                                            </div>
                                                            <div class="col-sm-7 pull-left">
                                                                <strong>Due In Word:</strong> {{ ViewHelper::convertNumberToWord($student->balance) }}only.
                                                            </div>
                                                        </div>
                                                        <div class="hr hr8 hr-dotted"></div>


                                                        <div class="space-6"></div>
                                                        @if(isset($generalSetting->print_footer))
                                                            <div class="well well-sm">
                                                                {!! $generalSetting->print_footer !!}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
            <div style="page-break-after:always;"></div>
        @endforeach
    @endif
@endsection


@section('js')
    <!-- inline scripts related to this page -->
   @include('includes.scripts.print_script')
@endsection