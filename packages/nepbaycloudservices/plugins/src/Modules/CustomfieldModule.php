<?php

namespace Nepbaycloudservices\Plugins\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Plugins\Requests;
use Nepbaycloudservices\Plugins\Models\Customfield;
use Packagebridge;
use Validator;
use DataTables;
use File;
use Lang;


class CustomfieldModule extends ModuleController
{
    public function getmenuItems(){
        
        return view('plugins::Customfield.menu-xml')->render();            
        
    }

    public function index(){
        $categories = Category::where('parent_id',0)->where('status',1)->get();
        $locator= \App::getLocale();
        $view = $this->loadTemplate('Category.frontend-list');        
        return view($view,compact('categories','locator'))->render();
    }

    public function list(){

        return view('plugins::Customfield.list');    
    }

    public function create(){ 
        
        return view('plugins::Customfield.new');
    }

    public function save( Request $request){
        $activity = new Customfield();

         $this->validate($request,array(
            'type' => 'required',
        ));
        $data = array(
            'type' => $request->get('type'),
            'id_name' => str_slug($request->get('label_text'),'_'),         
            'label_text' => $request->get('label_text'),
            'placeholder' => $request->get('placeholder'),
            'help_text' => $request->get('help_text'),
            'required' => $request->get('required'),
            'input_size' => $request->get('input_size'),
            'default_text' => $request->get('default_text'),
            'options' => $request->get('options'),
            'values' => $request->get('values'),
            'checkboxes' => $request->get('checkboxes'),
            'checkboxes_values' => $request->get('checkboxes_values'),
            'radios' => $request->get('radios'),
            'radios_values' => $request->get('radios_values'),
        );

        $params = json_encode($data);
            
        $custom = new CustomField();
        
        $custom['type'] = strip_tags($request->get('type'));
        $custom['params'] = strip_tags($params);
        $custom['status'] = $request->get('status');
        
        if($custom->save()){
            // Redirect to the custom listing page
            return redirect()->route('admin.customfield.list')->with('success', Lang::get('plugins::customfield.message.success.create'));
        }
        
        // Redirect to the custom create page
        return redirect()->route('admin.customfield.list')->withInput()->with('error', Lang::get('plugins::customfield.message.error.create'));

    }

    public function edit($id){
        
        $custom=Customfield::find($id);               
        $params = json_decode($custom->params); 
        return view('plugins::Customfield.edit',compact('custom','params'));

    }

    public function update(Request $request){

        $this->validate($request,array(
            'type' => 'required',
        ));
        try {

            $data = array(
                'type' => $request->get('type'),
                'id_name' => str_slug($request->get('label_text'),'_'), 
                'label_text' => $request->get('label_text'),
                'placeholder' => $request->get('placeholder'),
                'help_text' => $request->get('help_text'),
                'required' => $request->get('required'),
                'input_size' => $request->get('input_size'),
                'default_text' => $request->get('default_text'),
                'options' => $request->get('options'),
                'values' => $request->get('values'),
                'checkboxes' => $request->get('checkboxes'),
                'checkboxes_values' => $request->get('checkboxes_values'),
                'radios' => $request->get('radios'),
                'radios_values' => $request->get('radios_values'),
            );

            $params = json_encode($data);
                
            $custom = Customfield::find($request->get('id'));
            
            $custom->type = strip_tags($request->get('type'));
            $custom->params = strip_tags($params);
            $custom->status = $request->get('status');

            if($custom->save()){
                // Redirect to the custom listing page
                return redirect()->route('admin.customfield.list')->with('success', Lang::get('plugins::customfield.message.success.update'));                
            }
            // Redirect to the custom create page
            return redirect()->route('admin.customfield.new')->withInput()->with('error', Lang::get('plugins::customfield.message.delete.update'));            
        }catch (GroupNotFoundException $e) {
            
            // Redirect to the custom create page
            return redirect()->route('admin.customfield.new')->withInput()->with('error', Lang::get('plugins::customfield.message.delete.update'));
            
        }


    }
    public function delete($id){
         $customField = CustomField::find($id);        
         $customField->delete();
         return  redirect()->route('admin.customfield.list')->with('status', 'Custom field deleted Successfully.');

    }

    public function getdata(){
        
        
        $contents = Customfield::select(['*']);
        
         return DataTables::of($contents)

            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
            })
            ->editcolumn('label_text',function($customs) {
                $params = json_decode($customs->params);
                return $params->label_text;
            })
            ->addColumn('checkbox',function($customs) {
                return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$customs->id.'">';
            })
            
            ->editColumn('status',function($contents) {
                $status = '';
                if($contents->status == 1){
                    $status = '<a href="'. route('admin.customfield.status',$contents->id) .'"><span class="badge badge-success">Publised</span></a>';
                }else{
                    $status = '<a href="'. route('admin.customfield.status',$contents->id) .'"><span class="badge badge-danger">Unpublish</span></a>';
                }
                return $status;
            })
            ->addColumn('actions',function($contents) {
                $actions = '<a href="'.route('admin.customfield.edit', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ';
                $actions .= '<a href="'.route('admin.customfield.delete', $contents->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                
                
                return $actions;
            })
            ->rawColumns(['actions','status','checkbox'])
            ->make(true);
    }

    public function status($id = null){
        
        try{
            $customfield = Customfield::find($id);
            if($customfield->status == 1){
                $customfield->status = 0;
            }else{
                $customfield->status = 1;
            }

            if($customfield->save()){
                return redirect()->route('admin.customfield.list')->with('success', Lang::get('plugins::customfield.success.statusupdate'));
            }
        }catch(Exception $e){
            return redirect()->route('admin.customfield.list')->with('error', Lang::get('plugins::customfield.error.statusupdate'));
        }


    }

}
