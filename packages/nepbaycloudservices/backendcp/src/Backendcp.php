<?php
namespace Nepbaycloudservices\Backendcp;
use File;
use DOMDocument;

class Backendcp{

   protected $template;
   protected $package;
   protected $layouts;
 
   public function __construct(){     
      $this->template = config('packagebridge.default_template');
      $this->package = config('packagebridge.default_package');
   }

	public function menu(){
		
		$component = strtolower($this->package);
		$htmlMenu = '';
		$menuItems = array();
		
		$files = collect(File::allFiles(base_path('packages/nepbaycloudservices/plugins/src/Modules/')))       
		         ->sortBy(function ($file) {
		            return $file->getBaseName();
		        });
        
		$namesapce = "Nepbaycloudservices\Plugins\Modules\[module]";
		
		if($files)		
		{	foreach ($files as $file){
				$filename = $file->getRelativePathname();
				$fileparts = explode('.', $filename);
				$className =  $fileparts[0];
				$controllerName = str_replace('[module]', $className, $namesapce); 
				if( method_exists($controllerName, 'getmenuItems')){
					$content = app($controllerName)->getmenuItems();	
					
					if($content){
						libxml_use_internal_errors(TRUE);
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						$dom->loadXML($content);
						$dom->formatOutput = true;
						$xml = $dom->saveXML();
						$menu = xml_to_array($xml);			
						$menuItems[]= $menu;
					}
				}				
			}
		}


		$files = collect(File::allFiles(base_path('packages/nepbaycloudservices/backendcp/src/Modules/')))       
        		  ->sortBy(function ($file) {
            		return $file->getBaseName();
        		});
		$namesapce = "Nepbaycloudservices\Backendcp\Modules\[module]";

		if($files)		
		{	
			foreach ($files as $file){
				$filename = $file->getRelativePathname();
				$fileparts = explode('.', $filename);
				$className =  $fileparts[0];
				$controllerName = str_replace('[module]', $className, $namesapce); 				
				if( method_exists($controllerName, 'getmenuItems')){
					//dump($controllerName);
					$content = app($controllerName)->getmenuItems();
					if($content){	
						libxml_use_internal_errors(TRUE);
						$dom = new DOMDocument;
						$dom->preserveWhiteSpace = false;
						$dom->loadXML($content);
						$dom->formatOutput = true;
						$xml = $dom->saveXML();
						$menu = xml_to_array($xml);			
						$menuItems[]= $menu;
					}
				}				
			}
		}
		
		$htmlMenu .= view('backendcp::menu-item',compact('menuItems'))->render();					
		return $htmlMenu;
	}
}