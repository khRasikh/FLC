@extends('layouts.master')

@section('css')
    <!-- page specific plugin styles -->
@endsection

@section('content')
    <div class="main-content">
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
                                            <i class="ace-icon fa fa-calculator green"></i> Ledger - {{ \Carbon\Carbon::parse(now())->format('Y-m-d')}}
                                        </h3>

                                        <div class="widget-toolbar no-border invoice-info">
                                            <span class="invoice-info-label">User:</span>
                                            <span class="red">{{isset(auth()->user()->name)?auth()->user()->name:""}}</span>

                                            <br />
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
                                                                <span>Reg No. : </span>{{ $data['student']->reg_no }}
                                                                <hr class="hr-2 no-border">
                                                                <span>Name : </span><strong>{{ $data['student']->first_name.' '.$data['student']->middle_name.' '.$data['student']->last_name }}</strong>
                                                                <hr class="hr-2 no-border">
                                                                <span>Level: </span>{{ ViewHelper::getFacultyTitle($data['student']->faculty) }}
																<hr class="hr-2 no-border">
																{{ ViewHelper::getSemesterTitle($data['student']->semester) }}
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
                                                            <th>DueOn</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Di</th>
                                                            <th>Fi</th>
                                                            <th>Paid</th>
                                                            <th>Due</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                    {{--{{$data['student']->feeMaster}}--}}
                                                        @if($data['student']->feeMaster && $data['student']->feeMaster->count() > 0)
                                                            @php($i=1)
                                                            @foreach($data['student']->feeMaster as $feeMaster)
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
                                                                        {{ $amount = $feeMaster->fee_amount?$feeMaster->fee_amount:'-' }}
                                                                    </td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td>
                                                                        @php($paid = $feeMaster->feeCollect->sum('paid_amount'))
                                                                        {{ $paid?$paid:'-' }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $balance =  $amount - $paid  }}
                                                                    </td>
                                                                </tr>
                                                                @if($feeMaster->feeCollect )
                                                                    @foreach($feeMaster->feeCollect as $feeCollection)
                                                                        <tr>
                                                                            <td colspan="5"></td>
                                                                            <td> {{ \Carbon\Carbon::parse($feeCollection->date)->format('Y-m-d')}}</td>
                                                                            <td>{{ $feeCollection->discount?$feeCollection->discount:'-' }}</td>
                                                                            <td>{{ $feeCollection->fine?$feeCollection->fine:"-" }}</td>
                                                                            <td>{{ $feeCollection->paid_amount?$feeCollection->paid_amount:'-' }}</td>
                                                                            <td> </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            <tr style="font-size: 14px; background: orangered;color: white;">
                                                                <td colspan="3">Total</td>
                                                                <td>{{ $data['student']->fee_amount?$data['student']->fee_amount:'-' }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>{{ $data['student']->discount?$data['student']->discount:'-' }}</td>
                                                                <td>{{ $data['student']->fine?$data['student']->fine:'-' }}</td>
                                                                <td>{{ $data['student']->paid_amount?$data['student']->paid_amount:'-' }}</td>
                                                                <td>
                                                                    {{ $data['student']->balance?$data['student']->balance:'-' }}
                                                                </td>

                                                            </tr>
                                                        @else
                                                            <tr colspan="8"></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="hr hr8 hr-dotted"></div>

                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total :</strong>{{$data['student']->paid_amount}}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                   <strong> In Word:</strong> {{ ViewHelper::convertNumberToWord($data['student']->paid_amount) }}only.
                                                </div>
                                            </div>
                                            <div class="hr hr8 hr-double"></div>
                                            <div class="row text-uppercase">
                                                <div class="col-sm-5 pull-right align-right">
                                                    <strong>Total Due :</strong>{{$data['student']->balance }}/-
                                                </div>
                                                <div class="col-sm-7 pull-left">
                                                    <strong> Due In Word:</strong> {{ ViewHelper::convertNumberToWord($data['student']->balance ) }}only.
                                                </div>
                                            </div>
                                            <div class="hr hr-4 hr-dotted"></div>
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
    @endsection


@section('js')
    <!-- inline scripts related to this page -->
    @include('includes.scripts.print_script')
    @endsection