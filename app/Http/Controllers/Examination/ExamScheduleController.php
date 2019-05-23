<?php
/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 03/03/2018
 * Time: 7:05 PM
 */
namespace App\Http\Controllers\Examination;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\Faculty;
use App\Models\Month;
use App\Models\Semester;
use App\Models\Year;
use Illuminate\Http\Request;
use URL;

class ExamScheduleController extends CollegeBaseController
{
    protected $base_route = 'exam.schedule';
    protected $view_path = 'examination.schedule';
    protected $panel = 'Exam Schedule';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        if($request->all()) {
            $data['schedule_exams'] = ExamSchedule::select('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
                ->groupBy('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
                ->where(function ($query) use ($request) {

                    $year = $request->get('year');
                    $month = $request->get('month');
                    $exam = $request->get('exam');
                    $faculty = $request->get('faculty');
                    $semester = $request->get('semester');

                    if ($year) {
                        $query->where('years_id', '=', $year);
                        $this->filter_query['years_id'] = $year;
                    }

                    if ($month) {
                        $query->where('months_id', '=', $month);
                        $this->filter_query['months_id'] = $month;
                    }

                    if ($exam) {
                        $query->where('exams_id', '=', $exam);
                        $this->filter_query['exams_id'] = $exam;
                    }

                    if ($faculty) {
                        $query->where('faculty_id', '=', $faculty);
                        $this->filter_query['faculty_id'] = $faculty;
                    }

                    if ($semester) {
                        $query->where('semesters_id', '=', $semester);
                        $this->filter_query['semesters_id'] = $semester;
                    }
                })
                ->orderBy('years_id', 'desc')
                ->orderBy('months_id', 'asc')
                ->get();
        }else{
            $data['schedule_exams'] = ExamSchedule::select('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
                ->groupBy('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id','publish_status', 'status')
                ->where(function ($query) use ($request) {

                    $year = $request->get('year');
                    $month = $request->get('month');
                    $exam = $request->get('exam');
                    $faculty = $request->get('faculty');
                    $semester = $request->get('semester');

                    if ($year) {
                        $query->where('years_id', '=', $year);
                        $this->filter_query['years_id'] = $year;
                    }

                    if ($month) {
                        $query->where('months_id', '=', $month);
                        $this->filter_query['months_id'] = $month;
                    }

                    if ($exam) {
                        $query->where('exams_id', '=', $exam);
                        $this->filter_query['exams_id'] = $exam;
                    }

                    if ($faculty) {
                        $query->where('faculty_id', '=', $faculty);
                        $this->filter_query['faculty_id'] = $faculty;
                    }

                    if ($semester) {
                        $query->where('semesters_id', '=', $semester);
                        $this->filter_query['semesters_id'] = $semester;
                    }
                })
                ->orderBy('years_id', 'desc')
                ->orderBy('months_id', 'asc')
                ->limit (10)
                ->get();
        }

        $data['years'] = [];
        $data['years'][0] = 'Select Year...';
        foreach (Year::select('id', 'title')->get() as $year) {
            $data['years'][$year->id] = $year->title;
        }

        $data['months'] = [];
        $data['months'][0] = 'Select Month...';
        foreach (Month::select('id', 'title')->orderBy('id')->get() as $month) {
            $data['months'][$month->id] = $month->title;
        }

        $data['exams'] = [];
        $data['exams'][0] = 'Select Exam...';
        foreach (Exam::select('id', 'title')->orderBy('title')->get() as $exam) {
            $data['exams'][$exam->id] = $exam->title;
        }

        $data['faculties'] = [];
        $data['faculties'][0] = 'Select Facult...';
        foreach (Faculty::select('id', 'faculty')->orderBy('faculty')->get() as $faculty) {
            $data['faculties'][$faculty->id] = $faculty->faculty;
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function add(Request $request)
    {
        $data = [];

        $data['years'] = [];
        $data['years'][0] = 'Select Year...';
        foreach (Year::select('id', 'title')->get() as $year) {
            $data['years'][$year->id] = $year->title;
        }

        $data['months'] = [];
        $data['months'][0] = 'Select Month...';
        foreach (Month::select('id', 'title')->orderBy('id')->get() as $month) {
            $data['months'][$month->id] = $month->title;
        }

        $data['exams'] = [];
        $data['exams'][0] = 'Select Exam...';
        foreach (Exam::select('id', 'title')->orderBy('title')->get() as $exam) {
            $data['exams'][$exam->id] = $exam->title;
        }

        $data['faculties'] = [];
        $data['faculties'][0] = 'Select Facult...';
        foreach (Faculty::select('id', 'faculty')->orderBy('faculty')->get() as $faculty) {
            $data['faculties'][$faculty->id] = $faculty->faculty;
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $year = $request->get('years_id');
        $month = $request->get('months_id');
        $exam = $request->get('exams_id');
        $faculty = $request->get('faculty');
        $semester = $request->get('semester_select');

        if($request->has('sem_subject_id')) {
            foreach ($request->get('sem_subject_id') as $key => $subject) {
                /*Find Subject Which is Already Scheduled*/
                $selectedSubject = ExamSchedule::where([
                                        ['years_id', '=' , $year],
                                        ['months_id', '=' , $month],
                                        ['exams_id', '=' , $exam],
                                        ['faculty_id', '=' , $faculty],
                                        ['semesters_id', '=' , $semester],
                                        ['subjects_id', '=' , $subject]
                                    ])
                                    ->first();

                if ($selectedSubject != null) {
                    /*Update Already Scheduled Subject*/
                    $subjectUpdate = [
                        'years_id' => $year,
                        'months_id' => $month,
                        'exams_id' => $exam,
                        'faculty_id' => $faculty,
                        'semesters_id' => $semester,
                        'subjects_id' => $subject,
                        'date' => $request->get('date')[$key],
                        'start_time' => $request->get('start_time')[$key],
                        'end_time' => $request->get('end_time')[$key],
                        'full_mark_theory' => $request->get('full_mark_theory')[$key],
                        'pass_mark_theory' => $request->get('pass_mark_theory')[$key],
                        'full_mark_practical' => $request->get('full_mark_practical')[$key],
                        'pass_mark_practical' => $request->get('pass_mark_practical')[$key],
                        'sorting_order' => $key+1,
                        'updated_by' => auth()->user()->id
                    ];

                    $selectedSubject->update($subjectUpdate);

                }else{
                    /*Schedule When Not Scheduled Yet*/
                    ExamSchedule::create([
                        'years_id' => $year,
                        'months_id' => $month,
                        'exams_id' => $exam,
                        'faculty_id' => $faculty,
                        'semesters_id' => $semester,
                        'subjects_id' => $subject,
                        'date' => $request->get('date')[$key],
                        'start_time' => $request->get('start_time')[$key],
                        'end_time' => $request->get('end_time')[$key],
                        'full_mark_theory' => $request->get('full_mark_theory')[$key],
                        'pass_mark_theory' => $request->get('pass_mark_theory')[$key],
                        'full_mark_practical' => $request->get('full_mark_practical')[$key],
                        'pass_mark_practical' => $request->get('pass_mark_practical')[$key],
                        'sorting_order' => $key+1,
                        'created_by' => auth()->user()->id,
                    ]);

                }
            }
            $request->session()->flash($this->message_success, $this->panel. ' Schedule Successfully.');
            return redirect()->route($this->base_route);
        }else{
            $request->session()->flash($this->message_warning, 'No Any Subject To Schedule.');
            return redirect()->route($this->base_route);
        }
    }

    public function delete(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
                                ['years_id', '=' , $year],
                                ['months_id', '=' , $month],
                                ['exams_id', '=' , $exam],
                                ['faculty_id', '=' , $faculty],
                                ['semesters_id', '=' , $semester],
                            ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $deleteSchedule = array_pluck($row, 'id');

        $deleteQuery = ExamSchedule::whereIn('id',$deleteSchedule)->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function active(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $activeStatus = array_pluck($row, 'id');

        $status = $request->request->add(['status' => 'active']);

        ExamSchedule::whereIn('id', $activeStatus)->update([
            'status' => 1
        ]);

        $request->session()->flash($this->message_success, $this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $activeStatus = array_pluck($row, 'id');

        $status = $request->request->add(['status' => 'active']);

        ExamSchedule::whereIn('id', $activeStatus)->update([
            'status' => 0
        ]);

        $request->session()->flash($this->message_success, $this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function subjectHtmlRow(Request $request)
    {
        //dd($request->all());;
        $response = [];
        $response['error'] = true;
        $whereCondition = [
                            ['years_id' , '=' , $request->get('years_id')],
                            ['months_id' , '=' , $request->get('months_id')],
                            ['exams_id', '=' , $request->get('exams_id')],
                            ['faculty_id', '=' , $request->get('faculty_id')],
                            ['semesters_id', '=' , $request->get('semester_id')]
                        ];
        if ($request->has('semester_id')) {
            //Get Subject From Schedule Examination
            $scheduledSubjects = ExamSchedule::select('subjects_id')
                ->where($whereCondition)
                ->get();

            /*Get Subjects Ids as Arrays*/
            $existSubject = array_pluck($scheduledSubjects, 'subjects_id');

            /*Get Semester Related Subjected Which is not scheduled*/
            $semester = Semester::find($request->get('semester_id'));

            if($existSubject) {
                /*Select Semester Subjects Which is not Scheduled Yet*/
                $subjects = $semester->subjects()->whereNotIn('subjects.id', $existSubject)->get();

                /*Get Scheduled Subject With Data*/
                $schedule = ExamSchedule::select('exam_schedules.subjects_id',
                    'exam_schedules.date', 'exam_schedules.start_time', 'exam_schedules.end_time',
                    'exam_schedules.full_mark_theory', 'exam_schedules.pass_mark_theory',
                    'exam_schedules.full_mark_practical',
                    'exam_schedules.pass_mark_practical','s.id as sub_id', 's.title')
                    ->where($whereCondition)
                    ->whereIn('exam_schedules.subjects_id', $existSubject)
                    ->join('subjects as s','s.id','=','exam_schedules.subjects_id')
                    ->orderBy('sorting_order','asc')
                    ->get();

                if ($schedule) {
                    $response['error'] = false;

                    $response['schedule'] = view($this->view_path.'.includes.subject_tr_rows', [
                        'schedules' => $schedule
                    ])->render();

                    $response['message'] = 'Operation Successful.';

                }

                if ($subjects) {
                    $response['error'] = false;

                    $response['html'] = view($this->view_path.'.includes.subject_tr', [
                        'subjects' => $subjects
                    ])->render();

                    $response['message'] = 'Operation Successful.';

                }
            }else{
                $subjects = $semester->subjects()->get();
                if ($subjects->count() >0) {
                    $response['error'] = false;

                    $response['html'] = view($this->view_path.'.includes.subject_tr', [
                        'subjects' => $subjects
                    ])->render();

                    $response['message'] = 'Operation Successful.';
                }else{
                    $response['message'] = 'Subject Not Assign on Semester.';
                }
            }

        } else{
            $response['message'] = $request->get('subject_id').'Invalid request!!';
        }

        return response()->json(json_encode($response));
    }


    public function publish(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $ids = array_pluck($row, 'id');


        ExamSchedule::whereIn('id', $ids)->update([
            'publish_status' => 1
        ]);

        $request->session()->flash($this->message_success, 'Exam Result Publish Successfully.');
        return redirect()->route($this->base_route);
    }

    public function unPublish(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $row = ExamSchedule::where([
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ])->get();

        if (!$row) return parent::invalidRequest();

        /*Get Subjects Ids as Arrays*/
        $ids = array_pluck($row, 'id');


        ExamSchedule::whereIn('id', $ids)->update([
            'publish_status' => 0
        ]);

        $request->session()->flash($this->message_success, 'Exam Result UnPublish Successfully.');
        return redirect()->route($this->base_route);
    }

}