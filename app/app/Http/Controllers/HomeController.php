<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $SMS; 

    public function __construct()
    {
        $this->middleware('auth');
        $this->SMS = new SMSController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

      /**
     * Calls the send method of the sms controller.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendSMS(Request $request){
       
        $data = $request->all();
        $response = $this->SMS->send($data);
       
        if( sizeof( $response ) === 1 ){
            $payload = [ 'message'=> 'Sending The Message Failed. With error'. $response[0], 'success' => false ];
           return redirect()->back()->with('smsResponse', $payload );   
        } else {
            $payload = [ 'message'=> 'Message Sent Successfully.', 'success' => true ];
           return redirect()->back()->with('smsResponse',  $payload );   
        }
    }

}
