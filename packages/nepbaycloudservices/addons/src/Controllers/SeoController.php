<?php

namespace Nepbaycloudservices\Addons\Controllers;

use Nepbaycloudservices\Addons\Controllers\AddonsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;
use Carbon\Carbon;
use Packagebridge;
use Config;

class SeoController extends AddonsController
{
    protected $template;
    protected $package;
   

    public function __construct(){
       $this->template = config('packagebridge.default_template');
       $this->package = config('packagebridge.default_package');      
    }

    public function seo(&$params= null){  

        $content = $params['content'];
        $component = $this->package;
        if(isset($params['class'])){
            $class = $params['class'];  
        } 

        $view = $this->loadTemplate('seo');
        return view($view,compact('content','component','class'))->render();
        //return $return;
    }

    public function seoSave(&$params= null){      
        $table = $params['seo'];
        $data = $params['request'];
        $arr = [
            'metatitle' => $data->get('metatitle'),
            'metakey' => $data->get('metakey'),
            'metadesc' => $data->get('metadesc'),
        ];
        $table->seo = json_encode($arr);
    }

    public function getSeo(&$params= null){
        
        if(isset($params['content'])){
            $content = $params['content'];
        }
        if(isset($params['image'])){
            $image = $params['image'];
        }
        //echo "<pre>";print_r($content);exit;
        $view = $this->loadTemplate('seo-display');

        $seoContent = view($view,compact('content','image','component'))->render();

        
        Packagebridge::setSeo($seoContent);
    }

    public function Onscripts(){ 
        
    }


}
