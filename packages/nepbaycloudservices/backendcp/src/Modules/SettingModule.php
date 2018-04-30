<?php


namespace Nepbaycloudservices\Backendcp\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use Packagebridge;
use Config;
use Artisan;

class SettingModule extends ModuleController
{
     
    public function getmenuItems(){
        
        return view('backendcp::Setting.menu-xml')->render();            
        
    }


    public function settings(){
        
       
        return view('backendcp::Setting.edit');    
    }

    public function update( Request $request){
        
        if (!preg_match("~^(?:f|ht)tps?://~i", $request['site_url'])) {
            $request['site_url'] = "http://" .$request['site_url'];
        }

        $request['site_url'] = rtrim( $request['site_url'], '/\\' ) . '/';

        Config::write(['packagebridge.default_country' =>$request['default_country']]);        
        Config::write(['packagebridge.max_image_post' =>$request['max_image_post']]);
        Config::write(['packagebridge.post_per_page' =>$request['post_per_page']]);
        Config::write(['packagebridge.google_map_api_key' =>$request['google_map_api_key']]);
        Config::write(['packagebridge.add_expiry_day' =>$request['add_expiry_day']]);

        Config::write(['packagebridge.title' =>$request['title']]);
        Config::write(['packagebridge.site_url' =>$request['site_url']]);
        Config::write(['packagebridge.keywords' =>$request['keywords']]);
        Config::write(['packagebridge.description' =>$request['description']]);
        Config::write(['packagebridge.copyright' =>$request['copyright']]);
        Config::write(['packagebridge.mode' =>$request['mode']]);
        Config::write(['app.locale' =>$request['default_language']]);

        Config::write(['packagebridge.facebook_client_id' =>$request['facebook_client_id']]);
        Config::write(['packagebridge.facebook_client_secret' =>$request['facebook_client_secret']]);
        Config::write(['packagebridge.twitter_client_id' =>$request['twitter_client_id']]);
        Config::write(['packagebridge.twitter_client_secret' =>$request['twitter_client_secret']]);
        Config::write(['packagebridge.google_client_id' =>$request['google_client_id']]);
        Config::write(['packagebridge.google_client_secret' =>$request['google_client_secret']]);

        Config::write(['recaptcha.google_rechatcha_key' =>$request['google_rechatcha_key']]);
        Config::write(['recaptcha.google_rechatcha_secret' =>$request['google_rechatcha_secret']]);

        Config::write(['payment.url_2c2p' =>$request['url_2c2p']]);
        Config::write(['payment.version_2c2p' =>$request['version_2c2p']]);
        Config::write(['payment.merchant_id_2c2p' =>$request['merchant_id_2c2p']]);
        Config::write(['payment.merchant_name_2c2p' =>$request['merchant_name_2c2p']]);
        Config::write(['payment.secretKey_2c2p' =>$request['secretKey_2c2p']]);
        
        
        if( isset($request->watermark_logo)){
            $image_name = date('Ymd') . time() .rand(0,5).'.' . $request->watermark_logo->getClientOriginalExtension();  
            $path = public_path('uploads/'. $image_name);            
            $request->watermark_logo->move(public_path('uploads/'), $image_name);
            Config::write(['packagebridge.watermark_logo' => $image_name]);
        }

        if( isset($request->favicon)){
            $image_name = date('Ymd') . time() .rand(0,5).'.' . $request->favicon->getClientOriginalExtension();  
            $path = public_path('uploads/'. $image_name);            
            $request->favicon->move(public_path('uploads/'), $image_name);
            Config::write(['packagebridge.favicon' => $image_name]);
        }
        $envSettings= [ 'APP_NAME' =>  $request['name'],
                        'FACEBOOK_CLIENT_ID' => $request['facebook_client_id'],
                        'FACEBOOK_CLIENT_SECRET' => $request['facebook_client_secret'],
                        'TWITTER_CLIENT_ID' => $request['twitter_client_id'],
                        'TWITTER_CLIENT_SECRET' => $request['twitter_client_secret'],
                        'GOOGLE_CLIENT_ID' => $request['google_client_id'],
                        'GOOGLE_CLIENT_SECRET' => $request['google_client_secret'],
                        'FACEBOOK_REDIRECT_URL' =>   $request['site_url'].'auth/facebook/callback/',
                        'TWITTER_REDIRECT_URL' =>   $request['site_url'].'auth/twitter/callback/',
                        'GOOGLE_REDIRECT_URL' =>   $request['site_url'].'auth/google/callback/',
                        'GOOGLE_RECAPTCHA_KEY' => $request['google_rechatcha_key'],
                        'GOOGLE_RECAPTCHA_SECRET' => $request['google_rechatcha_secret'],

                      ];  
        
        $this->changeEnv($envSettings); 

        Artisan::call('view:clear');
        Artisan::call('config:clear');

        return response()->json(['success' => 1]);
    }

     protected function changeEnv($data = array()){
        if(count($data) > 0){

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);;

            // Loop through given data
            foreach((array)$data as $key => $value){

                // Loop through .env-data
                foreach($env as $env_key => $env_value){

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if($entry[0] == $key){
                        // If yes, overwrite it with the new one
                        if($key=='APP_NAME')
                            $env[$env_key] = $key . "='" . $value."'";
                        else
                            $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            
            return true;
        } else {
            return false;
        }
    }

}



    