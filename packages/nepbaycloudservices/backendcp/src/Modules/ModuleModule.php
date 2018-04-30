<?php 

namespace Nepbaycloudservices\Backendcp\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Module;
use Nepbaycloudservices\Backendcp\Models\ModulePosition;
use Packagebridge;
use File;
use Zipper;
use Artisan;
use DB;
use DataTables;
use DOMDocument;

class ModuleModule extends ModuleController
{   
    protected $template;
    protected $path ='Module.';

    public function __construct(){
       $this->template = config('packagebridge.default_template');          
    }

    /*public function getmenuItems(){
        
        return view('backendcp::Module.menu-xml')->render();            
        
    }*/

    public function getModuleParams(){
          return view('backendcp::Module.install.xml')->render();       
    }

    public function list(){        
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
        
        $contents = Module::select(['modules.*','module_positions.position'])->leftJoin('module_positions' ,'module_positions.module_id','=','modules.id')->where('modules.type','FRONTEND');
        
         return DataTables::of($contents)

           ->addColumn('checkbox',function($contents) {
                return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$contents->id.'">';
            })

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
                $actions = '<a href="'.route('admin.module.edit', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ';

                $actions .= '<a href="'.route('admin.module.uninstall', $contents->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Uninstall</a>';
                
                
                return $actions;
            })
            ->rawColumns(['checkbox','actions','status'])
            ->make(true);
    }

     public function edit($id){        
        $module = Module::leftJoin('module_positions', 'module_positions.module_id', '=', 'modules.id')
                ->select('modules.*','module_positions.position','module_positions.params')
                ->where('modules.id',$id)
                ->first();

        $path = base_path('resources/views/'.$this->template .'/layouts/layout-xml.blade.php');
        if (File::exists($path)){
            $content = File::get($path);   
            if($content){
                libxml_use_internal_errors(TRUE);
                $dom = new DOMDocument;
                $dom->preserveWhiteSpace = false;
                $dom->loadXML($content);
                $dom->formatOutput = true;
                $xml = $dom->saveXML();
                $positions = xml_to_array($xml);         
                $templatepositions= $positions;
            }
        }

        $package = $module->type == 'BACKEND'? 'Backendcp':'Plugins';


        $params= null;
        $namesapce = "Nepbaycloudservices\[Package]\Modules\[module]";
        $controllerName = str_replace('[Package]', $package, $namesapce);
        $controllerName = str_replace('[module]', ucfirst($module->alias).'Module', $controllerName); 
        if(method_exists($controllerName, 'getModuleParams')){                  
            $params = app($controllerName)->getModuleParams($module->id);
        }      

        return view('backendcp::Module.edit',compact('module','templatepositions','params'));

    }

    public function update(Request $request){
        $module = Module::find($request->id);
        if($module){
            $module->name = $request->name;
            $module->status =  $request->status;
            $module->save();
            $package = $module->type == 'BACKEND'? 'Backendcp':'Plugins';
            $namesapce = "Nepbaycloudservices\[Package]\Modules\[module]";
            $controllerName = str_replace('[Package]', $package, $namesapce);
            $controllerName = str_replace('[module]', ucfirst($module->alias).'Module', $controllerName); 
            if(method_exists($controllerName, 'updateModuleParmas')){                  
                $params = app($controllerName)->updateModuleParmas($request);
            }

        }

         return  redirect()->route('admin.module.list')->with('success', 'Module Install Successfully.');
    }



}
