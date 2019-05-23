<?php

namespace App\Http\Controllers\Account\Fees;

use App\Http\Controllers\CollegeBaseController;
use App\Models\Faculty;
use App\Models\FeeCollection;
use App\Models\FeeHead;
use App\Models\Student;
use Illuminate\Http\Request;
use URL;
use ViewHelper;
class FeesBaseController extends CollegeBaseController
{
    protected $base_route = 'account.fees';
    protected $view_path = 'account.fees';
    protected $panel = 'Fees';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['feesCollection'] = FeeCollection::select('fee_collections.students_id', 'fee_collections.fee_masters_id',
            'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
            'fee_collections.payment_mode','fee_collections.created_by', 's.reg_no','s.reg_date', 's.first_name',
            's.middle_name', 's.last_name','fm.semester')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('s.reg_no', 'like', '%'.$request->get('reg_no').'%');
                    $this->filter_query['s.reg_no'] = $request->get('reg_no');
                }

                if ($request->has('fee-collection-date-start') && $request->has('fee-collection-date-end')) {
                    $query->whereBetween('fee_collections.date', [$request->get('fee-collection-date-start'), $request->get('fee-collection-date-end')]);
                    $this->filter_query['fee-collection-date-start'] = $request->get('fee-collection-date-start');
                    $this->filter_query['fee-collection-date-end'] = $request->get('fee-collection-date-end');
                }
                elseif ($request->has('fee-collection-date-start')) {
                    $query->where('fee_collections.date', '>=', $request->get('fee-collection-date-start'));
                    $this->filter_query['fee-collection-date-start'] = $request->get('fee-collection-date-start');
                }
                elseif($request->has('fee-collection-date-end')) {
                    $query->where('fee_collections.date', '<=', $request->get('fee-collection-date-end'));
                    $this->filter_query['fee-collection-date-end'] = $request->get('fee-collection-date-end');
                }

                if ($request->has('feeheads')) {
                    $query->where('fee_collections.fee_masters_id', '=', $request->get('feeheads'));
                    $this->filter_query['fee_head'] = $request->get('feeheads');
                }

                if ($request->has('semester')) {
                    $query->where('fm.semester', 'like', '%'.$request->semester.'%');
                    $this->filter_query['semester'] = $request->semester;
                }

            })
            ->join('students as s', 's.id','=','fee_collections.students_id')
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->get();


        $feeHead = FeeHead::select('id', 'fee_head_title')->Active()->pluck('fee_head_title','id')->toArray();
        $data['fee_heads'] = array_prepend($feeHead,'Select Fee Head',0);

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function balance(Request $request)
    {
        $data = [];
        $students = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
            'students.middle_name', 'students.last_name','students.faculty','students.semester', 'students.student_image','students.status',
            'pd.father_first_name', 'pd.father_middle_name','pd.father_last_name')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('students.reg_no', 'like', '%'.$request->reg_no);
                    $this->filter_query['students.reg_no'] = $request->reg_no;
                }

                if ($request->has('reg-start-date') && $request->has('reg-end-date')) {
                    $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('reg-end-date')]);
                    $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                    $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                }
                elseif ($request->has('reg-start-date')) {
                    $query->where('students.reg_date', '>=', $request->get('reg-start-date'));
                    $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                }
                elseif($request->has('reg-end-date')) {
                    $query->where('students.reg_date', '<=', $request->get('reg-end-date'));
                    $this->filter_query['reg-end-date'] = $request->get('reg-end-date');
                }

                if ($request->has('faculty')) {
                    $query->where('students.faculty', 'like', '%'.$request->faculty.'%');
                    $this->filter_query['students.faculty'] = $request->faculty;
                }

                if ($request->has('semester')) {
                    $query->where('students.semester', 'like', '%'.$request->semester.'%');
                    $this->filter_query['students.semester'] = $request->semester;
                }

                if ($request->has('status')) {
                    $query->where('students.status', $request->status == 'active'?1:0);
                    $this->filter_query['students.status'] = $request->get('status');
                }

            })
            ->join('parent_details as pd', 'pd.students_id', '=', 'students.id')
            ->join('addressinfos as ai', 'ai.students_id', '=', 'students.id')
            ->get();

        /*filter due using call back*/
        $filtered  = $students->filter(function ($student) {
            $student->fee_amount = $student->feeMaster()->sum('fee_amount');
            $student->paid_amount = $student->feeCollect()->sum('paid_amount');
            $student->discount = $student->feeCollect()->sum('discount');
            $student->fine = $student->feeCollect()->sum('fine');
            $student->balance = ($student->fee_amount + $student->fine) - ($student->discount + $student->paid_amount);
            if($student->balance > 0){
                return $student;
            }
        });

        $data['student'] = $filtered;

        $data['faculties'] = $this->activeFaculties();

        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.balance.index'), compact('data'));
    }

}
