<?php

namespace Nepbaycloudservices\Plugins\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Plugins\Models\Offer;
use Nepbaycloudservices\Plugins\Requests\OfferRequest;
use App\User;
use Carbon\Carbon;
use Packagebridge;
use Validator;
use DataTables;
use File;
use Lang;
use Addons;
use DB;


class CustomModule extends ModuleController
{
    protected $path ='Custom.';

    public function index(&$params = array()){
        
        $view =  $this->path.'custom';
        $view = $this->loadTemplate($view,'plugins');           
        $params['eventScripts'] = '<script src="https://www.google.com/recaptcha/api.js"></script>';           
        return view($view)->render();  

    }

    public function custom(&$params = array()){

    	 $view =  $this->path.'newsletter';
        $view = $this->loadTemplate($view,'plugins');         
        return view($view)->render(); 

    }

}
