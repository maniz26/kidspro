<?php namespace Nepbaycloudservices\PackageBridge;

use Illuminate\Support\Facades\Facade;

class PackageBridgeFacade extends Facade{

	 /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
     	
     	return 'packagebridge'; 
 	}


}