<?php
namespace Nepbaycloudservices\Plugins;

use Illuminate\Support\Facades\Facade;

class ClassifiedFacade extends Facade{

	 /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
     	
     	return 'plugins'; 
 	}


}
