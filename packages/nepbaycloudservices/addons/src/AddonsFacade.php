<?php
namespace Nepbaycloudservices\Addons;

use Illuminate\Support\Facades\Facade;

class AddonsFacade extends Facade{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() {
      
      return 'addons'; 
   }


}