<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

use Illuminate\Auth\Events\Registered;
use App\Jobs\SendVerificationEmail;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(10)
        ]);

        $user
        ->roles()
        ->attach(Role::where('name', 'API User')->first());

        return $user;
    }

    /* Handle a registration request for the application.
    *
    * @param \Illuminate\Http\Request $request
    * @return view
    */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $data = $this->create($request->all());
        event(new Registered($user = $data));
        dispatch(new SendVerificationEmail($user, $data->toArray()));
        return view('verification');   
    }

    /**
    *  checks that tokens match, to verify the user for future logins.
    *
    * @param $token
    * @return view
    */
    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();
        $user->verified = 1;
        if($user->save()){
        return view('emails.emailconfirm',['user'=>$user]);
    }
    }

}
