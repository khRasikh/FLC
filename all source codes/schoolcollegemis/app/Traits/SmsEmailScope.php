<?php
namespace App\Traits;

use App\Models\EmailSetting;
use App\Models\SmsSetting;

use App\Traits\SmsGateway\CallFireSMS;
use App\Traits\SmsGateway\ClickatelSMS;
use App\Traits\SmsGateway\MessageBirdSMS;
use App\Traits\SmsGateway\NexmoSMS;
use App\Traits\SmsGateway\SmsAPI;
use App\Traits\SmsGateway\SparrowSMS;
use App\Traits\SmsGateway\TwillioSMS;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\AllEmail;
use Twilio\Rest\Client;


trait SmsEmailScope{

    use TwillioSMS;
    use SmsAPI;
    use MessageBirdSMS;
    use ClickatelSMS;
    use SparrowSMS;
    use NexmoSMS;
    use CallFireSMS;

    /*SMS SENDER*/
    public function sendSMS($contactNumbers, $message)
    {
       if($contactNumbers == "")
            return back()->with($this->message_warning, "No Any Contact Found. So Message Not Send In This Time. Please Try Again.");

        /*get Setting*/
        $smsSetting     = SmsSetting::where('status',1)->first();
        if($smsSetting == null)
            return back()->with($this->message_warning, "SMS Setting Not Detected. Please Setting Your SMS Detail.");

        $activeProvider = $smsSetting->identity;

        /*Switch Target SMS Service Provider*/
        switch ($activeProvider){
            case "Sparrow":
                $this->sparrowSMS($contactNumbers, $message);
                break;

            case "Twilio":
                $this->twilioSMS($contactNumbers, $message);
                break;

            case "MessageBird":
                $this->messageBird($contactNumbers, $message);
                break;

            case "smsAPI":
                $this->smsAPI($contactNumbers, $message);
                break;

            case "Clickatell":
                $this->clickatelSMS($contactNumbers, $message);
                break;

            case "Nexmo":
                $this->nexmoSMS($contactNumbers, $message);
                break;

            case "CallFire":
                $this->callFireSMS($contactNumbers, $message);
                break;

            default:
                return back()->with($this->message_warning, "No Any SMS Service Provider Active. Please, Active First.");

        }

    }




    /*EMAIL SENDING*/
    public function sendEmail($emailIds, $subject, $message){
        /*check internet connection for email sending*/
        /*$connection = Parent::checkConnection();
        if(!$connection)
            return back()->with($this->message_warning, $this->internet_status);*/

        $emailSetting = EmailSetting::first();

        if($emailSetting == null){
            return back()->with($this->message_warning, "Email Setting Not Detected. Please Setting Your Out Going Email Detail.");
        }

        if($emailSetting->status == "in-active")
            return back()->with($this->message_warning, "Email Setting Not Active. Please Active First.");

        /*sending email*/
        $emailIds = explode(',',$emailIds);
        /*Mail Queue*/
        dispatch(new AllEmail($emailIds, $subject, $message));
    }

    /*Common Helper Function for this class*/


    public function emailFilter($emailCollections)
    {
        if(!empty($emailCollections)){
            //remove unwanted space from email address
            $emailCollections=array_map('trim',$emailCollections);
            $emailIds‍‍ = [];
            foreach($emailCollections as $email){
                /*chek email id is correct or not if correct add on array other wise not*/
                $filterMail = filter_var($email,FILTER_VALIDATE_EMAIL);
                if($filterMail){
                    $emailIds[] = $filterMail;
                }
            }

            if(!$emailIds) {
                return back()->with($this->message_warning, "No Any Email Id Found. Please, Select Your Target With Valid Email Group");
            }

            $emailIds = array_unique($emailIds);
            /*array to string separated with comma*/
            return $emailIds = implode(",",$emailIds);

        }else{
            return back()->with($this->message_warning, "No Any Email Id Found. Please, Select Your Target With Valid Email Group");
        }
    }




    public function contactFilter($numbers){
        /*The Contact Number length and filter array*/
        $contactNumbers =array_values((array_filter($numbers, function($v){
            return strlen($v) == 10;
        })));
        /*Filter Duplicate Number get unique number*/
        $contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        return $contactNumbers = implode(",",$contactNumbers);
    }

    /*Check SMS CREDIT*/
    public function checkSmsCredit(Request $request)
    {
        /*Check Internet connectivity*/
        $connection = Parent::checkConnection();
        if(!$connection)
            return back()->with($this->message_warning, $this->internet_status);

        $smsSetting = SmsSetting::select('setting')->first();
        if($smsSetting == null){
            return back()->with($this->message_warning, "SMS Setting Not Detected. Please Setting Your SMS Detail First.");
        }

        $api_url = "http://api.sparrowsms.com/v2/credit/?" .
            http_build_query(array(
                'token' => $smsSetting->setting));
        $response = file_get_contents($api_url);
        $response = json_decode($response);

        if($response->credits_available > 0){
            return back()->with($this->message_success,  "You Have ".$response->credits_available." SMS CREDIT AVAILABLE");
        }else{
            return back()->with($this->message_warning, "You Have No Any SMS Credit/".$response->credits_available." SMS CREDIT AVAILABLE");
        }
    }


    /*Text Replace*/
    public function msgTextReplace($query, $message)
    {

    }

    


}