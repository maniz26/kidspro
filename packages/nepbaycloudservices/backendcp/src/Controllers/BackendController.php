<?php namespace Nepbaycloudservices\Backendcp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tourismcore;
use Packagebridge;
use File;

class BackendController extends Controller
{
    public function index(){

    	return view('backendcp::dashboard');
    	
    }

    public function setlanguage($lang){
    	session([ 'locale' =>  $lang ]);   	
    	return redirect()->back();
    }

    public function getmenuItems(){    	
    	$files = File::allFiles(base_path('packages'));
    }

}
