<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Jobs\SendVerificationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Resend verificaton mail if user has not been verified.
     *
     * @return view
     */
    public function authenticated($request, $user)
    {
        if($user->verified == false)
        { 
            $this->logout($request);
            $data = [
                'email' => $user['email'],
                'email_token' => $user['email_token']
            ];
            event(new Registered($user = $data));
            dispatch(new SendVerificationEmail($user, $data)); 
            return view('almost');
        }
    }

}
