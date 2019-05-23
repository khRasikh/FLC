<?php

namespace App\Http\Controllers\Account\Payroll;

use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeMaster;
use App\Models\SalaryPay;
use App\Models\Staff;
use Illuminate\Http\Request;
use view, URL;
use ViewHelper;
class SalaryPayController extends CollegeBaseController
{
    protected $base_route = 'account.salary.payment';
    protected $view_path = 'account.payroll.payment';
    protected $panel = 'Salary Pay';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['staff'] = Staff::select('id', 'reg_no', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mobile_1','designation','qualification','status')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('reg_no', 'like', '%'.$request->reg_no.'%');
                    $this->filter_query['reg_no'] = $request->reg_no;
                }

                if ($request->has('join_date_start') && $request->has('join_date_end')) {
                    $query->whereBetween('join_date', [$request->get('join_date_start'), $request->get('join_date_end')]);
                    $this->filter_query['join_date_start'] = $request->get('join_date_start');
                    $this->filter_query['join_date_end'] = $request->get('join_date_end');
                }
                elseif ($request->has('join_date_start')) {
                    $query->where('join_date', '>=', $request->get('join_date_start'));
                    $this->filter_query['join_date_start'] = $request->get('join_date_start');
                }
                elseif($request->has('join_date_end')) {
                    $query->where('join_date', '<=', $request->get('join_date_end'));
                    $this->filter_query['join_date_end'] = $request->get('join_date_end');
                }

                if ($request->has('status')) {
                    $query->where('status', $request->status == 'active'?1:0);
                    $this->filter_query['status'] = $request->get('status');
                }

            })
            ->orderBy('join_date','desc')
            ->get();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function view(Request $request, $id)
    {
        $data = [];
        $data['staff'] = Staff::select('id','reg_no', 'join_date', 'first_name',  'middle_name', 'last_name',
            'date_of_birth', 'home_phone','email', 'mobile_1', 'designation','qualification','staff_image', 'status')
            ->where('id','=',$id)
            ->first();

        $data['payroll_master'] = $data['staff']->payrollMaster()->orderBy('due_date','desc')->get();
        $data['pay_salary'] = $data['staff']->paySalary()->get();

        /*total Calculation on Table Foot*/
        $data['staff']->amount = $data['staff']->payrollMaster()->sum('amount');
        $data['staff']->allowance = $data['staff']->paySalary()->sum('allowance');
        $data['staff']->fine = $data['staff']->paySalary()->sum('fine');
        $data['staff']->paid_amount = $data['staff']->paySalary()->sum('paid_amount');
        $data['staff']->balance =
            ($data['staff']->amount + $data['staff']->allowance) - ($data['staff']->paid_amount + $data['staff']->fine) ;

       //dd($data['student']->toarray());
        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.pay.index'), compact('data'));
    }

    public function add(Request $request, $id)
    {
        $data = [];
        $data['fee_master'] = FeeMaster::select('id', 'students_id', 'semester', 'fee_head','fee_due_date','fee_amount','status')
            ->where('students_id','=',$data['student']->id)
            ->get();


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;


        return view(parent::loadDataToView($this->view_path.'.collect.add'), compact('data'));
    }

    public function store(Request $request)
    {
        $request->request->add(['created_by' => auth()->user()->id]);
        $faculty = SalaryPay::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. ' Successfully.');
        return back();
    }

    public function delete(Request $request, $id)
    {
        if (!$row = SalaryPay::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return back();
    }


}
