<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use App\Http\Controllers\Controller;

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
     * Show the application index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard(Request $request)
    {
        if( $request->user()->hasRole('Administrator') )  return view('privileged.dashboard');
        return view('errors.denied');
    }
  
    /**
     * Show the application history.
     *
     * @return \Illuminate\Http\Response
     */
    public function history(Request $request)
    {
        if( $request->user()->hasAnyRole(['Administrator', 'Authenticated User']) ) return view('privileged.history');
        return view('errors.denied');
    }

      /**
     * Calls the send method of the sms controller.
     *
     * @return \Illuminate\Http\Response
     */

    public function sendSMS(Request $request){
       
        $data = $request->all();
        $response = $this->SMS->send($data);
       
        $errors = [
            '-1' => 'Authentication Error','-2' => 'Access Denied',
            '-3' => 'Insufficient Credit','-4' => 'Missing Message',
            '-5' => 'Missing Recipient','-6' => 'Missing Sender',
            '-7' => 'Invalid Recipient','-8' => 'Invalid Sender ID',
            '-9' => 'General Error'
        ];

        if( sizeof( $response ) === 1 ){
            $payload = [ 'message'=> 'Sending The Message Failed. With Error: '. $errors[$response[0]], 'success' => false ];
           return redirect()->back()->with('smsResponse', $payload );   
        } else {
            $payload = [ 'message'=> 'Message Sent Successfully.', 'success' => true ];
           return redirect()->back()->with('smsResponse',  $payload );   
        }
    }

}
