<?php

namespace Nepbaycloudservices\Plugins\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Packagebridge;
use Addons;



class BannerModule extends ModuleController
{
    protected $path ='Banner.';

   
    public function index(&$params = array()){        
        return view('plugins::'.$this->path.'.banner',compact('params'))->render();
    }
}
