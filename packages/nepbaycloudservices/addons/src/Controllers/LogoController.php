<?php 
namespace Nepbaycloudservices\Addons\Controllers;

use Nepbaycloudservices\Addons\Controllers\AddonsController;
use Illuminate\Http\Request;

class LogoController extends AddonsController
{
	
    public function index($position=null){

		$view = $this->loadTemplate('logo');
		return view($view)->render();
        
    }

}
