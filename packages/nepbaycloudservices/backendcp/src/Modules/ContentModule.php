<?php

namespace Nepbaycloudservices\Backendcp\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Content;
use Nepbaycloudservices\Backendcp\Requests\ContentRequest;
use Nepbaycloudservices\Backendcp\Models\ContentCategory;
use Nepbaycloudservices\Backendcp\Requests\ContentCategoryRequest;
use App\User;
use Packagebridge;
use Validator;
use DataTables;
use File;
use Auth;
use Lang;
use Addons;
use DB;

class ContentModule extends ModuleController
{   
    /**
     * GetMenu Items
     * 
     * Add Menu to Admin Menu Item    
     * @return View
     *  
     */
    public function getmenuItems(){
        
        return view('backendcp::Content.menu-xml')->render();            
        
    }

    /**
     * List Content
     * @return View
     * 
     */
    public function list(){

        return view('backendcp::Content.list');    
    }

    /**
     * Create Content Form
     * 
     * @return View   
     */ 
    public function create(){
        $categories = get_options(ContentCategory::all());            
    	return view('backendcp::Content.new',compact('categories'));
    }


    /**
     * Save Content
     *
     * @param ContentRequest $request
     * @return Redirect
     */
    public function save(ContentRequest $request)
    {

     	//upload image
        $safeName = '';
        if ($file = $request->file('image')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/contents/';
            $contentPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($contentPath, $safeName);            
        } 
               	
    	$content = new Content();
        
        $content->title =  strip_tags($request->get('title'));
        $content->alias = unique_slug($content->title ,'contents');        
        $content->image = strip_tags($safeName);
        $content->featured = strip_tags($request->get('featured'));
        $content->status = strip_tags($request->get('status'));
        $content->category_id = strip_tags($request->get('category_id'));
        $content->introtext = strip_tags($request->get('introtext'));
        $content->fulltext = $request->get('fulltext');
        
        //Addons::_dispatchEvents('seoSave', ['seo'=>$content,'request'=>$request]);

        if($content->save()){            

            return redirect()->route('admin.content.list')->with('success', Lang::get('backendcp::content.success.create'));
        }
    		    
	    return redirect()->route('admin.content.new')->withInput()->with('error', Lang::get('backendcp::content.error.create'));

    }

    /**
     * Content update.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id = null)
    {
        $content = Content::where('id',$id)->first();
        $categories = get_options(ContentCategory::all()); 
        // Show the page
        return view('backendcp::Content.edit', compact('content','categories'));
    }

    /**
     * Update content.
     *     
     * @param ContentRequest $request
     * @return Redirect
     */
    public function update(ContentRequest $request)
    {
       
        try {

            $content = Content::find($request->get('id'));            
            $content->title =  strip_tags($request->get('title'));
            $content->alias = unique_slug($content->title,'contents',$content->id);            
            $content->featured = $request->get('featured');
            $content->status = $request->get('status');
            $content->category_id = strip_tags($request->get('category_id'));
            $content->introtext = strip_tags($request->get('introtext'));
            $content->fulltext = $request->get('fulltext');
        	        
	        // is new image uploaded?
            $safeName = ''; 
            if ($file = $request->file('image')) {
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/uploads/contents/';
                $contentPath = public_path() . $folderName; 
                $safeName = str_random(10) . '.' . $extension;
                $file->move($contentPath, $safeName);

                $oldPath = public_path() . $folderName . $content->image;
                //delete old pic if exists
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                //save new file path into db
                $content->image = strip_tags($safeName);

            }

            //Addons::_dispatchEvents('seoSave', ['seo'=>$content,'request'=>$request]);
	        if($content->save()){

	            return redirect()->route('admin.content.list')->with('success', Lang::get('backendcp::content.success.update'));
	        }	        
		    
	    }catch (GroupNotFoundException $e) {
	    	
		    // Redirect to the content create page
		    return redirect()->route('admin.content.new')->withInput()->with('error', Lang::get('backendcp::content.delete.update'));
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
        $model = 'content';
        $confirm_route = $error = null;
        try {
            // Get content information
            $content = Content::where('id',$id)->first();

            $confirm_route = route('admin.content.delete',$content->id);

            return view('backendcp::Layout.modal_confirmation', compact('error', 'model', 'confirm_route'));
            
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::content.no_content_exists', compact('id'));
            return view('backendcp::Layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        
    }

    /**
     * Delete the given content.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroy($id = null)
    {
        if(Auth::check() && !Auth::user()->role == 1){
            return redirect()->route('admin.content.list')->with('error', Lang::get('backendcp::content.error.cant_delete'));
        }
        try {
            // Get user information
            $content = Content::where('id',$id)->first();
            $folderName = '/uploads/contents/';
            $oldPath = public_path() . $folderName . $content->image;
            //delete old pic if exists
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            // Delete the content
            $content->delete();

            // Prepare the success message
            $success = Lang::get('backendcp::content.success.delete');

            // Redirect to the user management page
            return redirect()->route('admin.content.list')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::content.no_content_exists', compact('id'));

            // Redirect to the user management page
            return redirect()->route('admin.content.list')->with('error', $error);
        }
    }

    /**
     * Update Content status.
     * 
     * @return Redirect
     */
    public function status($id = null){
        if(Auth::check() && !Auth::user()->role == 1){
            return redirect()->route('content.list')->with('error', Lang::get('backendcp::content.error.cant_delete'));
        }
        try {
            $content = Content::find($id);
            if($content->status == 1){
                $message = trans_choice('backendcp::content.success.status_unpuslish', 1,[ 'article' =>1]);
                $content->status = 0;
            }else{
                $message = trans_choice('backendcp::content.success.status_publish',1, [ 'article' =>1]);
                $content->status = 1;
            }

            if($content->save()){
    
                // Redirect to the user index page
                return redirect()->route('admin.content.list')->with('success',$message );
            }
            // Redirect to the user index page
            return redirect()->route('admin.content.list')->withInput()->with('error', $message );
        }catch (GroupNotFoundException $e) {
            
            // Redirect to the user index page
            return redirect()->route('admin.content.list')->withInput()->with('error', Lang::get('backendcp::content.error.statusupdate'));
        }


    }

    /**
     * Set Featured content
     * 
     * @return Redirect
     */
    public function featured($id = null){

       
        try {
            $content = Content::find($id);
            if($content->featured == 1){
                 $message = trans_choice('backendcp::content.success.unfeatured', 1,[ 'article' =>1]);
                 
                $content->featured = 0;
            }else{
                 $message = trans_choice('backendcp::content.success.featured', 1,[ 'article' =>1]);
                $content->featured = 1;
            }

            if($content->save()){
    
                // Redirect to the user index page
                return redirect()->route('admin.content.list')->with('success', $message);
            }
            // Redirect to the user index page
            return redirect()->route('admin.content.list')->withInput()->with('error', Lang::get('backendcp::content.error.featuredupdate'));
        }catch (GroupNotFoundException $e) {
            
            // Redirect to the user index page
            return redirect()->route('admin.content.list')->withInput()->with('error', Lang::get('backendcp::content.error.featuredupdate'));
        }


    }

    /**
     * Get Content List Data
     * 
     * @return  mix 
     */ 
    public function getdata()
    {
        $contents = Content::select(['*'])->get();

        return DataTables::of($contents)
            
            ->addColumn('checkbox',function($contents) {
                return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$contents->id.'">';
            })
            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
            })
            ->editColumn('introtext',function($contents) {
                $locator= \App::getLocale();
                return str_limit(strip_tags($contents->introtext),25);
            })
            ->editColumn('fulltext',function($contents) {
                $locator= \App::getLocale();
                return str_limit(strip_tags($contents->fulltext),25);
            })
            ->editColumn('image',function($contents) {
                return !empty($contents->image) ? '<img height="50" src="'.asset('uploads/contents/'.$contents->image).'">' : '-';
            })
            ->editColumn('featured',function($contents) {
                $featured = '';
                if($contents->featured == 1){
                    $featured = '<a href='. route('admin.content.featured',$contents->id) .'><span class="jsgrid-button ti-star" style="color:orange;"></span></a>';
                }else{
                	$featured = '<a href='. route('admin.content.featured',$contents->id) .'><span class="jsgrid-button ti-star"></span></a>';
                }
                return $featured;
            })
            ->editColumn('status',function($contents) {
                $status = '';
                if($contents->status == 1){
                    $status = '<a href='. route('admin.content.status',$contents->id) .'><span class="badge badge-success">Publised</span></a>';
                }else{
                	$status = '<a href='. route('admin.content.status',$contents->id) .'><span class="badge badge-warning">Unpublish</span></a>';
                }
                return $status;
            })
            ->addColumn('actions',function($contents) {
                $actions = '<a href='. route('admin.content.edit', $contents->id) .' class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>';
                $actions .= ' <a href='. route('admin.content.delete.confirm', $contents->id) .' data-toggle="modal" data-target="#delete_content" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>';
                
                return $actions;
            })
            ->rawColumns(['checkbox','actions','image','fulltext','status','featured'])
            ->make(true);
    }

    /**
     * Batch Puslish Content
     * 
     * @param Request $request
     */ 
    public function batchPublish( Request $request ){
         try {

          
             DB::table('contents')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 1]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::content.success.status_publish', $count,[ 'article' =>$count]);
            
            return redirect()->route('admin.content.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.content.list')->withInput()->with('error', Lang::get('backendcp::content.error.statusupdate'));
        }
    }

     /**
     * Batch Puslish Content
     * 
     * @param Request $request
     */ 
    public function batchUnpublish( Request $request ){
         try {

          
             DB::table('contents')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 0]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::content.success.status_unpuslish', $count,[ 'article' =>$count]);
            
            return redirect()->route('admin.content.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.content.list')->withInput()->with('error', Lang::get('backendcp::content.error.statusupdate'));
        }
    }

     /**
     * Batch Puslish Content
     * 
     * @param Request $request
     */ 
    public function batchDelete( Request $request ){
         try {

          
            Content::whereIn('id',$request->ids)->delete();
            $count = count($request->ids);

            $message = trans_choice('backendcp::content.delete.deleted', $count,[ 'article' =>$count]);
            
            return redirect()->route('admin.content.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.content.list')->withInput()->with('error', Lang::get('backendcp::content.delete.eror'));
        }
    }

    /**
     * Get Menu Items for Menu
     * 
     * @return View
     */ 
    public function getItems(){
        $items = Content::where('status',1)->get();
        return  view('backendcp::Content.menu-item-list', compact('items'));
    }


    /**
     * Get Content
     * 
     * @return View
     */ 
    public function getContent($alias){
        $content = Content::where('alias',$alias)->first();
        if($content->image){
            $image = 'uploads/contents/'.$content->image;
        }else{
            $image = '';
        }
        Addons::_dispatchEvents( 'getSeo',['content'=>$content,'image'=>$image]);
        $view =  view('backendcp::Content.frontend-content', compact('content'));
        $this->content($view);
        return $this->view;
    }



     /**
     * List Content
     * @return View
     * 
     */
    public function categoryList(){

        return view('backendcp::Content.category-list');    
    }


     /**
     * Create Category Form
     * 
     * @return View   
     */ 
    public function createCategory(){
        $categories = get_options(ContentCategory::all());            
        return view('backendcp::Content.new-category',compact('categories'));
    }

     /**
     * Save Category
     *
     * @param ContentCategory $request
     * @return Redirect
     */
    public function saveCategory(ContentCategoryRequest $request)
    {

        //upload image
        $safeName = '';
        if ($file = $request->file('image')) {
            $fileName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension() ?: 'png';
            $folderName = '/uploads/contentcategory/';
            $contentPath = public_path() . $folderName;
            $safeName = str_random(10) . '.' . $extension;
            $file->move($contentPath, $safeName);            
        } 
                
        $category = new ContentCategory();
        
        $category->title =  strip_tags($request->get('title'));
        $category->alias = unique_slug($category->title ,'content_categories');        
        $category->image = strip_tags($safeName);
        $category->featured = strip_tags($request->get('featured'));
        $category->status = strip_tags($request->get('status'));
        $category->parent_id = strip_tags($request->get('parent_id'));
        $category->description = strip_tags($request->get('description'));
        
        
        //Addons::_dispatchEvents('seoSave', ['seo'=>$content,'request'=>$request]);

        if($category->save()){            

            return redirect()->route('admin.content.category.list')->with('success', Lang::get('backendcp::contentcategory.success.create'));
        }
                
        return redirect()->route('admin.content.category.new')->withInput()->with('error', Lang::get('backendcp::contentcategory.error.create'));

    }

     /**
     * Get Content Categiry  List Data
     * 
     * @return  mix 
     */ 
    public function getdataCategory()
    {
        $categories = ContentCategory::select(['*'])->get();

        return DataTables::of($categories)
            
            ->addColumn('checkbox',function($categories) {
                return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$categories->id.'">';
            })
            ->editColumn('created_at',function($categories) {
                return $categories->created_at->diffForHumans();
            })           
            ->editColumn('image',function($categories) {
                return !empty($categories->image) ? '<img height="50" src="'.asset('uploads/contentcategory/'.$categories->image).'">' : '-';
            })
            ->editColumn('featured',function($categories) {
                $featured = '';
                if($categories->featured == 1){
                    $featured = '<a href='. route('admin.content.category.featured',$categories->id) .'><span class="jsgrid-button ti-star" style="color:orange;"></span></a>';
                }else{
                    $featured = '<a href='. route('admin.content.category.featured',$categories->id) .'><span class="jsgrid-button ti-star"></span></a>';
                }
                return $featured;
            })
            ->editColumn('status',function($categories) {
                $status = '';
                if($categories->status == 1){
                    $status = '<a href='. route('admin.content.category.status',$categories->id) .'><span class="badge badge-success">Publised</span></a>';
                }else{
                    $status = '<a href='. route('admin.content.category.status',$categories->id) .'><span class="badge badge-warning">Unpublish</span></a>';
                }
                return $status;
            })
            ->addColumn('actions',function($categories) {
                $actions = '<a href='. route('admin.content.category.edit', $categories->id) .' class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>';
                $actions .= ' <a href='. route('admin.content.category.delete.confirm', $categories->id) .' data-toggle="modal" data-target="#delete_content" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>';
                
                return $actions;
            })
            ->rawColumns(['checkbox','actions','image','status','featured'])
            ->make(true);
    }


     /**
     * Delete Confirm
     *
     * @param   int $id
     * @return  View
     */
    public function getModalDeleteCategory($id = null)
    {
        $model = 'contentcategory';
        $confirm_route = $error = null;
        try {
            // Get content information
            $content = ContentCategory::where('id',$id)->first();

            $confirm_route = route('admin.content.category.delete',$content->id);

            return view('backendcp::Layout.modal_confirmation', compact('error', 'model', 'confirm_route'));
            
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::content.no_content_exists', compact('id'));
            return view('backendcp::Layouts.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        
    }

    /**
     * Delete the given content.
     *
     * @param  int $id
     * @return Redirect
     */
    public function destroyCategory($id = null)
    {
       
        try {
            // Get user information
            $content = ContentCategory::where('id',$id)->first();
            $folderName = '/uploads/contentcategory/';
            $oldPath = public_path() . $folderName . $content->image;
            //delete old pic if exists
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            // Delete the content
            $content->delete();

            // Prepare the success message
            $success = Lang::get('backendcp::contentcategory.success.delete');

            // Redirect to the user management page
            return redirect()->route('admin.content.category.list')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::contentcategory.no_content_exists', compact('id'));

            // Redirect to the user management page
            return redirect()->route('admin.content.category.list')->with('error', $error);
        }
    }

    /**
     * Update Content status.
     * 
     * @return Redirect
     */
    public function statusCategory($id = null){
        if(Auth::check() && !Auth::user()->role == 1){
            return redirect()->route('content.category.list')->with('error', Lang::get('backendcp::contentcategory.error.cant_delete'));
        }
        try {
            $content = ContentCategory::find($id);
            if($content->status == 1){
                $message = trans_choice('backendcp::contentcategory.success.status_unpuslish', 1,[ 'article' =>1]);
                $content->status = 0;
            }else{
                $message = trans_choice('backendcp::contentcategory.success.status_publish',1, [ 'article' =>1]);
                $content->status = 1;
            }

            if($content->save()){
    
                // Redirect to the user index page
                return redirect()->route('admin.content.category.list')->with('success',$message );
            }
            // Redirect to the user index page
            return redirect()->route('admin.content.category.list')->withInput()->with('error', $message );
        }catch (GroupNotFoundException $e) {
            
            // Redirect to the user index page
            return redirect()->route('admin.content.category.list')->withInput()->with('error', Lang::get('backendcp::contentcategory.error.statusupdate'));
        }


    }

    /**
     * Set Featured content
     * 
     * @return Redirect
     */
    public function featuredCategory($id = null){

       
        try {
            $content = ContentCategory::find($id);
            if($content->featured == 1){
                 $message = trans_choice('backendcp::contentcategory.success.unfeatured', 1,[ 'category' =>1]);
                 
                $content->featured = 0;
            }else{
                 $message = trans_choice('backendcp::contentcategory.success.featured', 1,[ 'category' =>1]);
                $content->featured = 1;
            }

            if($content->save()){
    
                // Redirect to the user index page
                return redirect()->route('admin.content.category.list')->with('success', $message);
            }
            // Redirect to the user index page
            return redirect()->route('admin.content.category.list')->withInput()->with('error', Lang::get('backendcp::contentcategory.error.featuredupdate'));
        }catch (GroupNotFoundException $e) {
            
            // Redirect to the user index page
            return redirect()->route('admin.content.category.list')->withInput()->with('error', Lang::get('backendcp::contentcategory.error.featuredupdate'));
        }


    }

     /**
     * Batch Puslish Category
     * 
     * @param Request $request
     */ 
    public function batchPublishCategory( Request $request ){
         try {

          
             DB::table('content_categories')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 1]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::contentcategory.success.status_publish', $count,[ 'category' =>$count]);
            
            return redirect()->route('admin.content.category.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.content.category.list')->withInput()->with('error', Lang::get('backendcp::contentcategory.error.statusupdate'));
        }
    }

     /**
     * Batch Puslish Category
     * 
     * @param Request $request
     */ 
    public function batchUnpublishCategory( Request $request ){
         try {

          
             DB::table('content_categories')
                    ->whereIn('id',$request->ids)
                    -> update(['status'=> 0]);
            $count = count($request->ids);

            $message = trans_choice('backendcp::contentcategory.success.status_unpuslish', $count,[ 'category' =>$count]);
            
            return redirect()->route('admin.content.category.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.content.category.list')->withInput()->with('error', Lang::get('backendcp::contentcategory.error.statusupdate'));
        }
    }

     /**
     * Batch Puslish Category
     * 
     * @param Request $request
     */ 
    public function batchDeleteCategory( Request $request ){
         try {

          
            ContentCategory::whereIn('id',$request->ids)->delete();
            $count = count($request->ids);

            $message = trans_choice('backendcp::content.category.delete.deleted', $count,[ 'article' =>$count]);
            
            return redirect()->route('admin.content.category.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.content.category.list')->withInput()->with('error', Lang::get('backendcp::contentcategory.delete.eror'));
        }
    }
    

     /**
     * Category update.
     *
     * @param  int $id
     * @return View
     */
    public function editCategory($id = null)
    {
        $category = ContentCategory::where('id',$id)->first();
        $categories = get_options(ContentCategory::where('id','!=',$id)->get()); 
        // Show the page
        return view('backendcp::Content.edit-category', compact('category','categories'));
    }

    /**
     * Category content.
     *     
     * @param ContentRequest $request
     * @return Redirect
     */
    public function updateCategory(ContentCategoryRequest $request)
    {
       
        try {

            $category = ContentCategory::find($request->get('id'));            
            $category->title =  strip_tags($request->get('title'));
            $category->alias = unique_slug($category->title,'contents',$category->id);            
            $category->featured = $request->get('featured');
            $category->status = $request->get('status');
            $category->parent_id = strip_tags($request->get('parent_id'));
            $category->description = strip_tags($request->get('description'));
                    
            // is new image uploaded?
            $safeName = ''; 
            if ($file = $request->file('image')) {
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/uploads/contentcategory/';
                $contentPath = public_path() . $folderName; 
                $safeName = str_random(10) . '.' . $extension;
                $file->move($contentPath, $safeName);

                $oldPath = public_path() . $folderName . $category->image;
                //delete old pic if exists
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                //save new file path into db
                $category->image = strip_tags($safeName);

            }

            //Addons::_dispatchEvents('seoSave', ['seo'=>$content,'request'=>$request]);
            if($category->save()){

                return redirect()->route('admin.content.category.list')->with('success', Lang::get('backendcp::contentcategory.success.update'));
            }           
            
        }catch (GroupNotFoundException $e) {
            
            // Redirect to the content create page
            return redirect()->route('admin.content.category.new')->withInput()->with('error', Lang::get('backendcp::contentcategory.delete.update'));
        }
    }

    public function showContent($alias = null){
        $params=[
            'component' => 'Content',        
            'page'  => 'content',            
        ];
       
        $content = Content::where('alias',$alias)->first();
        if(!$content){
            abort('404');
        }
        if($content->image){
            $image = 'uploads/contents/'.$content->image;
        }else{
            $image = '';
        }
        Addons::_dispatchEvents( 'getSeo',['content'=>$content,'image'=>$image]);
        
        $view = view('backendcp::Content.content',compact('content'))->render(); 
        $this->content($view);   
        return $this->renderPage($params);
    }


}
