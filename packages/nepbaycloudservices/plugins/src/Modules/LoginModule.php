<?php

namespace Nepbaycloudservices\Plugins\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\User;
use Packagebridge;
use Validator;
use Socialite;
use File;
use Auth;
use URL;
use Redirect;

class LoginModule extends ModuleController
{
	use AuthenticatesUsers,RegistersUsers;

	 /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $failredirectTo = 'login';

    protected $redirecLogin  ='login';

    protected $path ='Login.';
    
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        parent::__construct();
    }

     public function index(){
        $view = $this->loadTemplate( $this->path.'frontend-login','plugins');
        return view($view)->render();
    }


    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/';
    }

    protected function guard()
    {
       return Auth::guard('user');
    }


    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        
         $params=[
                'component' => 'classified',        
                'page'  => 'login',
                'request'   => ''
            ];
        $view = view('plugins::'.$this->path.'.login' ,compact('params'))->render(); 
        $this->content($view);        
        $namesapce = "Nepbaycloudservices\PackageBridge\Controllers\PackageBridgeController";             
        return app($namesapce)->page($this->view,$params);


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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
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
        return User::create([
            'name' =>  isset($data['name'])? $data['name']: $data['firstname'].' ' .$data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        //$this->validator($request->all())->validate();
        //dump($request);exit;
        $validator= $this->validator($request->all());

        if ($validator->fails()) {
            return redirect($this->failredirectTo)
                        ->withErrors($validator)
                        ->withInput();
        }

        $validator->validate();

        event(new Registered($user = $this->create($request->all())));
        
        $this->guard()->login($user);

        if( isset($request->redirect)){
            $this->redirecLogin = $request->redirect;
        }

        return $this->registered($request, $user) ?: redirect($this->redirecLogin);
        
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
        //$request->session()->flush();
        //$request->session()->regenerate();
        return redirect($this->redirectTo);
    }

    /*public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
             app('Nepbaycloudservices\PackageBridge\Controllers\ActivationController')->sendActivationMail($user);
             auth()->logout();
            $request->session()->flash('eror', 'You need to confirm your account. We have sent you an activation code, please check your email.');
            return redirect($this->redirecLogin)->withErrors('You need to confirm your account. We have sent you an activation code, please check your email.');
        }

        return redirect()->intended($this->redirectPath());
    }*/

    public function authenticated(Request $request, $user)
    {
        //dump($user);exit;


        $auth = false;
        $rate = false;
        $book = false;
        if($user){
            if ($request->ajax()) {
                $auth = true;
                if($request->get('review') == 1){
                    $rate = true;
                }
                if($request->get('booking') == 1){
                    $book = true;
                }
                return response()->json([
                    'auth' => $auth,
                    'intended' => URL::previous(),
                    'ratePage' => $rate,
                    'book'  => $book
                ]);
            }else if( isset($request->redirect) ){
                return redirect($request->redirect);
            }else{
                return redirect()->intended(URL::previous());
            }
        }else{
            if ($request->ajax()) {
                return response()->json([
                    'auth' => $auth,
                    'intended' => URL::previous(),
                    'ratePage' => $rate,
                    'book'  => $book
                ]);
            } else {
                return Redirect::to(URL::previous())->withInput()->with('error', Lang::get('auth/message.account_not_found'));
            }
        }
            
        /*if( isset($request->redirect) ){
            
            return redirect($request->redirect);
        }*/


        return redirect()->intended($this->redirectPath());
    }



   /* public function activateUser(Request $request, $token)
    {

       if ($user = app('Nepbaycloudservices\PackageBridge\Controllers\ActivationController')->activateUser($token) ){
            $request->session()->flash('status', 'Your account has been activated.You can login now.');
            return redirect($this->redirecLogin);

       }
        abort(404);
    }*/

    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        $errors = [$this->username() => trans($trans)];
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        if ($request->ajax()) {
             return response()->json([
                'error' => $errors                
            ]);
        }
        return redirect($this->failredirectTo)
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }


    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
    */
    public function redirectToProvider($provider)
    {   

        if($provider=='google'){
            return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
        }else{
            return Socialite::driver($provider)->redirect();
        }

        //return Socialite::driver('facebook')->scopes(['public_profile', 'email'])->asPopup()->redirect();
    }



    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
    */
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();
        //dd( $user);
        
        if($user){

            $existingUser = User::where('email',$user->getEmail())->first();
            if($existingUser){
                 $this->guard()->login($existingUser);                 
            } else{
                
                $user->user['password'] = Hash::make($this->randomPass(8));
                
                $newUser = $this->create($user->user);
                if($newUser){
                    //$newUser->activated = 1;
                    $newUser->save();
                    event(new Registered($newUser));    
                    $this->guard()->login($newUser);
                }                
            }
            if( $redirctUrl = session('socialiteRedirectUrl')){
                return redirect($redirctUrl);
            }
            
            return redirect($this->redirectPath());
        }        
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
    */
    public function handleTwitterCallback()
    {

        $user = Socialite::driver('twitter')->user();
        //dd( $user); 
        if($user){

            $existingUser = User::where('email',$user->getEmail())->first();
            if($existingUser){
                 $this->guard()->login($existingUser);                 
            } else{
                $userFields = [];
                $userFields['name']= $user->name;
                $userFields['email']= $user->email;
                $userFields['password']= Hash::make($this->randomPass(8));                
                $newUser = $this->create($userFields);
                if($newUser){
                    //$newUser->activated = 1;
                    $newUser->save();
                    event(new Registered($newUser));    
                    $this->guard()->login($newUser);
                }                
            }

            if( $redirctUrl = session('socialiteRedirectUrl')){
                return redirect($redirctUrl);
            }

            return redirect($this->redirectPath());
        }        
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleGoogleCallback()
    {
       
        $user = Socialite::driver('google')->user();
         if($user){
            $existingUser = User::where('email',$user->getEmail())->first();
            if($existingUser){
                 $this->guard()->login($existingUser);                 
            } else{
                
                $userFields = [];
                $userFields['name']= $user->name;
                $userFields['email']= $user->email;
                $userFields['password'] = Hash::make($this->randomPass(8));
                
                $newUser = $this->create($user->user);
                if($newUser){
                    //$newUser->activated = 1;
                    $newUser->save();
                    event(new Registered($newUser));    
                    $this->guard()->login($newUser);
                }                
            }

            if( $redirctUrl = session('socialiteRedirectUrl')){
                return redirect($redirctUrl);
            }

            return redirect($this->redirectPath());
         }
    }

     public function randomPass($length){
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
              $string .= $characters[mt_rand(0, $max)];
        }
        return $string;
    }


}
