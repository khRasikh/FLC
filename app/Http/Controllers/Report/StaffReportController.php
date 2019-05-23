<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Staff;
use App\Models\StaffDesignation;
use Illuminate\Http\Request;
use Image, URL;
use ViewHelper;

class StaffReportController extends CollegeBaseController
{
    protected $base_route = 'report.staff';
    protected $view_path = 'report.staff';
    protected $panel = 'Staff Report';
    protected $filter_query = [];


    public function __construct()
    {
    }

    public function index(Request $request)
    {
        $data = [];
        $data['staff'] = Staff::select('id','reg_no', 'join_date', 'designation', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mother_name', 'date_of_birth', 'gender', 'blood_group', 'nationality','mother_tongue', 'address', 'state', 'country',
            'temp_address', 'temp_state', 'temp_country', 'home_phone', 'mobile_1', 'mobile_2', 'email', 'qualification',
            'experience', 'experience_info', 'other_info','status')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('reg_no', 'like', '%'.$request->reg_no.'%');
                    $this->filter_query['reg_no'] = $request->reg_no;
                }

                if ($request->has('designation')) {
                    $query->where('designation', 'like', '%'.$request->designation.'%');
                    $this->filter_query['designation'] = $request->designation;
                }

                if ($request->has('status')) {
                    $query->where('status', $request->status == 'active'?1:0);
                    $this->filter_query['status'] = $request->get('status');
                }

            })
            ->get();

        $data['designations'] = $this->staffDesignationList();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function staffDesignationList()
    {
        /*get designation*/
        $designation = StaffDesignation::select('id','title')->orderBy('title')->get();
        $designation = array_pluck($designation,'title','id');
        $designation = array_prepend($designation,'Select Designation...','0');

        /*designation represent as list*/
        return $designation;
    }

}
