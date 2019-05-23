<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Faculty;
use App\Models\Student;
use Illuminate\Http\Request;
use  URL;
use ViewHelper;

class StudentReportController extends CollegeBaseController
{
    protected $base_route = 'report.student';
    protected $view_path = 'report.student';
    protected $panel = 'Student Report';
    protected $filter_query = [];

    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data = [];
        if ($request->all()){
            $data['student'] = Student::select('students.id','students.reg_no', 'students.reg_date', 'students.university_reg',
                'students.faculty', 'students.semester', 'students.academic_status', 'students.first_name', 'students.middle_name',
                'students.last_name', 'students.date_of_birth', 'students.gender', 'students.blood_group', 'students.nationality',
                'students.mother_tongue', 'students.email', 'students.extra_info', 'students.status',
                'pd.grandfather_first_name', 'pd.grandfather_middle_name', 'pd.grandfather_last_name', 'pd.father_first_name',
                'pd.father_middle_name', 'pd.father_last_name', 'pd.father_eligibility', 'pd.father_occupation',
                'pd.father_office', 'pd.father_office_number', 'pd.father_residence_number', 'pd.father_mobile_1',
                'pd.father_mobile_2', 'pd.father_email', 'pd.mother_first_name', 'pd.mother_middle_name', 'pd.mother_last_name',
                'pd.mother_eligibility', 'pd.mother_occupation', 'pd.mother_office', 'pd.mother_office_number',
                'pd.mother_residence_number', 'pd.mother_mobile_1', 'pd.mother_mobile_2', 'pd.mother_email',
                'gd.guardian_first_name', 'gd.guardian_middle_name', 'gd.guardian_last_name',
                'gd.guardian_eligibility', 'gd.guardian_occupation', 'gd.guardian_office', 'gd.guardian_office_number',
                'gd.guardian_residence_number', 'gd.guardian_mobile_1', 'gd.guardian_mobile_2', 'gd.guardian_email',
                'gd.guardian_relation', 'gd.guardian_address',
                'ai.address', 'ai.state', 'ai.country', 'ai.temp_address', 'ai.temp_state', 'ai.temp_country', 'ai.home_phone',
                'ai.mobile_1', 'ai.mobile_2')
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
                ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
                ->join('student_guardians as sg', 'sg.students_id','=','students.id')
                ->join('guardian_details as gd', 'gd.id', '=', 'sg.guardians_id')
                ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
                ->get();
        }

        $data['faculties'] = [];
        $data['faculties'][0] = 'Select Facult';
        foreach (Faculty::select('id', 'faculty')->get() as $faculty) {
            $data['faculties'][$faculty->id] = $faculty->faculty;
        }

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }
}
