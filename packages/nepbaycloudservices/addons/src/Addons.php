<?php

namespace Nepbaycloudservices\Addons;

use Illuminate\Support\ServiceProvider;
use Tourismcore;
use Nepbaycloudservices\PackageBridge\Models\Module;
use Nepbaycloudservices\Addons\Controllers;
use File;
use Event;
use DB;

class Addons 
{

   protected $template;
   protected $package;
   protected $layouts;
  public $eventsScripts;
 
   public function __construct(){     
      $this->template = config('packagebridge.default_template');
      $this->package = config('packagebridge.default_package');

      $content = view( $this->template.'.layouts.layout-xml')->render();
      $postionElements =xml_to_array($content);
      $layouts= array();
      foreach ($postionElements['positions']['position'] as $key => $value) {
        $attributes = $value['@attributes'];
        $layouts[$attributes['name']] = $attributes;
      }
      $this->eventsScripts = [];
      $this->layouts = $layouts;
      //dump($this->layouts);

   }

	
	public function _dispatch1($addons,$params= array()){
   
    $content = '';  

    if(count($addons)>0) 
    {
      foreach($addons as $addon){   

        if( $addon->type =='MODULE'){
          $controller = ucfirst($addon->alias).'Module';          
          $namesapce = "Nepbaycloudservices\[namesapce]\Modules\[controller]";
          $namesapce = str_replace('[namesapce]', ucfirst($addon->component), $namesapce); 
        }elseif($addon->type =='ADDONS'){
           $controller = ucfirst($addon->alias).'Controller';
          $namesapce = "Nepbaycloudservices\Addons\Controllers\[controller]";  
        }
        
        $controllerName = str_replace('[controller]', $controller, $namesapce); 
        
        try{
          if( isset($params['method'])){        
            
            $content .= app($controllerName)->{$params['method']}($params);            

          }else{
            $content .= app($controllerName)->index($params);  
          }
          //$content .= app($controllerName)->index($params['position']);
          

        }catch(\Exception $e){
          return $e->getMessage();
        }      
      }

      if ( isset($this->layouts[$params['position']]['class'] ) ){
          $content = '<div class="'.$this->layouts[$params['position']]['class'].'">'.$content.'</div>';    
      }
      
    }

    if ( isset($params['show_positions']) ){
        $content .= '<div style="background-color:yellow;">['.$params['position'].']</div>';    
    }

    return $content;

  }

  public function _dispatch($addons,$params= array()){
    
    $content = '';  

    if(count($addons)>0) 
    {
      foreach($addons as $addon){   
        $_params = $params;  
        $controller = ucfirst($addon->alias).'Controller';
        $namesapce = "Nepbaycloudservices\Addons\Controllers\[controller]";  
        
        
        $controllerName = str_replace('[controller]', $controller, $namesapce); 
        
        try{
          if( isset($params['method'])){        
            
              if( method_exists($controllerName, $params['method']))
                  $content .= app($controllerName)->{$params['method']}($_params); 

              if( isset($_params['eventScripts'])){
                $this->eventsScripts[] =  $_params['eventScripts'];
              }           

          }else{
            $content .= app($controllerName)->index($_params); 
            if( isset($_params['eventScripts'])){
                $this->eventsScripts[] =  $_params['eventScripts'];
            } 
          }          

        }catch(\Exception $e){
          return $e->getMessage();
        }      
      }
      
    }

    return $content;

  }


  public function _dispatchEvents($eventName, $params=array() ){

        $component = $this->package;
        $eventParts = explode('.',$eventName);
        $method = end( $eventParts );
        $params['method']=$method;
        
        $addons = DB::table('addons')                     
                 ->where('status',1)                 
                 ->select('*')->orderby('ordering')->get();
     
        if($addons){
            return $this->_dispatch($addons,$params);
        }
  }

   public function _dispatchScripts(){
        //dump($this->eventsScripts);
       if(count($this->eventsScripts )>0)
        return implode("\n", $this->eventsScripts );
   }
}
