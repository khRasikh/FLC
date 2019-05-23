<?php

namespace App\Http\Controllers\UserStudent;

use App\Charts\FeePayDueChart;
use App\Http\Controllers\CollegeBaseController;
use App\Models\Assignment;
use App\Models\AssignmentAnswer;
use App\Models\Attendance;
use App\Models\Document;
use App\Models\Download;
use App\Models\ExamSchedule;
use App\Models\FeeCollection;
use App\Models\FeeMaster;
use App\Models\LibraryMember;
use App\Models\Note;
use App\Models\Notice;
use App\Models\ResidentHistory;
use App\Models\Semester;
use App\Models\Student;
use App\Models\TransportHistory;
use App\Models\Year;
use App\Traits\ExaminationScope;
use App\Traits\StudentScopes;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ViewHelper, URL;

class HomeController extends CollegeBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    use ExaminationScope;
    protected $base_route = 'dashboard';
    protected $view_path = 'user-student';
    protected $panel = 'Dashboard';

    use StudentScopes;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info', 'students.student_image', 'students.status')
            ->where('students.id','=',$id)
            ->first();

        if (!$data['student']){
            request()->session()->flash($this->message_warning, "Not a Valid Student");
            return redirect()->route($this->base_route);
        }

        /*Notice*/
        $userRoleId = auth()->user()->roles()->first()->id;
        $now = date('Y-m-d');
        $data['notice_disaplay'] = Notice::select('last_updated_by', 'title', 'message',  'publish_date', 'end_date',
            'display_group', 'status')
            ->where('display_group','like','%'.$userRoleId.'%')
            ->where('publish_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->latest()
            ->get();

        $feeMaster = FeeMaster::where('students_id',$data['student']->id)->sum('fee_amount');
        $feeCollection = FeeCollection::where('students_id',$data['student']->id)->sum('paid_amount');
        $dueFee = $feeMaster - $feeCollection;

        /*chart*/
        $data['feeCompare'] = new FeePayDueChart('Paid','Due');
        $data['feeCompare']->dataset('Income', 'doughnut',[$feeCollection, $dueFee])
            ->options(['borderColor' => '#46b8da', 'backgroundColor'=>['#46b8da','#FF6384'] ]);


        return view(parent::loadDataToView($this->view_path.'.dashboard.index'), compact('data'));

    }


    public function profile()
    {
        $this->panel = "Profile | Student User";
        $id = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info', 'students.student_image', 'students.status', 'pd.grandfather_first_name',
            'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name', 'pd.father_middle_name',
            'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation', 'pd.father_office', 'pd.father_office_number',
            'pd.father_residence_number', 'pd.father_mobile_1', 'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name',
            'pd.mother_middle_name', 'pd.mother_last_name', 'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office',
            'pd.mother_office_number', 'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
            'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
            'ai.mobile_1', 'ai.mobile_2', 'gd.id as guardian_id', 'gd.guardian_email','gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
            'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number', 'gd.guardian_residence_number',
            'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email', 'gd.guardian_relation', 'gd.guardian_address')
            ->where('students.id','=',$id)
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->join('student_guardians as sg', 'sg.students_id','=','students.id')
            ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
            ->first();

        if (!$data['student']){
            request()->session()->flash($this->message_warning, "Not a Valid Student");
            return redirect()->route($this->base_route);
        }

        /*total Calculation on Table Foot*/
        $data['student']->fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $data['student']->discount = $data['student']->feeCollect()->sum('discount');
        $data['student']->fine = $data['student']->feeCollect()->sum('fine');
        $data['student']->paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $data['student']->balance =
            ($data['student']->fee_amount - ($data['student']->paid_amount + $data['student']->discount))+ $data['student']->fine;

        $data['document'] = Document::select('id', 'member_type','member_id', 'title', 'file','description', 'status')
            ->where('member_type','=','student')
            ->where('member_id','=',$data['student']->id)
            ->orderBy('created_by','desc')
            ->get();


        $data['note'] = Note::select('created_at', 'id', 'member_type','member_id','subject', 'note', 'status')
            ->where('member_type','=','student')
            ->where('member_id','=', $data['student']->id)
            ->orderBy('created_at','desc')
            ->get();

        $data['academicInfos'] = $data['student']->academicInfo()->orderBy('sorting_order','asc')->get();
        //login credential
        $data['student_login'] = User::where([['role_id',6],['hook_id',$data['student']->id]])->first();

        return view(parent::loadDataToView($this->view_path.'.detail.index'), compact('data'));
    }

    public function password(Request $request, $id)
    {
        if (!$row = User::find($id)) return parent::invalidRequest();

        if($request->password != $request->confirmPassword){
            $request->session()->flash($this->message_warning, 'Password & Confirm Password Not Match.');
            return redirect()->back();
        }

        if ($request->get('password')){
            $new_password= bcrypt($request->get('password'));
        }

        $request->request->add(['password' => isset($new_password)?$new_password:$row->password]);

        $row->update($request->all());

        $roles = [];
        $roles[] = [
            'user_id' => $row->id,
            'role_id' => $request->role_id
        ];

        $row->userRole()->sync($roles);

        $request->session()->flash($this->message_success, 'Login Detail Updated Successfully.');
        return redirect()->back();
    }

    public function fees()
    {
        $this->panel = "Fees | Student User";
        $id = auth()->user()->hook_id;
        $data = [];
        $today = Carbon::parse(today())->format('Y-m-d');
        $data['student'] = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
            'students.middle_name', 'students.last_name','students.faculty','students.semester','students.date_of_birth',
            'students.email', 'ai.mobile_1', 'pd.father_first_name', 'pd.father_middle_name', 'pd.father_last_name',
            'students.student_image','students.status')
            ->where('students.id','=',$id)
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->first();

        $data['fee_master'] = $data['student']->feeMaster()->orderBy('fee_due_date','desc')->get();
        $data['fee_collection'] = $data['student']->feeCollect()->get();

        $data['student']->payment_today = $data['student']->feeCollect()->where('date','=',$today)->sum('paid_amount');

        /*total Calculation on Table Foot*/
        $data['student']->fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $data['student']->discount = $data['student']->feeCollect()->sum('discount');
        $data['student']->fine = $data['student']->feeCollect()->sum('fine');
        $data['student']->paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $data['student']->balance =
            ($data['student']->fee_amount - ($data['student']->paid_amount + $data['student']->discount))+ $data['student']->fine;

        return view(parent::loadDataToView($this->view_path.'.fees.index'), compact('data'));
    }

    public function library()
    {
        $this->panel = "Library | Student User";
        $id = auth()->user()->hook_id;
        $data['lib_member'] = LibraryMember::where(['library_members.user_type' => 1, 'library_members.member_id' => $id])
            ->first();

        if($data['lib_member'] != null){
            $data['books_history'] = $data['lib_member']->libBookIssue()->select('book_issues.id', 'book_issues.member_id',
                'book_issues.book_id',  'book_issues.issued_on', 'book_issues.due_date','book_issues.return_date', 'b.book_masters_id',
                'b.book_code', 'bm.title','bm.categories')
                ->join('books as b','b.id','=','book_issues.book_id')
                ->join('book_masters as bm','bm.id','=','b.book_masters_id')
                ->orderBy('book_issues.issued_on', 'desc')
                ->get();

            $data['circulation'] = $data['lib_member']->libCirculation()->first();
        }

        return view(parent::loadDataToView($this->view_path.'.library.index'), compact('data'));
    }

    public function attendance()
    {
        $this->panel = "Attendance | Student User";
        $id = auth()->user()->hook_id;
        $data = [];
        $data['attendance'] = Attendance::select('attendances.id', 'attendances.attendees_type', 'attendances.link_id',
            'attendances.years_id', 'attendances.months_id', 'attendances.day_1', 'attendances.day_2', 'attendances.day_3',
            'attendances.day_4', 'attendances.day_5', 'attendances.day_6', 'attendances.day_7', 'attendances.day_8',
            'attendances.day_9', 'attendances.day_10', 'attendances.day_11', 'attendances.day_12', 'attendances.day_13',
            'attendances.day_14', 'attendances.day_15', 'attendances.day_16', 'attendances.day_17', 'attendances.day_18',
            'attendances.day_19', 'attendances.day_20', 'attendances.day_21', 'attendances.day_22', 'attendances.day_23',
            'attendances.day_24', 'attendances.day_25', 'attendances.day_26', 'attendances.day_27', 'attendances.day_28',
            'attendances.day_29', 'attendances.day_30', 'attendances.day_31')
            ->where('attendances.status', 1)
            ->where('attendances.attendees_type', 1)
            ->where('attendances.link_id',$id)
            ->join('students as s', 's.id', '=', 'attendances.link_id')
            ->orderBy('attendances.years_id','asc')
            ->orderBy('attendances.months_id','asc')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.attendance.index'), compact('data'));
    }


    public function hostel()
    {
        $this->panel = "Hostesl | Student User";
        $id = auth()->user()->hook_id;
        $data = [];

        $data['history'] = ResidentHistory::select('resident_histories.years_id', 'resident_histories.hostels_id',
            'resident_histories.rooms_id', 'resident_histories.beds_id',
            'resident_histories.history_type','resident_histories.created_at')
            ->where(['r.user_type' => 1, 'r.member_id' => $id])
            ->join('residents as r', 'r.id', '=', 'resident_histories.residents_id')
            ->join('beds as b', 'b.id', '=', 'resident_histories.beds_id')
            ->latest()
            ->get();

        return view(parent::loadDataToView($this->view_path.'.hostel.index'), compact('data'));
    }

    public function transport()
    {
        $this->panel = "Transport | Student User";
        $id = auth()->user()->hook_id;
        $data = [];

        /*Transport History*/
        $data['transport_history'] = TransportHistory::select('transport_histories.id', 'transport_histories.years_id',
            'transport_histories.routes_id', 'transport_histories.vehicles_id',  'transport_histories.history_type',
            'transport_histories.created_at','tu.member_id','tu.user_type')
            ->where(['tu.user_type' => 1, 'tu.member_id' => $id])
            ->join('transport_users as tu','tu.id','=','transport_histories.travellers_id')
            ->latest()
            ->get();

        return view(parent::loadDataToView($this->view_path.'.transport.index'), compact('data'));
    }

    public function subject()
    {
        $this->panel = "Course | Student User";
        $id = auth()->user()->hook_id;
        $student = Student::select('semester')->where('id',$id)->first();
        $data = [];
        $data['semester'] = Semester::find($student->semester);
        $data['subject'] = $data['semester']->subjects()->orderBy('title')->get();

        return view(parent::loadDataToView($this->view_path.'.subject.index'), compact('data'));
    }

    public function notice()
    {
        $this->panel = "Notice | Student User";
        $data = [];
        $userRoleId = auth()->user()->roles()->first()->id;
        $data['rows'] = Notice::select('id', 'title', 'message', 'publish_date', 'end_date', 'display_group','status')
            ->where('display_group','like','%'.$userRoleId.'%')
            ->latest()
            ->get();

        return view(parent::loadDataToView($this->view_path.'.notice.index'), compact('data'));
    }

    public function download()
    {
        $this->panel = "Download | Student User";
        $id = auth()->user()->hook_id;
        $student = Student::select('semester')->where('id',$id)->first();
        $data = [];
        $data['semester'] = Semester::find($student->semester);

        $data['download'] = Download::where(function ($query) use($student){
                            $query->where('semesters_id',$student->semester)
                                ->orWhere('semesters_id',null);
                        })
                        ->Active()
                        ->latest()
                        ->get();

        return view(parent::loadDataToView($this->view_path.'.download.index'), compact('data'));
    }


    /*Exam group*/
    public function exams()
    {
        $this->panel = "Exams | Student User";
        $id = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::find($id);
        $semester = Semester::find($data['student']->semester);
        $year = Year::where('active_status',1)->first();

        if(!$year) return back();

        $data['schedule_exams'] = ExamSchedule::select('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id', 'publish_status', 'status')
            ->where([['semesters_id',$semester->id],['years_id',$year->id]])
            ->groupBy('years_id', 'months_id', 'exams_id', 'faculty_id', 'semesters_id','publish_status', 'status')
            ->orderBy('years_id', 'desc')
            ->orderBy('months_id', 'asc')
            ->get();

        return view(parent::loadDataToView($this->view_path.'.exam.index'), compact('data'));
    }

    public function examSchedule(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $this->panel = "Exam Schedule | Student User";
        $id = auth()->user()->hook_id;
        $student_id = $id;
        $data = [];
        $whereCondition = [
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ];

        $examSchedule = ExamSchedule::where($whereCondition)
            ->get();

        $exam_schedule_id = array_pluck($examSchedule,'id');

        $data['subjects'] = ExamSchedule::select('exam_schedules.id','exam_schedules.subjects_id',
            'exam_schedules.date', 'exam_schedules.start_time', 'exam_schedules.end_time',
            'exam_schedules.full_mark_theory', 'exam_schedules.pass_mark_theory',
            'exam_schedules.full_mark_practical',
            'exam_schedules.pass_mark_practical', 's.code', 's.title')
            ->where([
                ['exam_schedules.years_id', '=' , $year],
                ['exam_schedules.months_id', '=' , $month],
                ['exam_schedules.exams_id', '=' , $exam],
                ['exam_schedules.faculty_id', '=' , $faculty],
                ['exam_schedules.semesters_id', '=' , $semester],
            ])
            ->join('subjects as s','s.id','=','exam_schedules.subjects_id')
            ->orderBy('exam_schedules.date','asc')
            ->get();

        if($data['subjects']->count() == 0)
            return back()->with($this->message_warning, 'No any Subject Scheduled in your target exam. Please, Schedule exam first. ');

        $data['year'] = $year;
        $data['month'] = $month;
        $data['exam'] = $exam;
        $data['faculty'] = $faculty;
        $data['semester'] = $semester;

        return view(parent::loadDataToView($this->view_path.'.exam.routine'), compact('data'));
    }

    public function admitCard(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $this->panel = "Admit Card | Student User";
        $id = auth()->user()->hook_id;
        $data = [];
        $whereCondition = [
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ];
        $data['subjects'] = ExamSchedule::where($whereCondition)
            ->get();

        if($data['subjects']->count() == 0)
            return back()->with($this->message_warning, 'No any Subject Scheduled in your target exam.');

        $data['student'] = Student::select('id','reg_no','date_of_birth', 'first_name', 'middle_name', 'last_name','student_image','gender','blood_group' ,'faculty', 'semester','status')
            ->where('id',$id)
            ->get();

        $data['year'] = $year;
        $data['month'] = $month;
        $data['exam'] = $exam;
        $data['faculty'] = $faculty;
        $data['semester'] = $semester;

        return view(parent::loadDataToView($this->view_path.'.exam.admit-card'), compact('data'));
    }

    public function examScore(Request $request, $year=null,$month=null,$exam=null,$faculty=null,$semester=null)
    {
        $id = auth()->user()->hook_id;
        $student_id = $id;
        $data = [];
        $whereCondition = [
            ['years_id', '=' , $year],
            ['months_id', '=' , $month],
            ['exams_id', '=' , $exam],
            ['faculty_id', '=' , $faculty],
            ['semesters_id', '=' , $semester],
        ];

        $examSchedule = ExamSchedule::where($whereCondition)
            ->get();

        $exam_schedule_id = array_pluck($examSchedule,'id');
        $semester = Semester::find($semester);

        $students = Student::select('id','reg_no', 'first_name','middle_name','last_name','date_of_birth',
            'faculty','semester')
            ->where('id', $student_id)
            ->get();

        /*filter student with schedule subject markledger*/
        $filteredStudent  = $students->filter(function ($value, $key) use ($exam_schedule_id, $semester){
            $subject = $value->markLedger()
                ->select( 'exam_schedule_id',  'obtain_mark_theory', 'obtain_mark_practical','absent_theory','absent_practical')
                ->whereIn('exam_schedule_id', $exam_schedule_id)
                ->get();

            //filter subject and joint mark from schedules;
            $filteredSubject  = $subject->filter(function ($subject, $key) use($exam_schedule_id, $semester){
                $joinSub = $subject->examSchedule()
                    ->select('subjects_id','full_mark_theory', 'pass_mark_theory', 'full_mark_practical', 'pass_mark_practical','sorting_order')
                    ->whereIn('id',$exam_schedule_id)
                    ->where('publish_status',1)
                    ->first();

                if(!$joinSub) return back();

                $subject->subjects_id = $joinSub->subjects_id;

                $subject->sorting_order = $joinSub->sorting_order;
                $subject->full_mark_theory =$full_mark_theory = $joinSub->full_mark_theory;
                $subject->pass_mark_theory = $pass_mark_theory = $joinSub->pass_mark_theory;
                $subject->full_mark_practical = $full_mark_practical = $joinSub->full_mark_practical;
                $subject->pass_mark_practical = $pass_mark_practical = $joinSub->pass_mark_practical;
                $obtain_mark_theory = $subject->obtain_mark_theory;
                $absent_theory = $subject->absent_theory;
                $obtain_mark_practical = $subject->obtain_mark_practical;
                $absent_practical = $subject->absent_practical;

                /*th absent*/
                if($absent_theory != 1) {
                    if ($full_mark_theory > 0) {
                        $th_per = ($obtain_mark_theory * 100) / $full_mark_theory;
                        $subject->obtain_score_theory = $th_per ==0?'*NG':$this->getGrade($semester, $th_per);
                    }
                }else{
                    $subject->obtain_score_theory = "*AB";
                }

                /*pr absent*/
                if($absent_practical != 1) {
                    if($full_mark_practical > 0) {
                        $pr_per = ($obtain_mark_practical * 100) / $full_mark_practical;
                        $subject->obtain_score_practical = $pr_per ==0?"*NG":$this->getGrade($semester, $pr_per);
                    }
                }else{
                    $pr_per = 0;
                    $subject->obtain_score_practical = "*AB";
                }

                /*check absend on theory & practical*/
                $absentBoth = false;
                if($absent_theory == 1 && $absent_practical == 1){
                    $absentBoth = true;
                }

                //Final Grade
                $totalMark = $full_mark_theory + $full_mark_practical;
                $obtainedMark = $obtain_mark_theory + $obtain_mark_practical;
                $percentage = ($obtainedMark*100)/ $totalMark;
                //verify both th & pr absent
                if($absentBoth == false) {
                    $subject->final_grade = $this->getGrade($semester, $percentage);
                    $subject->grade_point = $this->getPoint($semester, $percentage);
                    $subject->remark = $this->getRemark($semester, $percentage);
                }else{
                    $subject->final_grade = "*MG";
                    $subject->grade_point = "*MP";
                    $subject->remark = "-";
                }

                return $subject;
            });


            //order subject order on schedule
            $value->subjects = $filteredSubject->sortBy('sorting_order');

            /*calculate GPA*/
            /*calculate total mark & percentage*/
            $gp_collection = array_pluck($value->subjects,'grade_point');
            //dd($gp_collection);
            $filtered_gp_collection  =  array_where($gp_collection, function ($value, $key) {
                return is_numeric($value);
            });

            $gradePoint = array_sum($filtered_gp_collection);
            $value->gpa = number_format($gradePoint, '1');

            return $value;
        });

        $data['student'] = $filteredStudent;

        $data['year'] = $year;
        $data['month'] = $month;
        $data['exam'] = $exam;
        $data['faculty'] = $faculty;
        $data['semester'] = $semester->id;

        return view(parent::loadDataToView($this->view_path.'.exam.grading-sheet'), compact('data'));
    }


    /*assignment group*/
    public function assignment()
    {
        $this->panel = "Assignment | Student User";
        $id = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::find($id);
        $semester = Semester::find($data['student']->semester);
        if(!$semester) return back();
        $semester = $semester->id;

        $year = Year::where('active_status',1)->first();
        if(!$year) return back();
        $year = $year->id;

        $data['assignment'] = Assignment::select('id','created_by', 'last_updated_by', 'years_id','semesters_id', 'subjects_id', 'publish_date',
            'end_date', 'title','description','file', 'status')
            ->where('years_id',$year)
            ->where('semesters_id',$semester)
            ->Active()
            ->latest()
            ->get();

        return view(parent::loadDataToView($this->view_path.'.assignment.index'), compact('data'));
    }

    public function addAnswer(Request $request, $id)
    {
        $this->panel = "Submit Assignment | Student User";
        $studentId = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::find($studentId);
        $semester = Semester::find($data['student']->semester)->id;
        $year = Year::where('active_status',1)->first()->id;

        if(!$year) return back();

        $getAnswer = AssignmentAnswer::where('assignments_id',$id)->where('students_id', $studentId)->first();
        if($getAnswer){
            $request->session()->flash($this->message_warning,'Your Previous Answer Exist Please Edit Your Answer.');
            return redirect(route('user-student.assignment'));
        }

        $data['assignment'] = Assignment::select('id','created_by', 'last_updated_by', 'years_id','semesters_id', 'subjects_id', 'publish_date',
            'end_date', 'title','description','file', 'status')
            ->where('id',$id)
            ->where('years_id',$year)
            ->where('semesters_id',$semester)
            ->first();

        $now = date('Y-m-d');
        if($data['assignment']->end_date){
            if($data['assignment']->end_date <= $now) {
                $request->session()->flash($this->message_warning, 'You Can Not Submit Answer Because of Time Limitation ');
                return redirect(route('user-student.assignment'));
            }
        }

        return view(parent::loadDataToView($this->view_path.'.assignment.answer.add'), compact('data'));
    }

    public function storeAnswer(Request $request)
    {
        $studentId = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::find($studentId);
        $folder_path = public_path().DIRECTORY_SEPARATOR.'assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR;

        $assignment = Assignment::find($request->get('assignments_id'));

        if(!$assignment) return back();

        $getAnswer = AssignmentAnswer::where('assignments_id',$assignment->id)->where('students_id', $studentId)->first();
        if($getAnswer){
            $request->session()->flash($this->message_warning,'Your Previous Answer Exist. Please Edit Your Answer.');
            return redirect(route('user-student.assignment'));
        }

        if ($request->hasFile('attach_file')){
            $name = str_slug($assignment->title);
            $file = $request->file('attach_file');
            $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($folder_path, $file_name);
        }else{
            $file_name = "";
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['assignments_id' => $assignment->id]);
        $request->request->add(['students_id' => $data['student']->id]);
        $request->request->add(['file' => $file_name]);

        AssignmentAnswer::create($request->all());

        $request->session()->flash($this->message_success,'Answer Add Successfully.');

        return redirect(route('user-student.assignment'));
    }

    public function editAnswer(Request $request, $id)
    {
        $this->panel = "Edit Assignment | Student User";
        $studentId = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::find($studentId);
        $semester = Semester::find($data['student']->semester)->id;
        $year = Year::where('active_status',1)->first()->id;

        if(!$year) return back();

        $data['row'] = AssignmentAnswer::where('assignments_id',$id)->where('students_id', $studentId)->first();

        if(!$data['row']) {
            $request->session()->flash($this->message_warning,'Answer Not Found. Please Create Your Answer First.');
            return redirect()->route('user-student.assignment');
        }

        if($data['row']->approve_status == 1){
            $request->session()->flash($this->message_warning,' Your Answer is Approved. So, You can not change the approved answer.');
            return redirect(route('user-student.assignment'));
        }

        if($data['row']->approve_status == 2){
            $request->session()->flash($this->message_danger,' Your Answer is Rejected. So, Contact You Subject Teacher.');
            return redirect(route('user-student.assignment'));
        }

        $data['assignment'] = Assignment::select('id','created_by', 'last_updated_by', 'years_id','semesters_id', 'subjects_id', 'publish_date',
            'end_date', 'title','description','file', 'status')
            ->where('id',$id)
            ->where('years_id',$year)
            ->where('semesters_id',$semester)
            ->first();


        return view(parent::loadDataToView($this->view_path.'.assignment.answer.edit'), compact('data'));
    }

    public function updateAnswer(Request $request, $id)
    {

        if (!$row = AssignmentAnswer::find($id)) return parent::invalidRequest();

        $studentId = auth()->user()->hook_id;
        $data = [];
        $data['student'] = Student::find($studentId);
        $folder_path = public_path().DIRECTORY_SEPARATOR.'assignments'.DIRECTORY_SEPARATOR.'answers'.DIRECTORY_SEPARATOR;

        $assignment = Assignment::find($request->assignments_id);

        if ($request->hasFile('attach_file')){
            $name = str_slug($assignment->title);
            $file = $request->file('attach_file');
            $file_name = rand(4585, 9857).'_'.$name.'.'.$file->getClientOriginalExtension();
            $file->move($folder_path, $file_name);

            if (file_exists($folder_path.$row->file))
                @unlink($folder_path.$row->file);
        }else{
            $file_name = $row->file;
        }

        $request->request->add(['created_by' => auth()->user()->id]);
        $request->request->add(['assignments_id' => $assignment->id]);
        $request->request->add(['students_id' => $data['student']->id]);
        $request->request->add(['file' => $file_name]);

        $year = Year::where('active_status',1)->first()->id;

        $request->request->add(['years_id' => $year]);
        $request->request->add(['last_updated_by' => auth()->user()->id]);
        $request->request->add(['file' => isset($file_name)?$file_name:$row->file]);

        $row->update($request->all());

        $request->session()->flash($this->message_success,'Answer Updated Successfully.');
        return redirect(route('user-student.assignment'));
    }

    public function viewAssignmentAnswer(Request $request, $id, $answer)
    {
        $this->panel = "Assignment Detail | Student User";
        $data = [];
        $studentId = auth()->user()->hook_id;
        $data['student'] = Student::find($studentId);

        $data['assignment'] = Assignment::find($id);

        $data['answers'] = $data['assignment']->answers()->where('assignment_answers.id',$answer)
            ->select('assignment_answers.created_by','assignment_answers.last_updated_by','assignment_answers.id','assignment_answers.answer_text',
                'assignment_answers.file','assignment_answers.approve_status','assignment_answers.status','s.id as students_id')
            ->join('students as s','s.id','=','assignment_answers.students_id')
            ->first();

        if(!$data['answers']) {
            $request->session()->flash($this->message_warning,'Answer Not Found.');
            return redirect()->route('user-student.assignment');
        }

        $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
            'students.faculty','students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
            'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.nationality',
            'students.mother_tongue', 'students.email', 'students.extra_info', 'students.student_image', 'students.status')
            ->where('students.id','=',$data['answers']->students_id)
            ->first();

        return view(parent::loadDataToView('user-student.assignment.view.index'), compact('data'));
    }

}
