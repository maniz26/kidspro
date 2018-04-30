<?php 
namespace Nepbaycloudservices\Addons\Controllers;

use Nepbaycloudservices\Addons\Controllers\AddonsController;
use Illuminate\Http\Request;

class BannerController extends AddonsController
{

    public function index($position=null){
    	
		$view = $this->loadTemplate('banner');
		return view($view)->render();
        
    }

}
