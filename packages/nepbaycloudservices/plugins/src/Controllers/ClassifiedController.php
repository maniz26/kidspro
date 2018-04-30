<?php

namespace Nepbaycloudservices\Classified\Controllers;

use Nepbaycloudservices\PackageBridge\Controllers\PackageBridgeController;
use Nepbaycloudservices\Classified\Models\Post;
use Nepbaycloudservices\Classified\Models\Image as PostImage;
use Nepbaycloudservices\Classified\Models\PostTranslation;
use Nepbaycloudservices\Classified\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Tourismcore;
use Packagebridge;
use Auth;
use Image;
use File;
use Addons;
use Config;

class ClassifiedController extends PackageBridgeController
{

	public $components;
    
	public function __construct(){
		
		$this->components=[
    		'index' => ['title' =>'Home Page', 'view' =>'index'],
            'post'  =>['title' =>'Post Ad ', 'view' =>'post'],
            'create'  =>['title' =>'Post New Ad ', 'view' =>'new'],
            'save' => ['title' =>'Save Ad', 'view' =>'save-view'],
    		'list' => ['title' =>'Ad List', 'view' =>'list-view'], 
    		'search' => ['title' =>'Ad search', 'view' =>'search-view'], 
            'ad' => ['title' =>'Ad Details', 'view' =>'ad-view'], 		
		];

        $this->title = config('packagebridge.title');
        $this->keywords = config('packagebridge.keywords');
        $this->description = config('packagebridge.description');
        

	}

    public function setlanguage($lang){
        session([ 'locale' =>  $lang ]);    
        return redirect()->back();
    }
	/**
	 * Home Page
	*/
    public function index(){
     
        $locator= \App::getLocale();        
    	//return 'Well!!';
    	$view = Packagebridge::getView('index');
    	$params=[
            'component' => 'classified',        
            'page'  => 'home',
            'wrapper_class' =>'row'
      	];
        $app = app();
        $content = $app->make('stdClass');
        $content->title = $this->title;
        $content->keywords = $this->keywords;
        $content->description = $this->description;
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
    	return view($view,compact('params'));
    }

    /**
     * Create a new Post
    */
    public function newPost(Request $request){        

        if(Auth::guest()){
            
             return redirect('login')->with('status', 'Plesae login to post a new ad.');
                    
        }

        $config =[
            'component' => 'classified',        
            'page'  => 'post',
        ];

        $app = app();
        $content = $app->make('stdClass');
        $content->title = "New Post";
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
        
        $controllerName = "Nepbaycloudservices\Classified\Modules\AdModule";        
        $content = app($controllerName)->create();        
        return $this->template('post',$content,$config);

    }

    public function savePost(PostRequest $request){
        $post = new Post();
        $post_expiry_days = config('packagebridge.add_expiry_day');
        $post_expiry_days = isset($post_expiry_days) && !empty($post_expiry_days)? $post_expiry_days: 30 ;
        $locator= \App::getLocale();
        $watermarkLogo =  config('packagebridge.watermark_logo');
        $post->user_id =  Auth::user()->id;            
        $post->price = $request->price;
        $post->price_negotiable = $request->price_negotiable;
        $post->address = $request->address;
        $post->category_id = $request->category_id;
        $title= $request->en_title;        
        $post->city_id = $request->city_id;
        $post->status= 1;
        $post->currency= 'NPR';
        $post->views = 0;
        $post->alias = unique_slug($title,'posts');
        if( $request->custom){
            $post->customs = json_encode($request->custom);
        }
        $post->expired_at= Carbon::now()->addDays($post_expiry_days);
        Addons::_dispatchEvents('seoSave', ['seo'=>$post,'request'=>$request]);
        $post->save();
        
        if( isset($request['image'])){
            foreach($request['image'] as $key=>$image){
                $image_name = date('Ymd') . time() .rand(0,5).'.' . $request['image'][$key]->getClientOriginalExtension();  
                $path = public_path('uploads/ads/'. $image_name);
                $thumb_path = public_path('uploads/ads/'. 'thumb_'.$image_name);
                $request['image'][$key]->move(public_path('uploads/ads'), $image_name);
                
                if( $key ==0) {
                    $post->image = $image_name;
                    $post->save();
                }

                $images = new PostImage();
                $images->post_id = $post->id;
                $images->image_name = $image_name;
                $images->save();   


                $img = Image::make($path);
                $img->resize(550, null, function ($constraint) {
                        $constraint->aspectRatio();
                });                
                $img->save($thumb_path);
                $watermarkPath = public_path('uploads/'.$watermarkLogo);

                if( File::exists( $watermarkPath)){                
                    $img = Image::make( $thumb_path);
                    $img->insert( $watermarkPath, 'center');
                    $img->save( $thumb_path); 

                    $img = Image::make( $path);
                    $img->insert( $watermarkPath, 'center');
                    $img->save( $path);                                
                }
            }
        }
        
        $post->translateOrNew($locator)->title = $request->{$locator.'_title'};
        $post->translateOrNew($locator)->description = $request->{$locator.'_description'};
            
        $post->save();

        return redirect()->route('frontend.myads')->with('message', 'Ad posted Successfully.');       
    }

    /**
     * Edit Post
    */    
    public function editPost(Request $request, $key){
        
        $config =[
            'component' => 'classified',        
            'page'  => 'post',
        ];
        
        $app = app();
        $content = $app->make('stdClass');
        $content->title = "Edit Post";
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
        $controllerName = "Nepbaycloudservices\Classified\Modules\AdModule";        
        $content = app($controllerName)->edit($key);        
        return $this->template('post',$content,$config);

    }

    public function updatePost(PostRequest $request){
       
        $post = Post::find($request->id);
        $removedImageName = [];
        $watermarkLogo =  config('packagebridge.watermark_logo');
        $locator = \App::getLocale();                
        $post->price = $request->price;
        $post->price_negotiable = $request->price_negotiable;
        $post->address = $request->address;
        $post->category_id = $request->category_id;
        $title = $request->en_title;
        $post->city_id = $request->city_id;
        $post->status= 1;
        $post->currency= 'NPR';
        $post->views = 0;
        $post->alias = unique_slug($title,'posts', $post->id);
        if( $request->custom){
            $post->customs = json_encode($request->custom);
        }
        Addons::_dispatchEvents('seoSave', ['seo'=>$post,'request'=>$request]);
        $post->save();
        

        if( !empty($request->unlink_images) ){
              $unlinkImgeIDs = explode(',',$request->unlink_images);             
              $images = PostImage::whereIn('id',$unlinkImgeIDs)->get();              
              foreach ($images as $key => $img) {
                  $removedImageName[] = $img->image_name;
                  $unlinkPath =  public_path('uploads/ads/'. 'thumb_'.$img->image_name);
                  if( File::exists( $unlinkPath)){
                     File::delete($unlinkPath);
                  }
                   $img->delete();
              }
              
              if( in_array($post->image, $removedImageName) ){
                        $post->image = null;
                        $post->save();
              }
        }
        
        if( isset($request['image'])){
            foreach($request['image'] as $key=>$image){
                $image_name = date('Ymd') . time() .rand(0,5).'.' . $request['image'][$key]->getClientOriginalExtension();  
                $path = public_path('uploads/ads/'. $image_name);
                $thumb_path = public_path('uploads/ads/'. 'thumb_'.$image_name);
                $request['image'][$key]->move(public_path('uploads/ads'), $image_name);
                
                if( $key ==0) {
                   
                   if(!$post->image){
                        $post->image = $image_name;
                        $post->save();
                    }
                }

                $images = new PostImage();
                $images->post_id = $post->id;
                $images->image_name = $image_name;
                $images->save();   

                
                $img = Image::make($path);
                $img->resize(550, null, function ($constraint) {
                        $constraint->aspectRatio();
                });                
                $img->save($thumb_path);
                
                $watermarkPath = public_path('uploads/'.$watermarkLogo);

                if( File::exists( $watermarkPath)){
                    $img = Image::make( $thumb_path);
                    $img->insert( $watermarkPath, 'center');
                    $img->save( $thumb_path); 

                    $img = Image::make( $path);
                    $img->insert( $watermarkPath, 'center');
                    $img->save( $path); 
                }                               
            }
        }

        if(!$post->image){
           $image = PostImage::where('post_id',$post->id)->first();
           if($image){
                $post->image = $image->image_name;
                $post->save();  
           }
            
        }
        
        $post->translateOrNew($locator)->title = $request->{$locator.'_title'};
        $post->translateOrNew($locator)->description = $request->{$locator.'_description'};
            
        $post->save();

        return redirect()->route('frontend.myads')->with('message', 'Ad updated Successfully.');       
    }


    /**
     * My Ads
     *
    */
    public function myPost(){
        
        $config =[
            'component' => 'classified',        
            'page'  => 'myads',
        ];
        $app = app();
        $content = $app->make('stdClass');
        $content->title = "My Post";
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
        $controllerName = "Nepbaycloudservices\Classified\Modules\AdModule";        

        $content = app($controllerName)->myads();        
        return $this->template('my-ads',$content,$config);

    }

    public function showPost(Request $request, $key){
         $config=[
            'component' => 'classified',        
            'page'  => 'post',
        ];

        $controllerName = "Nepbaycloudservices\Classified\Modules\AdModule"; 
        $content = app($controllerName)->show($key);         
        return $this->template('post',$content,$config);
    }

    public function postList($key, Request $request){               
        $config=[
            'component' => 'classified',        
            'page'  => 'list',
            'request'   => $request,
            'key'       => $key
        ];
        $app = app();
        $content = $app->make('stdClass');
        $content->title = "Post List";
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
        $controllerName = "Nepbaycloudservices\Classified\Modules\AdModule"; 
        $content = app($controllerName)->list($key,$request);         
        return $this->template('post',$content,$config);
    }

    public function searchPost(Request $request){
        
         $config=[
            'component' => 'classified',        
            'page'  => 'search',
            'request'   => $request
        ];
        $app = app();
        $content = $app->make('stdClass');
        $content->title = "Search List";        
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);

        $controllerName = "Nepbaycloudservices\Classified\Modules\AdModule"; 
        $content = app($controllerName)->search($request);         
        return $this->template('post',$content,$config);
    

    }

    public function showLoginForm(){
         $config=[
            'component' => 'classified',        
            'page'  => 'search',
        ];
       
        $controllerName = "Nepbaycloudservices\Classified\Modules\LoginModule"; 
        $content = app($controllerName)->showLoginForm();         
        return $this->template('post',$content,$config); 
    }

    public function myProfile(){
       
         $config=[
            'component' => 'classified',        
            'page'  => 'profile',
        ];
        $app = app();
        $content = $app->make('stdClass');
        $content->title = "Edit Profile";
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
        $controllerName = "Nepbaycloudservices\Classified\Modules\UserprofileModule"; 
        $content = app($controllerName)->myprofile();         
        return $this->template('profile',$content,$config); 
    }

    public function wishlist(){
        $config=[
            'component' => 'classified',        
            'page'  => 'addon',
        ];
        $app = app();
        $content = $app->make('stdClass');
        $content->title = "Wishlist";
        //echo "<pre>";print_r($content);exit;
        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);
        $controllerName = "Nepbaycloudservices\Addons\Controllers\WishlistController"; 
        $content = app($controllerName)->wishlist();         
        return $this->template('addon',$content,$config);
    }

    public function showContent($slug){
        $config =[
            'component' => 'classified',        
            'page'  => 'content',
        ];                
        $controllerName = "Nepbaycloudservices\Classified\Modules\ContentModule";        
        $content = app($controllerName)->getContent($slug);        
        return $this->template('layouts.page',$content,$config);
    }
   
}
