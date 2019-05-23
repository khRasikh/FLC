<?php

namespace App\Http\Controllers\Account\Fees\Payment;
use App\Http\Controllers\CollegeBaseController;
use App\Models\FeeCollection;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe\Stripe;

class StripePaymentController extends CollegeBaseController
{
    /*stripe*/
    public function stripePayment(Request $request)
    {
        /*pull payment setting*/
        $paymentSetting = parent::getPaymentSetting();
        $stripe = json_decode($paymentSetting['Stripe'],true);

        if(!isset($stripe['Secret_Key'])){
            $request->session()->flash($this->message_warning, 'Sorry, Strip Key Not Setup. Please try again.');
            return back();
        }

        $net_balance = $request->get('net_balance');
        $description = $request->get('description');
        $student_id = $request->get('student_id');
        $fee_masters_id = $request->get('fee_masters_id');
        $date = Carbon::now()->format('Y-m-d');

        // Set your secret key: remember to change this to your live secret key in production
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        Stripe::setApiKey($stripe['Secret_Key']);

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

    }
}