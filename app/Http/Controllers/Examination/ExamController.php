<?php
/**
 * Created by PhpStorm.
 * User: Umesh Kumar Yadav
 * Date: 03/03/2018
 * Time: 7:05 PM
 */
namespace App\Http\Controllers\Examination;

use App\Http\Controllers\CollegeBaseController;
use App\Http\Requests\Examination\Exam\AddValidation;
use App\Http\Requests\Examination\Exam\EditValidation;
use App\Models\Exam;
use App\Models\ExamMarkLedger;
use App\Models\ExamSchedule;
use App\Models\Faculty;
use App\Models\Month;
use App\Models\Student;
use App\Models\StudentStatus;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ExamController extends CollegeBaseController
{
    protected $base_route = 'exam';
    protected $view_path = 'examination.exam';
    protected $panel = 'Exams';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['exams'] = Exam::select('id', 'title', 'status')->get();
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function store(AddValidation $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);

        Exam::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Created Successfully.');
        return redirect()->route($this->base_route);
    }

    public function edit(Request $request, $id)
    {
        $data = [];
        if (!$data['row'] = Exam::find($id))
            return parent::invalidRequest();

        $data['exams'] = Exam::select('id', 'title', 'status')->orderBy('title')->get();

        $data['base_route'] = $this->base_route;
        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function update(EditValidation $request, $id)
    {

        if (!$row = Exam::find($id)) return parent::invalidRequest();

        $request->request->add(['last_updated_by' => auth()->user()->id]);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $this->panel.' Updated Successfully.');
        return redirect()->route($this->base_route);
    }

    public function delete(Request $request, $id)
    {
        if (!$row = Exam::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return redirect()->route($this->base_route);
    }

    public function bulkAction(Request $request)
    {
        if ($request->has('bulk_action') && in_array($request->get('bulk_action'), ['active', 'in-active', 'delete'])) {

            if ($request->has('chkIds')) {
                foreach ($request->get('chkIds') as $row_id) {
                    switch ($request->get('bulk_action')) {
                        case 'active':
                        case 'in-active':
                            $row = Exam::find($row_id);
                            if ($row) {
                                $row->status = $request->get('bulk_action') == 'active'?'active':'in-active';
                                $row->save();
                            }
                            break;
                        case 'delete':
                            $row = Exam::find($row_id);
                            $row->delete();
                            break;
                    }
                }

                if ($request->get('bulk_action') == 'active' || $request->get('bulk_action') == 'in-active')
                    $request->session()->flash($this->message_success, $request->get('bulk_action'). ' Action Successfully.');
                else
                    $request->session()->flash($this->message_success, 'Deleted successfully.');

                return redirect()->route($this->base_route);

            } else {
                $request->session()->flash($this->message_warning, 'Please, Check at least one row.');
                return redirect()->route($this->base_route);
            }

        } else return parent::invalidRequest();

    }

    public function active(request $request, $id)
    {
        if (!$row = Exam::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function inActive(request $request, $id)
    {
        if (!$row = Exam::find($id)) return parent::invalidRequest();

        $request->request->add(['status' => 'in-active']);

        $row->update($request->all());

        $request->session()->flash($this->message_success, $row->semester.' '.$this->panel.' In-Active Successfully.');
        return redirect()->route($this->base_route);
    }

    public function admitCard(Request $request)
    {
       // dd('ok');
        $data = [];
        if($request->all()) {
            $data['student'] = Student::select('id', 'reg_no', 'reg_date', 'first_name', 'middle_name', 'last_name', 'faculty', 'semester', 'status')
                ->where(function ($query) use ($request) {

                    if ($request->has('reg_no')) {
                        $query->where('students.reg_no', 'like', '%' . $request->reg_no . '%');
                        $this->filter_query['students.reg_no'] = $request->reg_no;
                    }

                    if ($request->has('reg-start-date') && $request->has('update-end-date')) {
                        $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('update-end-date')]);
                        $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                        $this->filter_query['update-end-date'] = $request->get('update-end-date');
                    } elseif ($request->has('reg-start-date')) {
                        $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                        $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                    } elseif ($request->has('reg-end-date')) {
                        $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                        $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                    }

                    if ($request->has('faculty')) {
                        $query->where('students.faculty', 'like', '%' . $request->faculty . '%');
                        $this->filter_query['students.faculty'] = $request->faculty;
                    }

                    if ($request->has('semester')) {
                        $query->where('students.semester', 'like', '%' . $request->semester . '%');
                        $this->filter_query['students.semester'] = $request->semester;
                    }

                    if ($request->has('status')) {
                        $query->where('students.status', $request->status == 'active' ? 1 : 0);
                        $this->filter_query['students.status'] = $request->get('status');
                    }

                })
                ->get();
        }

        $faculties = Faculty::select('id', 'faculty')->get();
        $faculties = array_pluck($faculties,'faculty','id');
        $faculties = array_prepend($faculties,'Select Faculty','0');
        $data['faculties'] = $faculties;

        $studentStatus = StudentStatus::select('id', 'title')->get();
        $studentStatus = array_pluck($studentStatus,'title','id');
        $studentStatus = array_prepend($studentStatus,'Select Status','0');
        $data['student_status'] = $studentStatus;


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

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView('examination.admit-card.index'), compact('data'));
    }

    public function examRoutine(Request $request)
    {
        $data = [];
        $faculties = Faculty::select('id', 'faculty')->get();
        $faculties = array_pluck($faculties,'faculty','id');
        $faculties = array_prepend($faculties,'Select Faculty','0');
        $data['faculties'] = $faculties;

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

        return view(parent::loadDataToView('examination.routine.index'), compact('data'));
    }

    public function markSheet(Request $request)
    {
        $data = [];
        if($request->all()){
            $year = $request->get('year');
            $month = $request->get('month');
            $exam = $request->get('exam');
            $faculty = $request->get('faculty');
            $semester = $request->get('semester');

            if($year && $month && $exam && $faculty && $semester) {
                $examScheduleCondition = [
                    ['years_id', '=', $year],
                    ['months_id', '=', $month],
                    ['exams_id', '=', $exam],
                    ['faculty_id', '=', $faculty],
                    ['semesters_id', '=', $semester]
                ];

                /*Find Exam Schedule Id*/
                $examScheduleId = ExamSchedule::select('id')
                    ->where($examScheduleCondition)
                    ->get();
                $examScheduleId = array_pluck($examScheduleId, 'id');
                if(count($examScheduleId) > 0){
                    $data['ledger_exist'] = ExamMarkLedger::select('exam_mark_ledgers.exam_schedule_id', 'exam_mark_ledgers.students_id',
                        'exam_mark_ledgers.obtain_mark_theory', 'exam_mark_ledgers.obtain_mark_practical', 'exam_mark_ledgers.absent_theory','exam_mark_ledgers.absent_practical',
                        'exam_mark_ledgers.status', 's.id as student_id', 's.reg_no', 's.first_name', 's.middle_name', 's.last_name',
                        's.last_name')
                        ->where('exam_mark_ledgers.exam_schedule_id', $examScheduleId)
                        ->join('students as s', 's.id', '=', 'exam_mark_ledgers.students_id')
                        ->orderBy('exam_mark_ledgers.students_id','asc')
                        ->get();
                }else{
                    $request->session()->flash($this->message_warning, 'No any Examination Scheduled. for Your Target Exam. Please Schedule First.');
                    return redirect()->back();
                }

            }

            if($data['ledger_exist']){
                $data['exam_schedule_id'] = implode(',',$examScheduleId);
            }

        }else{
            $data['exam_schedule_id'] = 0;
        }

        $data['exam'] = isset($exam)?$exam:'';
        $data['year'] = isset($year)?$year:'';
        $data['faculty'] = isset($faculty)?$faculty:'';
        $data['semester'] = isset($semester)?$semester:'';

        $data['years'] = [];
        $data['years'][0] = 'Select Year...';
        foreach (Year::select('id', 'title')->Active()->orderBy('title')->get() as $year) {
            $data['years'][$year->id] = $year->title;
        }

        $data['months'] = [];
        $data['months'][0] = 'Select Month...';
        foreach (Month::select('id', 'title')->orderBy('id')->Active()->get() as $month) {
            $data['months'][$month->id] = $month->title;
        }

        $data['exams'] = [];
        $data['exams'][0] = 'Select Exam...';
        foreach (Exam::select('id', 'title')->orderBy('title')->Active()->get() as $exam) {
            $data['exams'][$exam->id] = $exam->title;
        }

        $data['faculties'] = [];
        $data['faculties'][0] = 'Select Facult...';
        foreach (Faculty::select('id', 'faculty')->orderBy('faculty')->Active()->get() as $faculty) {
            $data['faculties'][$faculty->id] = $faculty->faculty;
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView('examination.mark-sheet.index'), compact('data'));
    }


}