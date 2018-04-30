<?php

namespace Nepbaycloudservices\Backendcp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Addon;
use Nepbaycloudservices\Backendcp\Models\Module;
use Tourismcore;
use Packagebridge;
use File;
use Zipper;
use Artisan;
use DB;
use DataTables;

class LayoutController extends Controller
{
   protected $template;
   protected $package;

   public function __construct(){
      $this->template = config('packagebridge.default_template');
      $this->package = config('packagebridge.default_package');
   }

    public function index($page=null){
        
      $namesapce = "Nepbaycloudservices\[PACKAGE]\Controllers\[CONTROLLER]";
      $controllerName = str_replace('[PACKAGE]', $this->package, $namesapce); 
      $controllerName = str_replace('[CONTROLLER]', $this->package.'Controller', $controllerName); 
      $controllerMethods = app($controllerName);
      $objectVars = get_object_vars($controllerMethods);
      $components= $objectVars['components'];      
      $modules = Module::all();
      $page = isset($page)? $page: 'index';
    	return view('backendcp::Layout.layout',compact('components','modules','page'));
    	
    }

    public function layout($page=null){    
      $view = Packagebridge::getView($page);      
      $params=[
        'component' => 'list',
        'show_positions' => true,
        'page'  => 'home',
      ];

      return view($view,compact('params'));
    }


}
