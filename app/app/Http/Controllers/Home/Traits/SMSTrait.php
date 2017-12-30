<?php 
namespace App\Http\Controllers\Home\Traits;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

trait SMSTrait
{
    private $client;
    private $res;

 /**
  * sends POST request to pluralsms api.
  *
  * @param string $data An Array With form data
  * @return void
  */
    public function send($data){
        $this->client = new Client();
    
        $this->res = $this->client->request('POST', 'http://pluralsms.com/sms/sms_api/command/send', [
            'form_params' => [
                'user' =>  Config::get('services')['pluralsms']['username'],
                'pass' =>  Config::get('services')['pluralsms']['password'],
                'num' => $data['num'],
                'sender' => $data['sender'],
                'msg' => $data['msg'] 
            ]
        ]);
                
        $contents = (string) $this->res->getBody();
        $contents = explode("|",$contents);
        return $contents;

    }


}