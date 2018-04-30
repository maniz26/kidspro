<?php

namespace Nepbaycloudservices\Plugins\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Content;
use Nepbaycloudservices\Backendcp\Models\ModulePosition;
use Nepbaycloudservices\Backendcp\Models\ContentCategory;
use Nepbaycloudservices\Plugins\Helpers\DomflightApi;
use Nepbaycloudservices\Plugins\Models\UserProfile;
use Packagebridge;
use DOMDocument;
use Validator;
use Addons;
use File;
use Lang;
use Auth;
use DB;



class ProfileModule extends ModuleController
{
    protected $path ='Profile.';


    public function myProfile(){
        
        if( !Auth::guard('user')->check()){
            return 'Access Denied!';
        }

        $params=[
            'component' => 'Profile',        
            'page'  => 'profile',            
        ];
        $user = Auth::guard('user')->user();
        $countries =DomflightApi::getCountries();
        $profile = DB::table('users_profile')->where('user_id',$user->id)->first();
        $view = view('plugins::'.$this->path.'.profile',compact('countries','profile','user'))->render(); 
        $this->content($view); 
        $this->footer_style(asset("Profile/editprofile.css"));
        
        $seocontent = app()->make('stdClass');
        $seocontent->title = config('packagebridge.title');
        $seocontent->keywords =  config('packagebridge.keywords');
        $seocontent->description = config('packagebridge.description');
        Addons::_dispatchEvents( 'getSeo',['content'=>$seocontent]);

        return $this->renderPage($params); 
    }

    public function updateProfile(Request $request){
        if( !Auth::guard('user')->check()){
            return 'Access Denied!';
        }

        $validator = Validator::make($request->all(), [
          'name' => 'required|max:20',
           'email'    => 'required|email|unique:users,email,'.\Auth::guard('user')->user()->id,           
         ]);

          if ($validator->fails()) {                      
                return redirect()->route('frontend.my.profile')->withErrors($validator)->withInput();
          }

         $user = Auth::guard('user')->user();
            $userProfile = UserProfile::where('user_id',$user->id )->first();
            

            if(!$userProfile){
               
                $userProfile =  new  UserProfile();
                $userProfile->user_id = $user->id;

            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            $userProfile->contact_number = $request->contact_number;
            $userProfile->address = $request->address;
            $userProfile->country_id = $request->country_id;
            $userProfile->city_id = $request->city_id;
            if( isset($request->avatar)){

                $image_name = date('Ymd') . time() .rand(0,5).'.' . $request->avatar->getClientOriginalExtension();  
                $path = public_path('uploads/users/'. $image_name);            
                $request->avatar->move(public_path('uploads/users'), $image_name);
                $userProfile->avatar = $image_name;
                
            }
            $userProfile->save();

            return redirect()->route('frontend.my.profile')->with('message','Your profile has been updated' );


    }
}
