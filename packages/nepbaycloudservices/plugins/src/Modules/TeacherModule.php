<?php
namespace Nepbaycloudservices\Plugins\Modules;
use Illuminate\Support\Facades\DB;
use Nepbaycloudservices\Backendcp\Controllers\ModuleController;

class TeacherModule extends ModuleController{
    protected $path ='teacher.';

    public function index(){
        $params=[
            'component' => 'kidspro',
            'page'  => 'teacher',
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
}