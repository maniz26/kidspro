<?php

namespace Nepbaycloudservices\Backendcp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Addon;
use Tourismcore;
use Packagebridge;
use File;
use Zipper;
use Artisan;
use DB;
use DataTables;

class AddonController extends Controller
{
    public function index(){
        

    	return view('backendcp::Addon.list');
    	
    }

    public function install(){
    	
    	return view('backendcp::Addon.install');
    }

    public function uninstall($id){
        $addon  = Addon::find($id);        
        if($addon){
            $params = json_decode( $addon->params, true);
        }
        foreach($params['files']['file'] as $file ){
            $path = base_path('packages/nepbaycloudservices/addons/src/'.$file['@attributes']['folder'].'/'.$file['@attributes']['name']);
            if (File::exists($path)){
                File::delete($path);                
            }
        }
        $addon->delete();
        return  redirect()->route('addons.list')->with('status', 'Addon Uninsall Successfully.');
    }

    public function save(Request $request){

    	$validatedData = $request->validate([
        	'addon' => 'required|mimes:zip',        
    	]);

        $file = $request->addon->getClientOriginalName();
        $extension = $request->addon->getClientOriginalExtension(); 
        $folderName = str_replace('.'.$extension,'', $file);

    	if( $request->addon->move(public_path('tmp'), $file) ){               
            $path  =  public_path('tmp'). '/' .$file;
            $extractPath = 'packages/nepbaycloudservices/addons/src/';

    		$controllerPath = base_path($extractPath .'Controllers');
            $migrationPath = base_path($extractPath .'Migrations');
            $modelPath = base_path($extractPath .'Models');
            $viewslPath = base_path($extractPath .'Views');
            $xmlPath = base_path($extractPath .'Xml');

            $xml = Zipper::make($path)->getFileContent($folderName.'/install.xml');
            $params = xml_to_array($xml);
            $addon = new Addon;
            $addon->name =  $params['name'];
            $addon->alias =  $params['alias'];
            $addon->params =  json_encode($params);
            $addon->save();



           /* DB::table('modules')->insert(
                ['name' => $module['name'], 'alias' => $module['alias'], 'params' => json_encode($module) , 'created_at' => date('Y-m-d H:i:s')]
            );*/

    		Zipper::make($path)->folder( $folderName.'/Controllers')->extractTo($controllerPath);
            Zipper::make($path)->folder( $folderName.'/Migrations')->extractTo($migrationPath);
            Zipper::make($path)->folder( $folderName.'/Models')->extractTo($modelPath);
            Zipper::make($path)->folder( $folderName.'/Views')->extractTo($viewslPath);
            
            Artisan::call('migrate', ["--force"=> true ]);

            if(File::exists($path)){
                File::delete($path);
            }

             return  redirect()->route('addons.list')->with('status', 'Addon Install Successfully.');
            
    	}    	

    }

    public function getdata(){
        
        $contents = Addon::select(['*']);
        
         return DataTables::of($contents)
            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
            })
            ->editColumn('position',function($contents) {
                return !empty($contents->position) ? $contents->position: '-';
            })                
            ->editColumn('status',function($contents) {
                $status = '';
                 if($contents->status == 1){
                    $status = '<span class="badge badge-success">Publised</span>';
                }else{
                    $status = '<span class="badge badge-danger">Unpublish</span>';
                }
                return $status;
            })
            ->addColumn('actions',function($contents) {
                return '<a href="'.route('addons.uninstall', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Uninstall</a>';
                
                
                return $actions;
            })
            ->rawColumns(['actions','status'])
            ->make(true);
    }

}
