<?php

namespace App\Http\Controllers\PrintOut;

use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeCollection;
use App\Models\FeeMaster;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use view, URL;
use ViewHelper;
class FeesPrintController extends CollegeBaseController
{
    protected $base_route = 'account.fees.print';
    protected $view_path = 'account.fees.print';
    protected $panel = 'Fees Collection Receipt';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function printMaster(Request $request, $id)
    {
        $data = [];
        $data['fee_master'] = FeeMaster::find($id);

        $data['student'] = $data['fee_master']->students()
                            ->select('reg_no', 'faculty','semester', 'first_name', 'middle_name', 'last_name')
                            ->first();

        return view(parent::loadDataToView('print.student-fee.master'), compact('data'));
    }

    public function printCollection(Request $request, $id)
    {
        $data = [];
        $data['fee_collection'] = FeeCollection::find($id);

        $data['student'] = $data['fee_collection']->students()
            ->select('reg_no', 'faculty','semester', 'first_name', 'middle_name', 'last_name')
            ->first();

        return view(parent::loadDataToView('print.student-fee.collection'), compact('data'));
    }

    public function todayReceiptAmount(Request $request, $id)
    {
        $today = Carbon::parse(today())->format('Y-m-d');
        $data['student'] = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->find($id);

        /*total Calculation on Table Foot*/
        $fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $discount = $data['student']->feeCollect()->sum('discount');
        $fine = $data['student']->feeCollect()->sum('fine');
        $paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $balance = ($fee_amount - ($paid_amount + $discount))+ $fine;
        $data['total_due'] = $balance;

        $data['student']->paid_amount = $data['student']->feeCollect()->where([['date','=',$today],['students_id','=',$id]])->sum('paid_amount');

        return view(parent::loadDataToView('print.student-fee.today-receipt'), compact('data'));

    }

    public function todayReceiptDetail(Request $request, $id)
    {
        $today = Carbon::parse(today())->format('Y-m-d');
        $data['student'] = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->find($id);


        $data['fee_collection'] = FeeCollection::where([['date','=',$today],['students_id','=',$id]])->get();

        /*total Calculation on Table Foot*/
        $fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $discount = $data['student']->feeCollect()->sum('discount');
        $fine = $data['student']->feeCollect()->sum('fine');
        $paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $balance = ($fee_amount - ($paid_amount + $discount))+ $fine;
        $data['total_due'] = $balance;

        return view(parent::loadDataToView('print.student-fee.today-receipt-detail'), compact('data'));

    }

    public function studentLedger(Request $request, $id)
    {
        $today = Carbon::today();
        $data['student'] = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->find($id);

        $data['fee_master'] = $data['student']->feeMaster()->orderBy('fee_due_date','desc')->get();
        $data['fee_collection'] = $data['student']->feeCollect()->get();

        $data['student']->payment_today = $data['student']->feeCollect()->where('date','=',Carbon::today())->sum('paid_amount');

        /*total Calculation on Table Foot*/
        $data['student']->fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $data['student']->discount = $data['student']->feeCollect()->sum('discount');
        $data['student']->fine = $data['student']->feeCollect()->sum('fine');
        $data['student']->paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $data['student']->balance =
            ($data['student']->fee_amount - ($data['student']->paid_amount + $data['student']->discount))+ $data['student']->fine;

        return view(parent::loadDataToView('print.student-fee.student-ledger'), compact('data'));

    }

    public function studentDue(Request $request, $id)
    {
        $data['student'] = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->find($id);

        /*total Calculation on Table Foot*/
        $data['student']->fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $data['student']->discount = $data['student']->feeCollect()->sum('discount');
        $data['student']->fine = $data['student']->feeCollect()->sum('fine');
        $data['student']->paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $data['student']->balance = ($data['student']->fee_amount - ($data['student']->paid_amount + $data['student']->discount))+ $data['student']->fine;
        return view(parent::loadDataToView('print.student-fee.due-slip'), compact('data'));

    }

    public function studentDueDetail(Request $request, $id)
    {
        $data['student'] = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->find($id);

        /*total Calculation on Table Foot*/
        $data['student']->fee_amount = $data['student']->feeMaster()->sum('fee_amount');
        $data['student']->discount = $data['student']->feeCollect()->sum('discount');
        $data['student']->fine = $data['student']->feeCollect()->sum('fine');
        $data['student']->paid_amount = $data['student']->feeCollect()->sum('paid_amount');
        $data['student']->balance = ($data['student']->fee_amount - ($data['student']->paid_amount + $data['student']->discount))+ $data['student']->fine;
        $Master = $data['student']->feeMaster()->get();

        /*filter due using call back*/
        $filtered  = $Master->filter(function ($value, $key) {
            $feeMaster = $value->fee_amount;
            $feeCollection = $value->feeCollect->sum('paid_amount');
            $discount = $value->feeCollect->sum('discount');
            $fine = $value->feeCollect->sum('fine');
            $due = ($feeMaster + $fine) - ($discount + $feeCollection);
            if($due>0){
                $value->discount = $discount;
                $value->fine = $fine;
                $value->paid_amount = $feeCollection;
                $value->due = $due;
                return $value;
            }
        });

        $data['feemaster'] = $filtered;

        return view(parent::loadDataToView('print.student-fee.due-detail-slip'), compact('data'));

    }

    public function bulkDueDetailSlip(Request $request)
    {
        $studentId = $request->get('student');
        $students = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->whereIn('id', $studentId)
            ->get();

        /*filter due using call back*/
        $filtered  = $students->filter(function ($student) {
            $student->master = $student->feeMaster()->get();
            $student->master->filter(function ($value, $key) {
                $feeMaster = $value->fee_amount;
                $feeCollection = $value->feeCollect->sum('paid_amount');
                $discount = $value->feeCollect->sum('discount');
                $fine = $value->feeCollect->sum('fine');
                $due = ($feeMaster + $fine) - ($discount + $feeCollection);
                if($due>0){
                    $value->discount = $discount;
                    $value->fine = $fine;
                    $value->paid_amount = $feeCollection;
                    $value->due = $due;
                    return $value;
                }
            });

            /*Add Extra Field*/
            /*total Calculation on Table Foot*/
            $student->fee_amount = $student->feeMaster()->sum('fee_amount');
            $student->discount = $student->feeCollect()->sum('discount');
            $student->fine = $student->feeCollect()->sum('fine');
            $student->paid_amount = $student->feeCollect()->sum('paid_amount');
            $student->balance = ($student->fee_amount - ($student->paid_amount + $student->discount))+ $student->fine;
            $Master = $student->feeMaster()->get();
            /*return values*/
            return $student;
        });

        $data['student'] = $filtered;
       return view(parent::loadDataToView('print.student-fee.bulk-due-detail-slip'), compact('data'));

    }

    public function bulkDueSlip(Request $request)
    {
        $studentId = $request->get('student');
        $students = Student::select('id','reg_no', 'first_name','middle_name','last_name',
            'faculty','semester')
            ->whereIn('id', $studentId)
            ->get();

        /*filter due using call back*/
        $filtered  = $students->filter(function ($student) {
            $student->master = $student->feeMaster()->get();
            $student->master->filter(function ($value, $key) {
                $feeMaster = $value->fee_amount;
                $feeCollection = $value->feeCollect->sum('paid_amount');
                $discount = $value->feeCollect->sum('discount');
                $fine = $value->feeCollect->sum('fine');
                $due = ($feeMaster + $fine) - ($discount + $feeCollection);
                if($due>0){
                    $value->discount = $discount;
                    $value->fine = $fine;
                    $value->paid_amount = $feeCollection;
                    $value->due = $due;
                    return $value;
                }
            });

            /*Add Extra Field*/
            /*total Calculation on Table Foot*/
            $student->fee_amount = $student->feeMaster()->sum('fee_amount');
            $student->discount = $student->feeCollect()->sum('discount');
            $student->fine = $student->feeCollect()->sum('fine');
            $student->paid_amount = $student->feeCollect()->sum('paid_amount');
            $student->balance = ($student->fee_amount - ($student->paid_amount + $student->discount))+ $student->fine;
            $Master = $student->feeMaster()->get();
            /*return values*/
            return $student;
        });

        $data['student'] = $filtered;
        return view(parent::loadDataToView('print.student-fee.bulk-due-slip'), compact('data'));

    }

}

