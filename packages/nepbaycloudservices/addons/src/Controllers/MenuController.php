<?php

namespace Nepbaycloudservices\Addons\Controllers;

use Nepbaycloudservices\Addons\Controllers\AddonsController;
use Illuminate\Http\Request;

class MenuController extends AddonsController
{
    public function index($position=null){

		$view = $this->loadTemplate('menu');
		return view($view)->render();  	
    }

}
