<?php
namespace Nepbaycloudservices\Backendcp\Modules;
use Nepbaycloudservices\Backendcp\Models\Template;
use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Content;
use Nepbaycloudservices\Backendcp\Requests\ContentRequest;
use Nepbaycloudservices\Backendcp\Models\ContentCategory;
use Nepbaycloudservices\Backendcp\Requests\ContentCategoryRequest;
use Packagebridge;
use Validator;
use DataTables;
use File;
use Auth;
use Lang;
use Addons;
use DB;
use Config;

class TemplateModule extends ModuleController
{
    /**
     * GetMenu Items
     *
     * Add Menu to Admin Menu Item
     * @return View
     *
     */
    public function getmenuItems(){

        return view('backendcp::Template.menu-xml')->render();

    }
    public function list(){
        $data=DB::table('templates as t')
            ->join('template_sections as ts', 'ts.id', '=', 't.section')
            ->select('t.*')
            ->where('ts.section','appearence')
            ->get();
        $title='Appearence';
        return view('backendcp::Template.list',compact('data','title'));
    }
    public function layout($title){
        $template_id=$this->getTemplateId();
        if($title=="Contact"){
            $data=DB::table('templates as t')
                ->join('template_sections as ts', 'ts.id', '=', 't.section')
                ->select('t.*')
                ->where('ts.section',$title)
                ->get();
        }else{
            $data=DB::table('templates as t')
                ->join('template_sections as ts', 'ts.id', '=', 't.section')
                ->select('t.*')
                ->where('ts.section',$title)
                ->where('t.parent',$template_id)
            ->get();
        }


        return view('backendcp::Template.customize',compact('data','title'));
    }


    public function publish($id,$title)
    {
        $template_id=$this->getTemplateId();
        if($title=="Appearence"){
            $data = DB::table('templates as t')
                ->join('template_sections as ts', 'ts.id', '=', 't.section')
                ->where('ts.section','Appearence')
                ->where('t.status',1)
                ->select('t.status','ts.section','t.title')
                ->update(['status'=>'0']);
            $use=Template::find($id);
            $use->status='1';
            $use->save();
            Config::write(['packagebridge.default_template'=>$use->title]);
        }elseif($title=="Contact"){
            $data = DB::table('templates as t')
                ->join('template_sections as ts', 'ts.id', '=', 't.section')
                ->where('ts.section',$title)
                ->where('t.status',1)
                ->select('t.status','ts.section','t.title')
                ->update(['status'=>'0']);
            $use=Template::find($id);
            $use->status='1';
            $use->save();
        }else{
            $data = DB::table('templates as t')
                ->join('template_sections as ts', 'ts.id', '=', 't.section')
                ->where('ts.section',$title)
                ->where('t.status',1)
                ->where('t.parent',$template_id)
                ->select('t.status','ts.section','t.title')
                ->update(['status'=>'0']);
            $use=Template::find($id);
            $use->status='1';
            $use->save();
        }

        return redirect()->back();
    }

    public function getTemplateId(){

        $template_id=DB::table('templates')
            ->select('id')
            ->where('title',$this->template = config('packagebridge.default_template'))
            ->first();
        return $template_id->id;
    }

    public function preview($title,$id)
    {
        $validId = Template::where('id', $id)->where('parent', 0)->get();
        if ($validId) {
            $template = DB::table('templates')
                ->select('id')
                ->where('title', $title)
                ->first();
            if ($template->id == $id) {
                $header = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'Header')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($header) {
                    $header = $header->title;
                }

                $course = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'Course')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($course) {
                    $course = $course->title;
                }
                $footer = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'footer')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($footer) {
                    $footer = $footer->title;
                }
                $feature = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'feature')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($feature) {
                    $feature = $feature->title;
                }
                $teacher = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'teacher')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($teacher) {
                    $teacher = $teacher->title;
                }
                $news = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'news')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($news) {
                    $news = $news->title;
                }
                $testimonial = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'testimonial')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($testimonial) {
                    $testimonial = $testimonial->title;
                }
                $params = [
                    'component' => 'classified',
                    'page' => 'home',
                    'wrapper_class' => 'row'
                ];
                return view('' . $title . '.index', compact('params', 'header', 'footer', 'course', 'feature', 'teacher', 'news', 'testimonial'));

            }elseif(DB::table('menu_items')->where('external_link',$id)->get()->count()>0){
                $header = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'Header')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($header) {
                    $header = $header->title;
                }
                $footer = DB::table('templates as t')
                    ->join('template_sections as ts', 'ts.id', '=', 't.section')
                    ->select('t.*')
                    ->where('ts.section', 'footer')
                    ->where('status', 1)
                    ->where('t.parent', $template->id)
                    ->first();
                if ($footer) {
                    $footer = $footer->title;
                }
                $params = [
                    'component' => 'classified',
                    'page' => 'home',
                    'wrapper_class' => 'row'
                ];
                return view('' . $title.'.'.$id . '.index', compact('params', 'header', 'footer', 'course', 'feature', 'teacher', 'news', 'testimonial'));
            }else {
                abort('404');
            }
        }else {
            abort('404');
        }
    }


}
?>