<?php

namespace Nepbaycloudservices\Plugins\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Plugins\Models\Album;
use Nepbaycloudservices\Plugins\Models\Gallery;
use Nepbaycloudservices\Plugins\Requests\AlbumRequest;

use Packagebridge;
use Validator;
use DataTables;
use File;
use stdClass;
use URL;
use Lang;


class GalleryModule extends ModuleController
{

    public function index(){
        $categories = Category::where('parent_id',0)->where('status',1)->get();
        $locator= \App::getLocale();
        $view = $this->loadTemplate('Category.frontend-list');        
        return view($view,compact('categories','locator'))->render();
    }

    public function imageList(){
        $images = Gallery::orderBy('id','desc')->get();
        //echo "<pre>";print_r($images);exit;
        return view('tourismcore::Gallery.image-list',compact('images'));    
    }

    public function albumList(){
        return view('tourismcore::Gallery.album-list');       
    }


    public function createAlbum(){ 
        
    	return view('tourismcore::Gallery.album-new');
    }

    public function saveAlbum( AlbumRequest $request){
    	
        $activity = new Album();       
        $activity->title = $request->title;       
        $activity->status = $request->status;               
        $activity->alias = unique_slug($request->title,'albums');
        $activity->save();
        
        return redirect()->route('gallery.album.list')->with('status', 'Album added Successfully.');


    }
    public function editAlbum($id){
        
        $album =Album::find($id);                
        return view('tourismcore::Gallery.album-edit',compact('album'));

    }

    public function updateAlbum(AlbumRequest $request){

        $activity = Album::find($request->id);        
        $activity->status = $request->status;
        $activity->title = $request->title;                
        $activity->alias = unique_slug($request->title,'albums',$activity->id);        
        $activity->save();
        return redirect()->route('gallery.album.list')->with('status', 'Album updated Successfully.');


    }
    public function deleteAlbum($id){
         $album = Album::find($id);
         $album->delete();
         return  redirect()->route('gallery.album.list')->with('status', 'Album deleted Successfully.');

    }

    public function getAlbumData(){
        
        $contents = Album::select(['*']);
        
         return DataTables::of($contents)

            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
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
                $actions = '<a href="'.route('gallery.album.edit', $contents->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ';
                $actions .= '<a href="'.route('gallery.album.delete', $contents->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
                
                
                return $actions;
            })
            ->rawColumns(['actions','status','icon'])
            ->make(true);
    }

    public function createImage(){ 
         $albums = Album::all();
        return view('tourismcore::Gallery.image-new',compact('albums'));
    }

    public function getImageData(){
        
        $contents = Gallery::groupBy('album_id');
        
         return DataTables::of($contents)

            ->editColumn('created_at',function($contents) {
                return $contents->created_at->diffForHumans();
            })

            ->addColumn('title',function($contents) {
              $album = Album::where('id',$contents->album_id)->first();
              return $album->title;
          })
            
           ->editColumn('view_images',function($contents) {
            return '<a href="javascript:;" onClick="showImage('.$contents->album_id.')" id="ViewImage_'.$contents->album_id.'">View Images</a>';
          })
            ->addColumn('actions',function($contents) {
                $actions = '<a href="'.route('gallery.image.edit', $contents->album_id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> ';
              
                 $actions .= '<a href='. route('gallery.image.delete.confirm', $contents->album_id) .' class="btn btn-xs btn-danger" data-toggle="modal" data-target="#delete_gallery"><i class="glyphicon glyphicon-remove"></i>Delete </a>';

                
                
                return $actions;
            })
            ->rawColumns(['actions','status','view_images'])
            ->make(true);
    }

    public function uploadImage(Request $request){

          $destinationPath = public_path() . '/uploads/files/';
          $thumbPath = $destinationPath .'thumb/';

          $file_temp  = $request->file('file');
          $extension  = $file_temp->getClientOriginalExtension() ?: 'png';
          $safeName   = str_random(10).'.'.$extension;

          $fileItem = new Gallery();
          /*$fileItem->album_id = $request->get('album_id');*/
          $fileItem->image_tags = strip_tags($request->get('image_tags'));
          $fileItem->filename = $safeName;
          $fileItem->mime = $file_temp->getMimeType();
          $fileItem->save();

          $file_temp->move($destinationPath, $safeName);
          if( is_dir($thumbPath) === false )
          {
              mkdir($thumbPath);
          }
          generate_image_thumbnail($destinationPath . $safeName, $thumbPath . 'thumb_' . $safeName);

          $success = new stdClass();
          $success->name = $safeName;
          $success->image_tags = $request->get('image_tags');
          $success->size = $file_temp->getClientSize();
          $success->url =  URL::to('/uploads/files/'.$safeName);
          $success->thumbnailUrl =  URL::to('/uploads/files/thumb/thumb_'.$safeName);
          $success->deleteUrl = URL::to('admin/travels/galleries/delete?_token='.csrf_token().'&id='.$fileItem->id);
          $success->deleteType = 'DELETE';
          $success->fileID = $fileItem->id;

          return response()->json(array( 'files'=> array($success)), 200);
    }

    public function getAlbumImages($id){
      $images = Gallery::where('album_id',$id)->orderBy('id','desc')->get();
      $view= view('tourismcore::Gallery.album-images',compact('images'))->render();  
      $response = array();
      $response['content'] = $view;        
       return json_encode($response);
        exit;    
    }

    public function editImage($id){
      $images = Gallery::where('album_id',$id)->get();
      return view('tourismcore::Gallery.image-edit',compact('images','id'));
    }

    public function deleteImage(Request $request,$id=null)
    {
        if(isset($request->id)) {
            $upload = Gallery::find($request->id);

            unlink(public_path('uploads/files/'.$upload->filename));
            unlink(public_path('uploads/files/thumb/thumb_'.$upload->filename));

            $upload->delete();

            if(!isset(Gallery::find($request->id)->filename)) {
                $success = new stdClass();
                $success->{$upload->filename} = true;
                return response()->json(array( 'files'=> array($success)), 200);

            }
        }
        if($id > 0) {
            $upload = Gallery::find($id);

            unlink(public_path('uploads/files/'.$upload->filename));
            unlink(public_path('uploads/files/thumb/thumb_'.$upload->filename));
            $upload->delete();

            if(!isset(Gallery::find($id)->filename)) {
                $success = new stdClass();
                $success->{$upload->filename} = true;
                return response()->json(array( 'files'=> array($success)), 200);                
            }
        }

    }

    public function getEditModal($id = null){
      $model = 'image';
      $edit_route = $error = null;
      try {
          // Get gallery information
          $image = Gallery::where('id',$id)->first();
          $edit_route = route('gallery.image.update');
          $albums = Album::all(); 

          return view('tourismcore::Gallery.image-edit-modal', compact('error', 'model', 'edit_route','image','albums'));
          
      } catch (Exception $e) {
          // Prepare the error message
          $error = Lang::get('tourismcore::gallery.message.no_gallery_exists', compact('id'));
          return view('tourismcore::gallery.edit_image', compact('error', 'model', 'edit_route','image','albums'));
      }
    }

    public function updateImage(Request $request){
        if($request->has('gallery_image')) {
            $rules = array(
                'gallery_image' => 'image|mimes:jpg,jpeg,bmp,png',
            );

            $validator = Validator::make($request->only('gallery_image'), $rules);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
        }
        try {
            $gallery = Gallery::find($request->get('id'));
            $aId = $gallery->album_id;
            $gallery->album_id = strip_tags($request->get('album_id'));
            $gallery->image_tags = strip_tags($request->get('image_tags'));

            $safeName = '';
            if ($file = $request->file('gallery_image')) {
              $destinationPath = public_path() . '/uploads/files/';
              $thumbPath = $destinationPath .'thumb/';
              $extension = $file->getClientOriginalExtension() ?: 'png';
              $safeName  = str_random(10).'.'.$extension;

              unlink(public_path('uploads/files/'.$gallery->filename));
              unlink(public_path('uploads/files/thumb/thumb_'.$gallery->filename));

              $gallery->filename = $safeName;
              $gallery->mime = $file->getMimeType();

              $file->move($destinationPath, $safeName);
              if( is_dir($thumbPath) === false )
              {
                  mkdir($thumbPath);
              }
              generate_image_thumbnail($destinationPath . $safeName, $thumbPath . 'thumb_' . $safeName);
            }

            $gallery->save();
            $success = Lang::get('tourismcore::gallery.message.success.update');
            return redirect()->route('gallery.image.list',$aId)->with('success', $success);
        }catch(Exception $e){
            $error = Lang::get('tourismcore::image.message.no_image_exists', compact('id'));

            // Redirect to the user management page
             return redirect()->route('gallery.image.list',$aId)->with('error', $error);
        }
    }

    public function getDeleteModal($id = null)
    {
        $model = 'gallery';
        $confirm_route = $error = null;
        try {
            // Get gallery information

            $confirm_route = route('gallery.image.delall',$id);

            return view('tourismcore::Gallery.modal_confirmation', compact('error', 'model', 'confirm_route'));
            
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('tourismcore::gallery.message.no_gallery_exists', compact('id'));
            return view('tourismcore::Gallery.modal_confirmation', compact('error', 'model', 'confirm_route'));
        }
        
    }

    public function delAll($id = null)
    {
        
        try {
            // Get user information
            $gIds = Gallery::where('album_id',$id)->pluck('id');
            $images = Gallery::where('album_id',$id)->get();
            // Delete the images
            foreach ($images as $image) {
              unlink(public_path('uploads/files/'.$image->filename));
              unlink(public_path('uploads/files/thumb/thumb_'.$image->filename));
            }

            Gallery::whereIn('id',$gIds)->delete();
            // Prepare the success message
            $success = Lang::get('travelcore::gallery/message.success.delete');

            // Redirect to the user management page
            return redirect()->route('gallery.image.list')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('travelcore::gallery/message.gallery_not_found', compact('id'));

            // Redirect to the user management page          
            return redirect()->route('gallery.image.list')->with('error', $error);
        }
    }

     public function delSelected(Request $request){
      $error = false;

      $ids = $request->get('imageId');
      if($ids != ''){
        $images = Gallery::whereIn('id',$ids)->get();
          // Delete the images
        foreach ($images as $image) {
          unlink(public_path('uploads/files/'.$image->filename));
          unlink(public_path('uploads/files/thumb/thumb_'.$image->filename));
        }

        Gallery::whereIn('id',$ids)->delete();

        $msg = 'Images Removed Succefully';
      }else{
        $error = true;
        $msg = 'Please select at least one image';
      }

      return response()->json(['msg' => $msg,'error' => $error]);

    }

}
