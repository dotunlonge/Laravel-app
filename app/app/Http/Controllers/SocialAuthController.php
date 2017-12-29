<?php
  
namespace App\Http\Controllers;


use App\User;
use Validator;
use Auth;
use Socialite;
use Redirect;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\ThrottlesLogins;
// use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;


class SocialAuthController extends Controller {
   
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */

    protected $redirectTo = '/';

	public function redirect($provider) {
		return Socialite::driver ( $provider )->redirect ();
	}
	public function callback($provider) {

         $user = Socialite::driver($provider)->user();

        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return redirect($this->redirectTo);

		// $user = Socialite::with ( $service )->user ();
		// return view ( 'home' )->withDetails ( $user )->withService ( $service );
	}

     /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     * @param  $user Socialite user object
     * @param $provider Social auth provider
     * @return  User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }
        return User::create([
            'name'     => $user->name,
            'email'    => $user->email,
            'provider' => $provider,
            'provider_id' => $user->id
        ]);
    }

}
