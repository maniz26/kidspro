<?php
namespace Nepbaycloudservices\Plugins\Modules;

use Illuminate\Support\Facades\DB;
use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Jobs\SendContactusEmail;
use Carbon\Carbon;
use Packagebridge;
use Domflight;
use Validator;
use Addons;
use URL;


class ContactModule extends ModuleController
{	
	protected $path ='contact_us.';
    
  
    public function executeShortcode($encKey=null){
      
      return url('contact-us');
    
    }

    public function index(){
        $params=[
            'component' => 'kidspro',
            'page'  => 'contact_us',
        ];

        $view =  $this->path.'index';
        $view = $this->loadTemplate($view,'plugins');

        $template_id=$this->getTemplateId();

        $header=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','Header')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if ($header){
            $header=$header->title;
        }
        $footer=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','footer')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if($footer) {
            $footer = $footer->title;
        }
        return view($view,compact('params','header','footer'));
    }
    public function getTemplateId(){
        $template_id=DB::table('templates')
            ->select('id')
            ->where('title',$this->template = config('packagebridge.default_template'))
            ->first();
        return $template_id->id;
    }

    public function contactForm(){
      $params=[
            'component' => 'Domflight',        
            'page'  => 'contact',            
        ];

      $view =  $this->path.'form';
      $view = $this->loadTemplate($view,'plugins');                
      $view = view($view)->render();
      $this->content($view);
      $this->footer_script('https://www.google.com/recaptcha/api.js');      
      

      $seocontent = app()->make('stdClass');
      $seocontent->title = config('packagebridge.title');
      $seocontent->keywords =  config('packagebridge.keywords');
      $seocontent->description = config('packagebridge.description');
      Addons::_dispatchEvents( 'getSeo',['content'=>$seocontent]);

      return $this->renderPage($params);
    }

    public function sendContact(Request $request){
       $validator = Validator::make($request->all(), [
          'fullname' => 'required|max:20',
          'email' => 'required|email',
          'phone' => 'required',
          'message' => 'required|min:10',
          'g-recaptcha-response'=>'required|recaptcha'
         ]);

      if ($validator->fails()) {                      
            return redirect()->route('frontend.contactus')->withErrors($validator)->withInput();
      }

      $params['subject']  = strip_tags($request->subject);
      $params['fullname'] = strip_tags($request->fullname);
      $params['email'] = strip_tags($request->email);
      $params['phone'] = strip_tags($request->phone);
      $params['message'] = $request->message;
      dispatch(new SendContactusEmail($params));

      return redirect()->route('frontend.contactus')->with('message','Your message has been submitted.');
    }

    public function experienceForm(){
      $params=[
            'component' => 'Domflight',        
            'page'  => 'contact',            
        ];

      $view =  $this->path.'experience-form';
      $view = $this->loadTemplate($view,'plugins');                
      $view = view($view)->render();
      $this->footer_script('https://www.google.com/recaptcha/api.js');      
      $this->content($view);           
       
      return $this->renderPage($params);
    }

     public function saveExperice(Request $request){
       $validator = Validator::make($request->all(), [
          'fullname' => 'required|max:20',
          'email' => 'required|email',
          'phone' => 'required',
          'message' => 'required|min:10',
          'g-recaptcha-response'=>'required|recaptcha'
         ]);

      if ($validator->fails()) {                      
            return redirect()->route('frontend.experience')->withErrors($validator)->withInput();
      }

      $params['subject']  = strip_tags($request->subject);
      $params['fullname'] = strip_tags($request->fullname);
      $params['email'] = strip_tags($request->email);
      $params['phone'] = strip_tags($request->phone);
      $params['message'] = $request->message;
      dispatch(new SendContactusEmail($params));

      return redirect()->route('frontend.experience')->with('message','Your message has been submitted.');
    }
}
