<?php
namespace App\Traits\SmsGateway;

use Clickatell\Rest;
use Clickatell\ClickatellException;

trait ClickatelSMS{

    /*Twilio SMS*/
    public function clickatelSMS($contactNumbers, $message)
    {

        /*get Setting*/
        $smsSetting     = $this->getSmsSetting();
        $sms            = json_decode($smsSetting['Clickatell'],true);
        $ApiKey         = $sms['ApiKey'];

        require_once base_path().'\vendor\arcturial\clickatell\src\Rest.php';

        $clickatell = new Rest($ApiKey);
        //dd($contactNumbers);

        // Full list of support parameters can be found at https://www.clickatell.com/developers/api-documentation/rest-api-request-parameters/
        try {
            $message = $clickatell->sendMessage(['to' => $contactNumbers, 'content' => $message]);

           /* foreach ($message['messages'] as $message) {
                var_dump($message);

                /*
                [
                    'apiMessageId'  => null|string,
                    'accepted'  => boolean,
                    'to'        => string,
                    'errorCode'     => null|string,
                    'error'     => null|string,
                    'errorDescription'     => null|string,

                ]

            }*/

        } catch (ClickatellException $e) {
            // Any API call error will be thrown and should be handled appropriately.
            // The API does not return error codes, so it's best to rely on error descriptions.
            var_dump($e->getMessage());
        }

    }

}