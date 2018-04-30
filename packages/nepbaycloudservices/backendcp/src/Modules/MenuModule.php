<?php

namespace Nepbaycloudservices\Backendcp\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Menu;
use Nepbaycloudservices\Backendcp\Requests\MenuRequest;
use Nepbaycloudservices\Backendcp\Models\Menuitem;
use Nepbaycloudservices\Backendcp\Requests\MenuItemRequest;
use Packagebridge;
use DOMDocument;
use DataTables;
use Validator;
use File;
use Lang;
use DB;

class MenuModule extends ModuleController
{   
   protected $template;   
   protected $layouts;
   protected $path ='Menu.';

   public function __construct(){     
      $this->template = config('packagebridge.default_template');      
   }

    public function getmenuItems(){
        
        return view('backendcp::Menu.menu-xml')->render();            
        
    }

    public function index($params =null){

        $view =  'Menu'.$params['position'].'-menu';
        $view = $this->loadTemplate($view); 
        if(!view()->exists($view)){
            $view = $this->loadTemplate('Menu.menu'); 
        }

        $menusItems = Menu::join("menu_items as mi", function ($join) {
                    $join->on("mi.menu_id", '=', 'menus.id');               
                })
                ->select('mi.*')
                ->where('menus.position',$params['position'])
                ->where('menus.status',1)
                ->get();
      
        if(count($menusItems)>0){
            return view($view,compact('menusItems'))->render();    
        }
        
    }

    public function list(){
        return view('backendcp::Menu.list');    
    }

    

    public function create(){ 
        
        $path = base_path('resources/views/'.$this->template .'/layouts/layout-xml.blade.php');
        $templatepositions='';
        if (File::exists($path)){
            //$content = File::get($path); 
            $content= view($this->template.'.layouts.layout-xml')->render();  
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
    	return view('backendcp::Menu.new',compact('templatepositions'));
    }

    public function save(MenuRequest $request){
    	
        try 
        {        
            $menu = new Menu();       
            $menu->title = $request->title;       
            $menu->status = $request->status; 
            $menu->position = $request->position;              
            $menu->alias = unique_slug($request->title,'menus');
            $menu->save();
            
            return redirect()->route('admin.menu.list')->with('success', Lang::get('backendcp::menu.success.created'));

        }catch (GroupNotFoundException $e) {                    
            return redirect()->route('admin.menu.new')->withInput()->with('error', Lang::get('backendcp::menu.error.create'));
        }
    }

    public function getdata(){
        
        $contents = Menu::select(['*']);
        
         return DataTables::of($contents)

            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
            })
            
            ->editColumn('status',function($contents) {
                $status = '';
                if($contents->status == 1){
                    $status = '<a href="'. route('admin.menu.status',$contents->id) .'"><span class="badge badge-success">Publised</span></a>';
                }else{
                    $status = '<a href="'. route('admin.menu.status',$contents->id) .'"><span class="badge badge-danger">Unpublish</span></a>';
                }
                return $status;
            })
            ->addColumn('checkbox',function($contents) {
                return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$contents->id.'">';
            })
            ->addColumn('actions',function($contents) {
                $actions = '<a href="'.route('admin.menu.edit', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ';
                 $actions .= ' <a href='. route('admin.menu.delete.confirm', $contents->id) .' data-toggle="modal" data-target="#delete_content" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-remove"></i> Delete</a>';                                
                
                return $actions;
            })
            ->rawColumns(['actions','status','checkbox'])
            ->make(true);
    }

    public function status($id = null){
        
        try{
            $menu = Menu::find($id);
            if($menu->status == 1){
                $menu->status = 0;
                 $message = trans_choice('backendcp::menu.success.status_unpuslish', 1,[ 'menu' =>1]);
            }else{
                $menu->status = 1;
                 $message = trans_choice('backendcp::menu.success.status_publish', 1,[ 'menu' =>1]);
            }

            if($menu->save()){
                return redirect()->route('admin.menu.list')->with('success',  $message );
            }
        }catch(Exception $e){
            return redirect()->route('admin.menu.list')->with('error', Lang::get('backendcp::menu.error.statusupdate'));
        }


    }

    public function edit($id){        
        $menu =Menu::find($id);       
        $path = base_path('resources/views/'.$this->template .'/layouts/layout-xml.blade.php');
        if (File::exists($path)){
            //$content = File::get($path);   
            $content= view($this->template.'.layouts.layout-xml')->render(); 
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
       // dump($templatepositions);
        return view('backendcp::Menu.edit',compact('menu','templatepositions'));

    }

    public function update(MenuRequest $request){

        try {
            $menu = Menu::find($request->id);        
            $menu->status = $request->status;
            $menu->title = $request->title;
            $menu->position = $request->position;                
            $menu->alias = unique_slug($request->title,'menus',$menu->id);        
            $menu->save();

            return redirect()->route('admin.menu.list')->with('success', Lang::get('backendcp::menu.success.updated'));

        }catch (GroupNotFoundException $e) {
            
            // Redirect to the content create page
            return redirect()->route('admin.menu.new')->withInput()->with('error', Lang::get('backendcp::menu.error.update'));
        }


    }

    /**
     * Delete Menu
     * 
     * @param int $id
     * @return Redirect
     */ 
    public function delete($id){
        try 
        {
            $menu = Menu::find($id);         
            $menu->delete();            
            return  redirect()->route('admin.menu.list')->with('success', trans_choice('backendcp::menu.success.deleted', 1,[ 'menu' =>1 ]) );

        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::menu.no_menu_exists', compact('id'));

            // Redirect to the user management page
            return redirect()->route('admin.menu.list')->with('error', $error);
        }

    }


    /**
     * Batch Puslish Menu
     * 
     * @param Request $request
     */ 
    public function batchPublish( Request $request ){
         try {

          
             DB::table('menus')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 1]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::menu.success.status_publish', $count,[ 'menu' =>$count]);
            
            return redirect()->route('admin.menu.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.menu.list')->withInput()->with('error', Lang::get('backendcp::menu.error.statusupdate'));
        }
    }

     /**
     * Batch Puslish Menu
     * 
     * @param Request $request
     */ 
    public function batchUnpublish( Request $request ){
         try {

          
             DB::table('menus')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 0]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::menu.success.status_unpuslish', $count,[ 'menu' =>$count]);
            
            return redirect()->route('admin.menu.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.menu.list')->withInput()->with('error', Lang::get('backendcp::menu.error.statusupdate'));
        }
    }

     /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDelete($id = null)
    {
        $model = 'menu';
        $confirm_route = $error = null;
        try {
            // Get content information
            $content = Menu::where('id',$id)->first();

            $confirm_route = route('admin.menu.delete',$content->id);

            return view('backendcp::Layout.modal_confirmation', compact('error', 'model', 'confirm_route'));
            
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::menu.no_content_exists', compact('id'));
            return view('backendcp::Layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        
    }


     /**
     * Batch Puslish Menu
     * 
     * @param Request $request
     */ 
    public function batchDelete( Request $request ){
         try {          
            Menu::whereIn('id',$request->ids)->delete();
            $count = count($request->ids);

            $message = trans_choice('backendcp::menu.delete.deleted', $count,[ 'menu' =>$count]);
            
            return redirect()->route('admin.menu.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.menu.list')->withInput()->with('error', Lang::get('backendcp::menu.error.delete'));
        }
    }

    /**
     * List Menu Items
     * 
     * @return View     
     */ 
    public function menuItemList(){
        $menus = Menu::all();
        return view('backendcp::Menu.item-list',compact('menus'));       
    }

    /**
     * Create Menu Items 
     * 
     * @return View
     */
    public function createMenuItem(){ 
        $menus = Menu::all();        
        return view('backendcp::Menu.item-new',compact('menus'));
    }

    /**
     * Get Menu Content Types
     * 
     * @return View
     */ 
    public function getItemTypes(){
        
        $modules = DB::table('modules')                 
                 ->where('status',1)
                 ->select('*')->orderby('ordering')->get();
        $menuItems= array();

        foreach($modules as $module){
            if($module->type=='BACKEND'){
                $path = base_path('packages/nepbaycloudservices/backendcp/src/Views/'.ucfirst($module->alias).'/menu-xml.blade.php');
                if (File::exists($path)){
                    //$content = File::get($path);   
                    $content= view('backendcp::'.ucfirst($module->alias).'.menu-xml')->render();
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

            }elseif($module->type=='FRONTEND'){
                $path = base_path('packages/nepbaycloudservices/plugins/src/Views/'.ucfirst($module->alias).'/menu-xml.blade.php');
                if (File::exists($path)){
                    //$content = File::get($path);   
                    $content= view('plugins::'.ucfirst($module->alias).'.menu-xml')->render();
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

        $htmlMenu = '';        
        return view('backendcp::Menu.item-types',compact('menuItems'))->render();                   
    }


    /**
     * Get Plugins items for menu 
     * 
     * @param collection $module
     */ 
    public function getModuleItems($module,$type){
        
        $component = $type=='BACKEND'? 'backendcp':'plugins';

        $namesapce = "Nepbaycloudservices\[COMPONENT]\Modules\[module]";
        $namesapce = str_replace('[COMPONENT]',ucfirst( $component),$namesapce);
        $controllerName = str_replace('[module]', $module, $namesapce); 
        $content= '';
        if( method_exists($controllerName, 'getItems')){
            $content = app($controllerName)->getItems(); 
        }
        return $content;
    }

    /**
     * Create Menu Item
     * 
     * @param MenuItemRequest $request
     * @return Redirect
     */ 
    public function saveMenuItem(MenuItemRequest $request){
        try{
            $menu = new MenuItem();       
            $menu->title = $request->title;       
            $menu->status = $request->status; 
            $menu->parent_id = $request->parent_id;
            $menu->menu_id = $request->menu_id;             
            $menu->target = $request->target;
            $menu->menu_link = $request->menu_link; 
            $menu->content_link = $request->content_link;
            $menu->external_link = $request->external_link;                
            $menu->alias = unique_slug($request->title,'menu_items');
            $menu->save();
        
            return redirect()->route('admin.menu.item.list')->with('status', Lang::get('backendcp::menuitem.success.created'));

        }catch (GroupNotFoundException $e) {                    

            return redirect()->route('admin.menu.item.new')->withInput()->with('error', Lang::get('backendcp::menuitem.error.create'));
        }
    }



    /**
     * Get Menu Item list
     * 
     * @param int $menu_id
     * @return view
     */ 
    public function getMenuItemItems($menu_id){
        $menus = Menuitem::where('menu_id',$menu_id)->get();  
        $menuItems = get_options($menus);
        return view('backendcp::Menu.menu-items-options',compact('menuItems'))->render(); 
        

    }

   

    /**
     *  Memu Item List Data
     * 
     *  @return mix
     */ 
    public function getMenuItemData(){
        
        $contents = MenuItem::select(['*'])->orderBy('ordering');
        
         return DataTables::of($contents)
             ->addColumn('dragnndrop',function($contents) {
                return $checkbox = '<span class="DragnDrop"></span>';
            })

            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
            })
            
            ->editColumn('status',function($contents) {
                $status = '';
                if($contents->status == 1){
                    $status = '<a href="'. route('admin.menu.item.status',$contents->id) .'"><span class="badge badge-success">Publised</span></a>';
                }else{
                    $status = '<a href="'. route('admin.menu.item.status',$contents->id) .'"><span class="badge badge-danger">Unpublish</span></a>';
                }
                return $status;
            })
            ->editColumn('menu_id',function($contents) {
                $menu = Menu::find($contents->menu_id);
                return $menu->title;

            })
             ->addColumn('checkbox',function($contents) {
                return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$contents->id.'">';
            })
            ->addColumn('actions',function($contents) {
                $actions = '<a href="'.route('admin.menu.item.edit', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ';
                 $actions .= ' <a href='. route('admin.menu.item.delete.confirm', $contents->id) .' data-toggle="modal" data-target="#delete_content" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-remove"></i> Delete</a>';      

                
                
                return $actions;
            })
            ->rawColumns(['actions','status','checkbox','dragnndrop'])
            ->make(true);
    }

    /**
     * Edit Menu Item
     * 
     * @param int $id
     * @return View
     */ 
    public function editMenuItem($id){

        $item = MenuItem::find($id);
        $menuItemsRows = Menuitem::where('menu_id',$item->menu_id)->where('id','!=',$item->id)->get();  
        $menuItems = get_options($menuItemsRows);
       
        $menus = Menu::all();            
        return view('backendcp::Menu.item-edit',compact('item','menus','menuItems'));

    }
    /**
     * Update Menu Item
     * 
     * @param MenuItemRequest $request
     * @return View
     */ 
    public function updateMenuItem(MenuItemRequest $request){
        try{
            $menu = MenuItem::find($request->id);       
            $menu->title = $request->title;       
            $menu->status = $request->status; 
            $menu->parent_id = $request->parent_id;
            $menu->menu_id = $request->menu_id;             
            $menu->target = $request->target;
            $menu->menu_link = $request->menu_link; 
            $menu->content_link = $request->content_link;  
            $menu->external_link = $request->external_link;                              
            $menu->alias = unique_slug($request->title,'menu_items',$request->id);
            $menu->save();
        
            return redirect()->route('admin.menu.item.list')->with('success', Lang::get('backendcp::menuitem.success.created'));

        }catch (GroupNotFoundException $e) {                    

            return redirect()->route('admin.menu.item.new')->withInput()->with('error', Lang::get('backendcp::menuitem.error.create'));
        }

    }

    /**
     * Delete Menu Item Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDeleteMenuItem($id = null)
    {
        $model = 'menuitem';
        $confirm_route = $error = null;
        try {
            // Get content information
            $content = MenuItem::where('id',$id)->first();

            $confirm_route = route('admin.menu.item.delete',$content->id);

            return view('backendcp::Layout.modal_confirmation', compact('error', 'model', 'confirm_route'));
            
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::menu.no_content_exists', compact('id'));
            return view('backendcp::Layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        
    }

    /**
     * Delete Menu Item
     * 
     * @param int $id
     * @return Redirect
     * 
     */ 
    public function deleteMenuItem($id){
         try 
        {
            MenuItem::find($id)->delete();                     
            return  redirect()->route('admin.menu.item.list')->with('success', trans_choice('backendcp::menuitem.success.deleted', 1,[ 'menu' =>1 ]) );

        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::menu.no_menu_exists', compact('id'));

            // Redirect to the user management page
            return redirect()->route('admin.menu.item.list')->with('error', $error);
        }        
    }

    /**
     * Update Menu Item status
     * 
     * @param int $id
     * @return Redirect
     */ 
    public function statusSubMenu($id = null){
        
        try{
            $menu = MenuItem::find($id);
            if($menu->status == 1){
                $menu->status = 0;
                $message = trans_choice('backendcp::menuitem.success.status_unpuslish', 1,[ 'menu' =>1]);
            }else{
                $menu->status = 1;
                $message = trans_choice('backendcp::menuitem.success.status_publish', 1,[ 'menu' =>1]);
            }

            if($menu->save()){
                return redirect()->route('admin.menu.item.list')->with('success', $message);
            }
        }catch(Exception $e){
            return redirect()->route('admin.menu.item.list')->with('error', Lang::get('backendcp::menu.error.statusupdate'));
        }
    }

    /**
     * Batch Puslish Menu Item
     * 
     * @param Request $request
     */ 
    public function batchPublishMenuItem( Request $request ){
         try {

          
             DB::table('menu_items')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 1]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::menuitem.success.status_publish', $count,[ 'menu' =>$count]);
            
            return redirect()->route('admin.menu.item.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.menu.item.list')->withInput()->with('error', Lang::get('backendcp::menuitem.error.statusupdate'));
        }
    }

     /**
     * Batch Puslish Menu Item
     * 
     * @param Request $request
     */ 
    public function batchUnpublishMenuItem( Request $request ){
         try {

          
             DB::table('menu_items')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 0]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::menuitem.success.status_unpuslish', $count,[ 'menu' =>$count]);
            
            return redirect()->route('admin.menu.item.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.menu.item.list')->withInput()->with('error', Lang::get('backendcp::menuitem.error.statusupdate'));
        }
    }



     /**
     * Batch Puslish Menu Item
     * 
     * @param Request $request
     */ 
    public function batchDeleteMenuItem( Request $request ){
         try {          
            MenuItem::whereIn('id',$request->ids)->delete();
            $count = count($request->ids);

            $message = trans_choice('backendcp::menuitem.success.deleted', $count,[ 'menu' =>$count]);
            
            return redirect()->route('admin.menu.item.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.menu.item.list')->withInput()->with('error', Lang::get('backendcp::menuitem.error.delete'));
        }
    }

    /**
     * Display Front-end menu
     * 
     * @param array $params
     * 
     */ 
    public function menu(&$params=array()){

       
        $view =  $this->path.$params['position'].'-menu';
        
        $view = $this->loadTemplate($view,'backendcp'); 

        if(!view()->exists($view)){
            $view = $this->loadTemplate('Menu.menu','backendcp'); 
        }
        
        $menusItems = Menu::join("menu_items as mi", function ($join) {
                    $join->on("mi.menu_id", '=', 'menus.id');               
                })
                ->select('mi.*')
                ->where('menus.position',$params['position'])
                ->where('menus.status',1)
                ->orderBy('mi.ordering')
                ->get();  

        $menu = array(
            'menus' => array(),
            'parent_item' => array(),
        );
       /* if($menusItems->count()>0){
            dump($menusItems);
        }*/
        foreach ( $menusItems as $row) {
            //creates entry into categories array with current category id ie. $categories['categories'][1]
            $menu['menus'][$row->id] = $row;
            //creates entry into parent_cats array. parent_cats array contains a list of all categories with children
            $menu['parent_item'][$row->parent_id][] = $row->id;
        }

        

        if(count($menusItems)>0){              

            return view($view,compact('menu'))->render();    
        }
    }

    public function saveMenuOrder(Request $request){

        foreach($request->order as $order){
            DB::table('menu_items')->where('id',$order['id'])->update(['ordering'=>$order['position']]);
        }
        return response()->json(['status' => 'success']);
        
    }
}
