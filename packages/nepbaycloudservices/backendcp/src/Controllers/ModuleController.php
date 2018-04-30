<?php 
namespace Nepbaycloudservices\Backendcp\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Module;

class ModuleController extends Controller
{   
    protected $template;
    protected $package;
    protected $view;
    protected $headerScripts;
    protected $footerScripts;
    protected $footerModal;
    protected $module;
    

    public function __construct($module =null){

        $this->template = config('packagebridge.default_template');
        $this->package = 'plugins';
        $this->view = array();
        $this->headerScripts = array();
        $this->footerScripts = array();
        $this->footerModal = array();
        $this->module = $module;

        if (isset($_SERVER['HTTP_CLIENT_IP']))
        {
            $this->real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
        }

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $this->real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        else
        {
            $this->real_ip_adress = $_SERVER['REMOTE_ADDR'];
        }
        
        $this->merchantVersion = config('tourismcore.merchant_version');
        $this->merchant = config('tourismcore.merchant');
        $this->merchantId = config('tourismcore.merchant_id');
        $this->merchantKey = config('tourismcore.merchant_key');
        $this->merchantUrl = config('tourismcore.merchant_url');

        $this->npay_merchantId = config('tourismcore.npay_merchant_id');
        $this->npay_merchantName = config('tourismcore.npay_merchant_name');
        $this->npay_merchantApipassword = config('tourismcore.npay_merchant_api_password');
        $this->npay_merchantPortalpassword = config('tourismcore.npay_merchant_portal_password');
        $this->npay_merchantSigpasscode = config('tourismcore.npay_merchant_signature_passcode');
        $this->npay_merchantPanel = config('tourismcore.npay_merchant_panel');
        $this->npay_merchantUrl = config('tourismcore.npay_merchant_url');

        $this->hbl_merchantId = config('tourismcore.hbl_merchant_id');
        $this->hbl_merchantName = config('tourismcore.npay_merchant_name');
        $this->hbl_secretKey = config('tourismcore.hbl_secret_key');
        $this->hbl_merchantUrl = config('tourismcore.hbl_merchant_url');
        $this->hbl_terminalIdUSD = config('tourismcore.hbl_terminal_id_usd');
        $this->hbl_terminalIdNPR = config('tourismcore.hbl_terminal_id_npr');

    }

    public function loadTemplate($module,$package=null){
        $view = $this->template.'.'.$module;
        if(view()->exists($view)){
            return $view;
        } else {

            $view = strtolower($package).'::'.$module;            
            if(view()->exists($view)){               
                return $view;
            }else{
                return null;
            }
        } 
    }

    public function content($content){
        $this->view['content'] = $content;
    }

    public function header_script($script = null){
        if($script)
        {    
            if (!preg_match("~^(?:f|ht)tps?://~i", $script)) {

                array_push ($this->headerScripts , '<script type="text/javascript" src="'.asset( $this->module.'/js/'.$script.'"></script>') );
            }else{
                array_push ($this->headerScripts , '<script type="text/javascript" src="'.$script.'"></script>' );
                
            }
            $this->view['header_scripts']  = implode("\n", $this->headerScripts);            
        }
                     
    }

    public function footer_script($script= null){
        if($script)
        {    
            if (!preg_match("~^(?:f|ht)tps?://~i", $script)) {

                array_push ($this->footerScripts , '<script type="text/javascript" src="'.asset( $this->module.'/js/'.$script.'"></script>') );
            }else{
                array_push ($this->footerScripts , '<script type="text/javascript" src="'.$script.'"></script>' );
                
            }
            $this->view['footer_scripts']  = implode("\n", $this->footerScripts);            
        }             
    }


     public function header_style($style = null){
    
        if($style)
        {    
            if (!preg_match("~^(?:f|ht)tps?://~i", $style)) {

                array_push ($this->headerScripts , '<link type="text/css" rel="stylesheet" href="'.asset( $this->module.'/css/'.$style.'">') );
            }else{

                array_push ($this->headerScripts , '<link type="text/css" rel="stylesheet" href="'.$style.'">' );
                
            }
            $this->view['header_scripts']  = implode("\n", $this->headerScripts);            
        }
                     
    }


    public function footer_style($style = null){
       if($style)
        {    
            if (!preg_match("~^(?:f|ht)tps?://~i", $style)) {

                array_push ($this->footerScripts , '<link type="text/css" rel="stylesheet" href="'.asset( $this->module.'/js/'.$style.'">') );
            }else{
                array_push ($this->footerScripts , '<link type="text/css" rel="stylesheet" href="'.$style.'">' );
                
            }
            $this->view['footer_scripts']  = implode("\n", $this->footerScripts);            
        }
                     
    }


    public function inline_script($script = null){
       if($script)
        {    
            array_push ($this->footerScripts , '<script type="text/javascript">'.$script .'</script>' );            
            $this->view['footer_scripts']  = implode("\n", $this->footerScripts);            
        }
                     
    }

    public function inline_style($style = null){
       if($style)
        {    
            array_push ($this->footerScripts , '<style>'.$style.'</style>' );
            
            $this->view['footer_scripts']  = implode("\n", $this->footerScripts);            
        }
                     
    }

    public function footer_modal($modal = null){
       if($modal)
        {    
            array_push ($this->footerModal , $modal);
            
            $this->view['footer_modal']  = implode("\n", $this->footerModal);            
        }
                     
    }

    public function eventScrips($view, $params=array() ){
        $package = isset($params['package'])? $params['package']:null;
        
        return view($this->loadTemplate($view, $package),$params)->render();  
        
    }

    public function renderPage($params){
        $namesapce = "Nepbaycloudservices\PackageBridge\Controllers\PackageBridgeController";

        return app($namesapce)->page($this->view,$params);
    }

   

}
