<?php namespace Nepbaycloudservices\PackageBridge;

use Illuminate\Support\ServiceProvider;
use Addons;
use Tourismcore;
use Nepbaycloudservices\PackageBridge\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DB;

class PackageBridge
{
    protected $template;
    protected $package;
    protected $layouts;
    protected $seo;
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

      $this->layouts = $layouts;

      $this->eventsScripts = [];

      $this->seo = '';

    }

    public function getView($viewName){
   		    $template = $this->template ;
          $view = $template.'.'.$viewName;
          if(view()->exists($view)){
            return $view;
          }else {
            die( 'View ' .$view .' doesnot exist');            
         }

    }

    /**
     *  Render Position
     * 
     * 
     * @param string $position
     * @param array $params
     * @return View
     * 
     */ 
    public function position($postion,$params= array()){
      try
      {
                 
        $page =  $params['page'];
        $params['position'] = $postion;        
        $modules = DB::table('module_positions AS mp')
            ->join('modules as m', function ($join) {
                $join->on("m.id", '=', 'mp.module_id');               
            })
            ->whereIn('mp.position',[$postion,'all'])
            ->where('mp.status',1)
            ->where('m.status',1)                                      
            ->where(function($query) use($page){
              $query->whereRaw("FIND_IN_SET('$page',mp.page)")->orWhere('page','=','all');
            })                     
            ->select('m.alias','m.type','mp.*')->orderby('mp.ordering')->get();
        if($modules){
           
            return self::_dispatch($modules, $params);
        }

      }catch(\Exception $e){
          return $e->getMessage();
      }

    }

    public function style($style){
      $route = Route::currentRouteName();
      if($style == 'menuDivision'){
         if($route !='home'){
            return 'Innerheader';
         }
      }
    }

    protected function _dispatch($addons,$params= array()){
   
    $content = '';  

      if(count($addons)>0) 
      {
        foreach($addons as $addon){     
           $_params = $params;
          if( $addon->type =='BACKEND'){
            $controller = ucfirst($addon->alias).'Module';          
            $namesapce = "Nepbaycloudservices\Backendcp\Modules\[controller]";            

          }elseif($addon->type =='FRONTEND'){
             $controller = ucfirst($addon->alias).'Module';
             $namesapce = "Nepbaycloudservices\Plugins\Modules\[controller]";  
          }
          
          $controllerName = str_replace('[controller]', $controller, $namesapce); 
          
          try{
            if( isset($addon->method)){        
             
              $content .= app($controllerName)->{$addon->method}($_params); 
              if( isset($_params['eventScripts'])){
                  $this->eventsScripts[] =  $_params['eventScripts'];
              }           

            }else{
              $content .= app($controllerName)->index($_params); 
             
              if( isset($_params['eventScripts'])){
                  $this->eventsScripts[] =  $_params['eventScripts'];
              }
            }
           
            $this->params = $params;

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

    public function _dispatchModule($module,$params= array()){
      try
      {
        

         $modules = DB::table('modules')
                     ->where('alias',$module)                     
                     ->where('status',1)
                     ->select('*')->orderby('ordering')->get();
      
         if($modules)
         {
            $content = '';
             if(count($modules)>0)
             {
               foreach($modules as $module){
                   $_params = $params;
                   $controller = ucfirst($module->alias).'Module';
                   $namesapce = "Nepbaycloudservices\[namesapce]\Modules\[controller]";
                   $component = $module->type == 'BACKEND'?'Backendcp':'Plugins';
                   $namesapce = str_replace('[namesapce]', ucfirst($component), $namesapce);
                   $controllerName = str_replace('[controller]', $controller, $namesapce);

                 try{
                

                  if( isset($_params['method'])){                             
                    $content .= app($controllerName)->{$_params['method']}($_params);
                    

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

      }catch(\Exception $e){
          return $e->getMessage();
      }

    }

    public function disptachModalScrips($module,$params= array()){
      try
      {
         
         $component =  $params['component'];
         $modules = DB::table('modules')
                     ->where('alias',$module)
                     ->where('type','MODULE')
                     ->whereRaw("FIND_IN_SET('$component',component)")
                     ->where('status',1)
                     ->select('*')->orderby('ordering')->get();

         if($modules)
         {
            $content = '';
             if(count($modules)>0)
             {
               foreach($modules as $module){

                   $controller = ucfirst($module->alias).'Module';
                   $namesapce = "Nepbaycloudservices\[namesapce]\Modules\[controller]";
                   $namesapce = str_replace('[namesapce]', ucfirst($module->component), $namesapce);
                   $controllerName = str_replace('[controller]', $controller, $namesapce);

                 try{
                   $content .= app($controllerName)->index($params);

                 }catch(\Exception $e){
                   return $e->getMessage();
                 }
               }
             }

             return $content;
            }

      }catch(\Exception $e){
          return $e->getMessage();
      }

    }

    public function _dispatchScripts(){     
       if(count($this->eventsScripts )>0)
        return implode("\n", $this->eventsScripts );
    }

    public function _dispatchSeo(){
     
      return $this->seo;
    }

    public function setSeo($seo){
     
      $this->seo = $seo;
    }

}
