<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class SMSController extends Controller
{
    private $client;
    protected $res;

    public function __construct(){
        $this->client = new Client();
    }

    public function setResponse($res){
        return $this->res = $res;
    }

    public function send($data){

        $this->setResponse(
        $this->client->request('POST', 'http://pluralsms.com/sms/sms_api/command/send', [
                    'form_params' => [
                        'user' =>  Config::get('services')['pluralsms']['username'],
                        'pass' =>  Config::get('services')['pluralsms']['password'],
                        'num' => $data['num'],
                        'sender' => $data['sender'],
                        'msg' => $data['msg'] 
                    ]]));

        $contents = (string) $this->res->getBody();
        $contents = explode("|",$contents);
        return $contents;

    }

}
