<?php
namespace Nepbaycloudservices\Backendcp;

use Illuminate\Support\Facades\Facade;

class BackendcpFacade extends Facade{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
      
      return 'backendcp'; 
   }


}