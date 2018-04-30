<?php 
namespace Nepbaycloudservices\Addons\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class AddonsController extends Controller
{   
    protected $template;
    protected $package;
    protected static $scripts;
   

    public function __construct(){
       $this->template = config('packagebridge.default_template');
       $this->package = config('packagebridge.default_package');      
    }

    public function loadTemplate($addon){
        $view = $this->template.'.'.$addon;
        if(view()->exists($view)){
            return $view;
        } else {
            $view = 'addons::'.$addon;            
            if(view()->exists($view)){               
                return $view;
            }else{
                return null;
            }
        } 
    }

    public function addScripts(){

        if(!isset( self::$scripts)){   
            self::$scripts = $this->Onscripts();
            return self::$scripts;
        }
    }

    abstract public function Onscripts();

}
