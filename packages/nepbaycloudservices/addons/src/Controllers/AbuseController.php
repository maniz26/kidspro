<?php

namespace Nepbaycloudservices\Addons\Controllers;

use Nepbaycloudservices\Addons\Controllers\AddonsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;
use Carbon\Carbon;

class AbuseController extends AddonsController
{
    public static $wishlists;
    public static $wishlistPosts;
    protected static $scripts;

    

    public function onAdList( &$params= null){
        $post = [];  
        $user =  !Auth::guest()? Auth::user():null;             
        extract($params);
        
        if(!isset( self::$scripts)){

            self::$scripts = $this->Onscripts();
            $params['eventScripts'] = self::$scripts;
        }
        $view = $this->loadTemplate('abuse-add');
        return view($view,compact('post','user'))->render(); 
    }

    public function Onscripts(){                
        $view = $this->loadTemplate('abuse-js');
        return view($view)->render(); 
    }

    public function Submit(Request $request){

        $values['name'] = strip_tags($request->name);
        $values['email'] = strip_tags($request->email);
        $values['message'] = strip_tags($request->message);
        $values['post_id'] = strip_tags($request->post_id);
        $values['created_at'] = Carbon::now();
        if(!Auth::guest()){
            $values['user_id']=Auth::user()->id;
        }
        try{
            DB::table('abuses')->insert( $values);
            return response()->json(['success'=>1,'message'=>'Ad has been reported as an abuse.']);
        }catch(\Exception $e){
            return response()->json(['error'=>1,'message'=>$e->getMessage()]);          
        }

    }



}
