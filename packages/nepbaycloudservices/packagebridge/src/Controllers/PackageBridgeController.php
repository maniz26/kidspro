<?php

namespace Nepbaycloudservices\PackageBridge\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Composer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Packagebridge;
use Addons;

class PackageBridgeController extends Controller
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    private $files;

    /**
     *  Composer 
     * 
     * @var Illuminate\Support\Composer
     */
    private $composer;

    /**
     * Create a new command instance.
     *
     * @param Filesystem $files
     * @param Composer $composer
     */
    public function __construct(Filesystem $files, Composer $composer)
    {
        $this->files = $files;
        
        $this->composer = $composer;
    }


    /**
     * Install BackendCp
     * 
     * @param void
     */
    public function install()
    {
        return 'I am being called';
        /* $newRoutes = $this->files->get(__DIR__ . '/../routes.txt');        
         $this->files->append( base_path('routes/web.php'),$newRoutes);
         return redirect('/backend');*/


    }

    public function template($view,$return,$params){
         $header_scripts ='';
         $footer_scripts =''; 
         $footer_modal =''; 
         $content=''; 

         if(is_array($return))   
           extract($return);

         
         $locator= \App::getLocale();
         $view = Packagebridge::getView($view);
         return view($view,compact('params','content','header_scripts','footer_scripts','footer_modal','locator'));         
    }


    public function index($params = array()){
        
        $content = app()->make('stdClass');
        $content->title = config('packagebridge.title');
        $content->keywords =  config('packagebridge.keywords');
        $content->description = config('packagebridge.description');

        Addons::_dispatchEvents( 'getSeo',['content'=>$content]);

        if( !count($params)> 0 ){
            $params=[
                'component' => 'classified',        
                'page'  => 'home',
                'wrapper_class' =>'row'
            ];
        }
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

        $course=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','Course')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if($course) {
            $course = $course->title;
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
        $feature=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','feature')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if($feature) {
            $feature = $feature->title;
        }
        $teacher=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','teacher')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if ($teacher) {
            $teacher = $teacher->title;
        }
        $news=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','news')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if ($news) {
            $news = $news->title;
        }
        $testimonial=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','testimonial')
            ->where('status',1)
            ->where('t.parent',$template_id)
            ->first();
        if ($testimonial) {
            $testimonial = $testimonial->title;
        }

       $view = Packagebridge::getView('index');

       return view($view,compact('params','header','footer','course','feature','teacher','news','testimonial'));
    }
    public function getTemplateId(){
        $template_id=DB::table('templates')
            ->select('id')
            ->where('title',$this->template = config('packagebridge.default_template'))
            ->first();
        return $template_id->id;
    }

    public function page($content,$config){

        return $this->template('index',$content,$config);
    }
}
