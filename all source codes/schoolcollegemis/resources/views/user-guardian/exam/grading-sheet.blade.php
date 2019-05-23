@extends('user-guardian.layouts.master')

@section('css')
    <!-- page specific plugin styles -->
    <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One|Lobster|Merienda|Righteous" rel="stylesheet">
@endsection

@section('content')
    @if($data['student'] && $data['student']->count() > 0)

        @foreach($data['student'] as $student)
            <div class="main-content " >
                <div class="col-sm-12 align-right hidden-print">
                    <a href="#" class="" onclick="window.print();">
                        <i class="ace-icon fa fa-print bigger-200"></i>
                    </a>
                </div>
                <div class="main-content-inner">
                    <div class="page-content">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->
                                <div class="space-6"></div>
                                <div class="row">
                                    <div class="col-sm-10 col-sm-offset-1">
                                        <div class="widget-box transparent">
                                            <div class="row">
                                                <div class="col-md-2 col-print-2 align-left">
                                                    @if(isset($generalSetting->logo))
                                                        <img src="{{ asset('images'.DIRECTORY_SEPARATOR.'setting'.DIRECTORY_SEPARATOR.'general'.DIRECTORY_SEPARATOR.$generalSetting->logo) }}" width="150px">
                                                    @endif
                                                </div>
                                                <div class="col-md-10 col-print-10 align-right">
                                                    <div class="text-center">
                                                        <h2 class="no-margin-top" style="font-family: 'Merienda', cursive; font-size: 30px">
                                                            <strong>{{$generalSetting->institute}}</strong>
                                                        </h2>
                                                        <h3 class="text-uppercase no-margin-top">Department of Examination</h3>
                                                        <h5 class="no-margin-top">
                                                            {{$generalSetting->address}}, {{$generalSetting->phone}}
                                                        </h5>

                                                        <h2 class="no-margin text-uppercase" style="font-family: 'Righteous', cursive;">
                                                            <strong>provisional statement of marks</strong>
                                                        </h2>
                                                        <h3 class="no-margin-top">for</h3>
                                                        <h3 class="no-margin no-margin-top" style="font-family: 'Righteous', cursive;">
                                                            <strong> {{ ViewHelper::getExamById($data['exam']) }} - {{ ViewHelper::getYearById($data['year']) }}</strong>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=row">
                                                <div class="space-6"></div>
                                                <div class="profile-user-info profile-user-info-striped">
                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Level : </div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="faculty">{{  ViewHelper::getFacultyTitle( $data['faculty'] ) }}/{{  ViewHelper::getSemesterTitle( $data['semester'] ) }}</span>
                                                        </div>
                                                        <div class="profile-info-name"> Reg. No.: </div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="reg_no"><strong>{{ $student->reg_no }}</strong></span>
                                                        </div>
                                                    </div>

                                                    <div class="profile-info-row">
                                                        <div class="profile-info-name"> Name : </div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="student_name"><strong>{{ $student->first_name.' '.$student->middle_name.' '.$student->last_name }}</strong></span>
                                                        </div>
                                                        <div class="profile-info-name"> Date Of Birth :</div>
                                                        <div class="profile-info-value">
                                                            <span class="editable" id="reg_date">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d')}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="space-6"></div>
                                            </div>
                                            <div class=row">
                                                <table width="100%" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" class="text-center">SN</th>
                                                            <th rowspan="2" class="text-center">CODE</th>
                                                            <th rowspan="2" class="text-center">COURSE TITLE</th>
                                                            <th rowspan="2" class="text-center">CREDIT</th>
                                                            <th colspan="2" class="text-center">OBTAINED GRADE</th>
                                                            <th rowspan="2"  class="text-center">FG</th>
                                                            <th rowspan="2"  class="text-center">GP</th>
                                                            <th rowspan="2"  class="text-center">REM</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center">TH</th>
                                                            <th class="text-center">PR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if($student->subjects && $student->subjects->count() > 0)
                                                        @php($i=1)
                                                        @foreach($student->subjects as $subject)
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ViewHelper::getSubjectCodeById($subject->subjects_id)}}</td>
                                                                <td>{{ViewHelper::getSubjectById($subject->subjects_id)}}</td>
                                                                <td>{{ViewHelper::getSubCreditById($subject->subjects_id)}}</td>
                                                                <td>{{$subject->obtain_score_theory?$subject->obtain_score_theory:'-'}}</td>
                                                                <td>{{$subject->obtain_score_practical?$subject->obtain_score_practical:'-'}}</td>
                                                                <td>{{$subject->final_grade?$subject->final_grade:'-'}}</td>
                                                                <td>{{$subject->grade_point?$subject->grade_point:'-'}}</td>
                                                                <td>{{$subject->remark?$subject->remark:'-'}}</td>
                                                            </tr>
                                                            @php($i++)
                                                        @endforeach
                                                    @endif
                                                    </tbody>
                                                    <tfoot style="font-weight: 600">
                                                        <td colspan="7" class="text-right">GRADE POINT AVERAGE (GPA):</td>
                                                        <td>{{$student->gpa?$student->gpa:''}}</td>
                                                        <td></td>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <div class="smaller-80">
                                                <strong>Abbreviations | </strong><strong>TH</strong>:Theory,<strong>PR</strong>:Practical,<strong>FG</strong>:Final Grade,<strong>GP</strong>:Grade Point,<strong>REM</strong>:Remark,<strong>*AB</strong>:Absent,<strong>*NG</strong>:No Grade,<strong>*MG</strong>:Missing Grade, <strong>*MP</strong>:Missing Point
                                            </div>
                                            <div class="hr hr-8"></div>
                                            <div class="row text-uppercase">
                                                <table width="100%">
                                                    <tr>
                                                        <td>DATE: <strong>{{ \Carbon\Carbon::parse(now())->format('Y-m-d')}} </strong></td>

                                                        <td class="align-right"><strong>Controller of Examination</strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="hr hr-4"></div>
                                            <div class="well well-sm">
                                                Note:This is only for information. If any query contact Examination Department.
                                            </div>
                                        </div>
                                        <!-- PAGE CONTENT ENDS -->
                                    </div><!-- /.col -->
                                </div><!-- /.row -->
                            </div><!-- /.page-content -->
                        </div>
                    </div>
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