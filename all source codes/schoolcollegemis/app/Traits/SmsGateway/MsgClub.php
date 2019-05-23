<?php
namespace App\Traits\SmsGateway;

use CallFire\Api\Request;
use CallFire\Api\Response;

trait MsgClub{

    /*MSG CLUB SMS*/
    public function MsgClubSMS($contactNumbers, $message)
    {
        /*get Setting*/
        $smsSetting = $this->getSmsSetting();
        $sms = json_decode($smsSetting['MsgClub'],true);
        $authKey    = $sms['AUTH_KEY'];
        $senderId   = $sms['senderId'];

        //filter contact numbers
        /*The Contact Number length and filter array*/
        /*$contactNumbers =array_values((array_filter($contactNumbers, function($v){
            return strlen($v) == 10;
        })));*/
        /*Filter Duplicate Number get unique number*/
        //$contactNumbers = array_unique($contactNumbers);
        /*array to string comma separated number*/
        $contactNumbers = implode(",",$contactNumbers);

        $api_url = "http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?".
            http_build_query(array(
                'AUTH_KEY'          => $authKey,
                'message'           => $message,
                'senderId'          => $senderId,
                'routeId'           => '1',
                'mobileNos'         => $contactNumbers,
                'smsContentType'    => 'english'
            ));

        dd($api_url);

        file_get_contents($api_url);


        /*AUTH_KEY *	Alphanumeric	Login Authentication Key(This key is unique for every user)
        message 	text	Enter your message
        senderId *	Text	Enter senderId it should be less then 6 character
        routeId *	Integer	Which route you want use for sending sms enter routeId for particular route.use given Id for route. 1 = Transactional Route, 2 = Promotional Route, 3 = Trans DND Route, 7 = Transcrub Route, 8 = OTP Route, 9 = Trans Stock Route, 10 = Trans Property Route, 11 = Trans DND Other Route, 12 = TransCrub Stock, 13 = TransCrub Property, 14 = Trans Crub Route.
            mobileNos *	Integer	Mobile number can be entered with country code or without country code Multiple mobile no. should be separated by comma
        smsContentType *	Text	"English" for text sms and "Unicode" for Unicode sms*/
    }
}