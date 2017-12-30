<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SMSController extends Controller
{
    protected $client;
    protected $res;

    public function __construct(){
        $client = new Client();
    }

    public function setResponse($res){
        return $this->res = $res;
    }

    public function send($data){
        $this->setResponse(
            $client->request('POST', 'http://pluralsms.com/sms/sms_api/command/send', [
                'form_params' => [
                    'username' => 'dotunlonge',
                    'password' => 'fortheloveofmoney@4931',
                    'num' => $data->num,
                    'sender' => $data->sender,
                    'msg' => $data->msg,
                    'isflash' => $data->isflash,
                ]
            ])
        );
    }

}
