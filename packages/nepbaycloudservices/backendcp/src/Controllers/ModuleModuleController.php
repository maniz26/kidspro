<?php 
namespace Nepbaycloudservices\Backendcp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Module;
use Tourismcore;
use Packagebridge;
use File;
use Zipper;
use Artisan;
use DB;
use DataTables;

class ModuleModuleController extends Controller
{   
    protected $template;
    protected $package;

    public function __construct(){
       $this->template = config('packagebridge.default_template');
       $this->package = config('packagebridge.default_package');
    }

    public function index(){        
        return view('backendcp::Module.list');
        
    }

     public function install(){
        
        return view('backendcp::Module.install');
    }

    public function uninstall($id){
        $module  = Module::find($id);        
        if($module){
            $params = json_decode( $module->params, true);
        }
        foreach($params['files']['file'] as $file ){
            $path = base_path('packages/nepbaycloudservices/'.strtolower($this->package).'/src/'.$file['@attributes']['folder'].'/'.$file['@attributes']['name']);
            if (File::exists($path)){
                File::delete($path);                
            }
        }
        $module->delete();
        return  redirect()->route('modules.list')->with('status', 'Module Uninsall Successfully.');
    }

    public function save(Request $request){

        $validatedData = $request->validate([
            'module' => 'required|mimes:zip',        
        ]);

        $file = $request->module->getClientOriginalName();
        $extension = $request->module->getClientOriginalExtension(); 
        $folderName = str_replace('.'.$extension,'', $file);

        if( $request->module->move(public_path('tmp'), $file) ){               
            $path  =  public_path('tmp'). '/' .$file;
            $extractPath = 'packages/nepbaycloudservices/'.strtolower($this->package).'/src/';

            $controllerPath = base_path($extractPath .'Modules');
            $migrationPath = base_path($extractPath .'Migrations');
            $modelPath = base_path($extractPath .'Models');
            $viewslPath = base_path($extractPath .'Views');
            $xmlPath = base_path($extractPath .'Xml');

            $xml = Zipper::make($path)->getFileContent($folderName.'/install.xml');
            $params = xml_to_array($xml);
            $module = new Module;
            $module->name =  $params['name'];
            $module->alias =  $params['alias'];            
            $module->params =  json_encode($params);
            $module->component = strtolower($this->package);
            $module->type = 'MODULE';            
            $module->save();


            Zipper::make($path)->folder( $folderName.'/Modules')->extractTo($controllerPath);
            Zipper::make($path)->folder( $folderName.'/Migrations')->extractTo($migrationPath);
            Zipper::make($path)->folder( $folderName.'/Models')->extractTo($modelPath);
            Zipper::make($path)->folder( $folderName.'/Views')->extractTo($viewslPath);
            
            Artisan::call('migrate', ["--force"=> true ]);

            if(File::exists($path)){
                File::delete($path);
            }

             return  redirect()->route('modules.list')->with('status', 'Module Install Successfully.');
            
        }       

    }

    public function getdata(){
        
        $contents = Module::select(['*'])->where('type','MODULE')->where('component',strtolower($this->package));
        
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
                return '<a href="'.route('modules.uninstall', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-trash"></i> Uninstall</a>';
                
                
                return $actions;
            })
            ->rawColumns(['actions','status'])
            ->make(true);
    }


}
