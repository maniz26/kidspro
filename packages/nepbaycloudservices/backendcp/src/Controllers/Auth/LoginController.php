<?php

namespace Nepbaycloudservices\Backendcp\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/backend';

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
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('backendcp::Admin.login');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $conditions = [];
        if(config('admin-auth.check_forbidden')) {
            $conditions['forbidden'] = false;
        }
        if(config('admin-auth.activations.enabled')) {
            $conditions['activated'] = true;
        }
        return $request->only($this->username(), 'password');
    }


    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();
        //auth()->guard('admin')->logout();
        //$request->session()->flush();
        //$request->session()->regenerate();
        return redirect($this->redirectTo);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


    public function authenticated(Request $request, $user)
    {
       
        if($user->role != 1){
           $this->guard()->logout();  
             
        }

        return redirect()->intended($this->redirectPath());
    }

    public function redirectPath()
    {

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

}
