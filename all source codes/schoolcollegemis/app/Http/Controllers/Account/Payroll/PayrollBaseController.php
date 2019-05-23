<?php

namespace App\Http\Controllers\Account\Payroll;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Staff;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class PayrollBaseController extends CollegeBaseController
{
    protected $base_route = 'account.payroll.balance';
    protected $view_path = 'account.payroll.balance';
    protected $panel = 'Payroll';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {

        $data = [];
        $staffs = Staff::select('id', 'reg_no', 'join_date', 'first_name',  'middle_name', 'last_name',
            'father_name', 'mobile_1','staff_image','status')
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
            ->get();

        /*filter due using call back*/
        $filtered  = $staffs->filter(function ($staff) {
            $staff->amount = $staff->payrollMaster()->sum('amount');
            $staff->allowance = $staff->paySalary()->sum('allowance');
            $staff->paid_amount = $staff->paySalary()->sum('paid_amount');
            $staff->fine = $staff->paySalary()->sum('fine');
            $staff->balance = ($staff->amount + $staff->allowance) - ($staff->paid_amount+ $staff->fine);
            if($staff->balance > 0){
                return $staff;
            }
        });

        $data['staff'] = $filtered;

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

}
