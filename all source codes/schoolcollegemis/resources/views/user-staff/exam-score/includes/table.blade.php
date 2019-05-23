@if($data['examScore'] && $data['examScore']->count() > 0)
    @foreach($data['examScore'] as $key => $examScore )
        <h4 class="header large lighter blue">
            <i class="blue ace-icon fa fa-certificate bigger-140"></i>
            {{ ViewHelper::getYearById($examScore[0]->years_id) }} |
            {{ ViewHelper::getExamById($examScore[0]->exams_id) }} |
            {{  ViewHelper::getSemesterTitle( $examScore[0]->semesters_id ) }}
        </h4>
        <div class="main-content ">
            <div class="main-content-inner">
                <div class="page-content">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <div class="widget-box transparent">
                                <div class=row">
                                    <table width="100%" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th rowspan="2" class="text-center">SN</th>
                                            <th rowspan="2" class="text-center">SUBJECT CODE</th>
                                            <th rowspan="2" class="text-center">SUBJECT TITLE</th>
                                            <th colspan="2" class="text-center">FULL MARK</th>
                                            <th colspan="2" class="text-center">PASS MARK</th>
                                            <th colspan="2" class="text-center">OBTAINED MARK</th>
                                        </tr>
                                        <tr>
                                            <th class="text-center">TH</th>
                                            <th class="text-center">PR</th>
                                            <th class="text-center">TH</th>
                                            <th class="text-center">PR</th>
                                            <th class="text-center">TH</th>
                                            <th class="text-center">PR</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($examScore && $examScore->count() > 0)
                                            @php($i=1)
                                            @foreach($examScore as $subject)
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ViewHelper::getSubjectCodeById($subject->subjects_id)}}</td>
                                                    <td>{{ViewHelper::getSubjectById($subject->subjects_id)}}</td>
                                                    <td>{{$subject->full_mark_theory?$subject->full_mark_theory:'-'}}</td>
                                                    <td>{{$subject->full_mark_practical?$subject->full_mark_practical:'-'}}</td>
                                                    <td>{{$subject->pass_mark_theory?$subject->pass_mark_theory:'-'}}</td>
                                                    <td>{{$subject->pass_mark_practical?$subject->pass_mark_practical:'-'}}</td>
                                                    <td>{{$subject->obtain_mark_theory?$subject->obtain_mark_theory:'-'}}</td>
                                                    <td>{{$subject->obtain_mark_practical?$subject->obtain_mark_practical:'-'}}</td>
                                                </tr>
                                                @php($i++)
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tfoot style="font-weight: 600">
                                        <td colspan="3" class="text-right">TOTAL</td>
                                        <td>{{ $examScore->sum('full_mark_theory')?$examScore->sum('full_mark_theory'):'-'}}</td>
                                        <td>{{ $examScore->sum('full_mark_practical')?$examScore->sum('full_mark_practical'):'-'}}</td>
                                        <td>{{ $examScore->sum('pass_mark_theory')?$examScore->sum('pass_mark_theory'):'-'}}</td>
                                        <td>{{ $examScore->sum('pass_mark_practical')?$examScore->sum('pass_mark_practical'):'-'}}</td>
                                        <td>{{ $examScore->sum('obtain_mark_theory')?$examScore->sum('obtain_mark_theory'):'-'}}</td>
                                        <td>{{ $examScore->sum('obtain_mark_practical')?$examScore->sum('obtain_mark_practical'):'-'}}</td>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.page-content -->
                    </div>
                </div>
            </div>
        </div><!-- /.main-content -->
    @endforeach
@else
    No any Score Found
@endif