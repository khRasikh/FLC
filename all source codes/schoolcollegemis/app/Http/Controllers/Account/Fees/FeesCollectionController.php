<?php

namespace App\Http\Controllers\Account\Fees;

use App\Http\Controllers\CollegeBaseController;
use Illuminate\Http\Request;
use Stripe\Stripe;
use App\Models\Faculty;
use App\Models\FeeCollection;
use App\Models\FeeMaster;
use App\Models\Semester;
use App\Models\Student;
use Carbon\Carbon;
use view, URL;
use ViewHelper;
class FeesCollectionController extends CollegeBaseController
{
    protected $base_route = 'account.fees.collection';
    protected $view_path = 'account.fees.collection';
    protected $panel = 'Fees Collection';
    protected $filter_query = [];

    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $data = [];
        $data['student'] = Student::select('students.id','students.reg_no','students.reg_date', 'students.first_name',
            'students.middle_name', 'students.last_name','students.faculty','students.semester','ai.mobile_1', 'pd.father_first_name', 'pd.father_middle_name',
            'pd.father_last_name','students.status')
            ->where(function ($query) use ($request) {

                if ($request->has('reg_no')) {
                    $query->where('students.reg_no', 'like', '%'.$request->reg_no.'%');
                    $this->filter_query['students.reg_no'] = $request->reg_no;
                }

                if ($request->has('reg-start-date') && $request->has('update-end-date')) {
                    $query->whereBetween('students.reg_date', [$request->get('reg-start-date'), $request->get('update-end-date')]);
                    $this->filter_query['reg-start-date'] = $request->get('reg-start-date');
                    $this->filter_query['update-end-date'] = $request->get('update-end-date');
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

        $data['faculties'] = $this->activeFaculties();


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    public function view(Request $request, $id)
    {
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


        $data['url'] = URL::current();
        $data['filter_query'] = $this->filter_query;
        return view(parent::loadDataToView($this->view_path.'.collect.index'), compact('data'));
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

        FeeCollection::create($request->all());

        $request->session()->flash($this->message_success, $this->panel. 'Successfully.');
        return back();

    }

    public function delete(Request $request, $id)
    {
        if (!$row = FeeCollection::find($id)) return parent::invalidRequest();

        $row->delete();

        $request->session()->flash($this->message_success, $this->panel.' Deleted Successfully.');
        return back();
    }


    /*online payment*/
    /*paypal*/
    /*public function paypalPayment(Request $request)
    {
        dd($request->all());


        $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice(7.5);











        $net_balance = $request->get('net_balance');
        $description = $request->get('description');
        $student_id = $request->get('student_id');
        $fee_masters_id = $request->get('fee_masters_id');
        $date = Carbon::now()->format('Y-m-d');

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey("sk_test_iMoelmNST0DFV1d28HTfvgRA");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->get('stripeToken');

        $charge = \Stripe\Charge::create([
            'amount' => $net_balance*100,
            'currency' => 'usd',
            'description' => $description,
            'source' => $token,
        ]);

        if($charge) {

            $feecollect =  FeeCollection::create([
                'students_id' => $student_id,
                'fee_masters_id' => $fee_masters_id,
                'date' => $date,
                'paid_amount' => $net_balance,
                'discount' => 0,
                'fine' => 0,
                'payment_mode' => 'Stripe',
                'note' => $description,
                'created_by' => auth()->user()->id
            ]);

            if ($feecollect) {
                $request->session()->flash($this->message_success, 'Successfully Charge : ' . $net_balance);
            } else {
                $request->session()->flash($this->message_warning, 'Not Collect Yet');
            }
        }else{
            $request->session()->flash($this->message_warning, 'Sorry, something went wrong. Please try again.');
        }

        //dd($charge);

        return back();
        //dd($request->all());

    }*/

    /*stripe*/
   /* public function stripePayment(Request $request)
    {
        //dd($request->all());
        $net_balance = $request->get('net_balance');
        $description = $request->get('description');
        $student_id = $request->get('student_id');
        $fee_masters_id = $request->get('fee_masters_id');
        $date = Carbon::now()->format('Y-m-d');

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey("sk_test_iMoelmNST0DFV1d28HTfvgRA");

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $request->get('stripeToken');

        $charge = \Stripe\Charge::create([
            'amount' => $net_balance*100,
            'currency' => 'usd',
            'description' => $description,
            'source' => $token,
        ]);

        if($charge) {

            $feecollect =  FeeCollection::create([
                'students_id' => $student_id,
                'fee_masters_id' => $fee_masters_id,
                'date' => $date,
                'paid_amount' => $net_balance,
                'discount' => 0,
                'fine' => 0,
                'payment_mode' => 'Stripe',
                'note' => $description,
                'created_by' => auth()->user()->id
            ]);

            if ($feecollect) {
                $request->session()->flash($this->message_success, 'Successfully Charge : ' . $net_balance);
            } else {
                $request->session()->flash($this->message_warning, 'Not Collect Yet');
            }
        }else{
            $request->session()->flash($this->message_warning, 'Sorry, something went wrong. Please try again.');
        }

        return back();

    }*/

    /*khalti*/
    public function khaltiPayment(Request $request)
    {
        dd($request->all());
        $net_balance = $request->get('net_balance');
        $description = $request->get('description');
        $student_id = $request->get('student_id');
        $fee_masters_id = $request->get('fee_masters_id');
        $date = Carbon::now()->format('Y-m-d');

        $args = http_build_query(array(
            'token' => 'QUao9cqFzxPgvWJNi9aKac',
            'amount'  => 1000
        ));

        $url = "https://khalti.com/api/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $headers = ['Authorization: Key test_secret_key_22d2d49601d64461b57b448cb5eb4c95'];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $charge = curl_close($ch);

        if($charge) {
            $feecollect =  FeeCollection::create([
                'students_id' => $student_id,
                'fee_masters_id' => $fee_masters_id,
                'date' => $date,
                'paid_amount' => $net_balance,
                'discount' => 0,
                'fine' => 0,
                'payment_mode' => 'Stripe',
                'note' => $description,
                'created_by' => auth()->user()->id
            ]);

            if ($feecollect) {
                $request->session()->flash($this->message_success, 'Successfully Charge : ' . $net_balance);
            } else {
                $request->session()->flash($this->message_warning, 'Not Collect Yet');
            }
        }else{
            $request->session()->flash($this->message_warning, 'Sorry, something went wrong. Please try again.');
        }

        return back();

    }

}
