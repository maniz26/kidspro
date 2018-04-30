<?php

namespace Nepbaycloudservices\Backendcp\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Requests\UserRequest;
use Nepbaycloudservices\Plugins\Models\UserProfile;
use Nepbaycloudservices\Plugins\Helpers\DomflightApi;
use App\User;
use Packagebridge;
use Validator;
use DataTables;
use File;
use Auth;
use Lang;
use Addons;
use DB;

class UserModule extends ModuleController
{   
    /**
     * GetMenu Items
     * 
     * Add Menu to Admin Menu Item    
     * @return View
     *  
     */
    public function getmenuItems(){
        
        return view('backendcp::User.menu-xml')->render();            
        
    }

    /**
     * List Content
     * @return View
     * 
     */
    public function list(){

        return view('backendcp::User.list');    
    }

   

  
    /**
     * Content update.
     *
     * @param  int $id
     * @return View
     */
    public function edit($id = null)
    {   
        $countries =DomflightApi::getCountries();
        $user = User::leftjoin('users_profile as up','up.user_id','=','users.id')->select('users.id as userID','users.email','users.name','users.role','up.*')->where('users.id',$id)->first();        
        return view('backendcp::User.edit', compact('user','countries'));
    }

    /**
     * Update content.
     *     
     * @param ContentRequest $request
     * @return Redirect
     */
    public function update(Request $request)
    {
       
        try {

            $rules = [
                'name' => 'required',
                'email'                 =>  'unique:users,email,'.$request->id.'|required|email',                
                ];


            $validator = Validator::make($request->all(),$rules);

            if ($validator->fails()) {                      
                    return back()->withErrors($validator)->withInput(); 
            }

            $content = User::find($request->get('id'));    
           
            $content->name =  strip_tags($request->get('name'));
            $content->email = strip_tags($request->get('email'));
            $content->role = strip_tags($request->get('role'));           
            
            $userProfile = UserProfile::where('user_id', $request->get('id'))->first();

            if(!$userProfile ){
                $userProfile = new UserProfile();
                $userProfile->user_id = strip_tags($request->get('id')); 
            }

            $userProfile->contact_number = strip_tags($request->get('contact_number'));           
            $userProfile->address = strip_tags($request->get('address'));           
            $userProfile->country_id = strip_tags($request->get('country_id'));           
            $userProfile->city_id = strip_tags($request->get('city_id'));           
            
        	        
	        // is new image uploaded?
            $safeName = ''; 
            if ($file = $request->file('avatar')) {
                $extension = $file->getClientOriginalExtension() ?: 'png';
                $folderName = '/uploads/users/';
                $contentPath = public_path() . $folderName; 
                $safeName = str_random(10) . '.' . $extension;
                $file->move($contentPath, $safeName);

                $oldPath = public_path() . $folderName . $content->image;                
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }

                //save new file path into db
                $userProfile->avatar = strip_tags($safeName);

            }

            
	        if($content->save()){
                    
                $userProfile->save();
	            return redirect()->route('admin.user.list')->with('success', Lang::get('backendcp::user.success.update'));
	        }	        
		    
	    }catch (GroupNotFoundException $e) {
	    	
		    // Redirect to the content create page
		    return redirect()->route('admin.user.edit')->withInput()->with('error', Lang::get('backendcp::user.error.update'));
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
        $model = 'user';
        $confirm_route = $error = null;
        try {
            // Get content information
            $content = user::where('id',$id)->first();

            $confirm_route = route('admin.user.delete',$content->id);

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
            return redirect()->route('admin.user.list')->with('error', Lang::get('backendcp::content.error.cant_delete'));
        }
        try {
            // Get user information
            $content = User::where('id',$id)->first();
            if($content->role == 1 && $content->id == 1){
               return redirect()->route('admin.user.list')->with('warning' ,'You dont\'t  have access to update Super Admin.');
            }
      

            $folderName = '/uploads/users/';
            $oldPath = public_path() . $folderName . $content->image;
            //delete old pic if exists
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
            // Delete the content
            $content->delete();

            // Prepare the success message
            $success = Lang::get('backendcp::user.success.delete');

            // Redirect to the user management page
            return redirect()->route('admin.user.list')->with('success', $success);
        } catch (UserNotFoundException $e) {
            // Prepare the error message
            $error = Lang::get('backendcp::user.no_content_exists', compact('id'));

            // Redirect to the user management page
            return redirect()->route('admin.user.list')->with('error', $error);
        }
    }

  


    /**
     * Get Content List Data
     * 
     * @return  mix 
     */ 
    public function getdata()
    {
        $contents = DB::table('users as u')->leftJoin('users_profile as up','up.user_id','=','u.id')->select('u.*','up.contact_number');
        return DataTables::of($contents)
            
            ->addColumn('checkbox',function($contents) {
                if($contents->role != 1 && $contents->id != 1 ){     
                    return $checkbox = '<input type="checkbox" name="ids[]" class="checkbox" value="'.$contents->id.'">';
                }else{
                    return  '-';
                }
            })
            ->editColumn('created_at',function($contents) {
                return $contents->created_at;
                //return $contents->created_at->diffForHumans();
            })
            ->editColumn('role',function($contents) {
                return $contents->role == 1 ? 'Super Admin':'Registered User';
            })           
            ->editColumn('avatar',function($contents) {
                return !empty($contents->avatar) ? '<img height="50" src="'.asset('uploads/users/'.$avatar->image).'">' : '-';
            })            
            ->addColumn('actions',function($contents) {
                
                
                $actions = '<a href='. route('admin.user.edit', $contents->id) .' class="btn btn-xs btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>';
                if($contents->role != 1 && $contents->id != 1 ){                
                     $actions .= ' <a href='. route('admin.user.delete.confirm', $contents->id) .' data-toggle="modal" data-target="#delete_content" class="btn btn-xs btn-danger" title="Delete"><i class="glyphicon glyphicon-trash"></i></a>';
                }


                
                return $actions;
            })
            ->rawColumns(['checkbox','actions','acatar','role'])
            ->make(true);
    }

   

     /**
     * Batch Puslish Content
     * 
     * @param Request $request
     */ 
    public function batchDelete( Request $request ){
         try {

          
            User::whereIn('id',$request->ids)->where('id','!=',1)->delete();
            $count = count($request->ids);

            $message = trans_choice('backendcp::user.delete.deleted', $count,[ 'user' =>$count]);
            
            return redirect()->route('admin.user.list')->with('success',$message );            
            
        }catch (GroupNotFoundException $e) {
                        
            return redirect()->route('admin.user.list')->withInput()->with('error', Lang::get('backendcp::user.delete.eror'));
        }
    }

    


}
