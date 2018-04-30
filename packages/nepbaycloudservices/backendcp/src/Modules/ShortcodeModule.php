<?php 
namespace Nepbaycloudservices\Backendcp\Modules;

use Nepbaycloudservices\Backendcp\Controllers\ModuleController;
use Illuminate\Http\Request;
use Nepbaycloudservices\Backendcp\Models\Module;
use Nepbaycloudservices\Backendcp\Models\ModulePosition;
use Packagebridge;
use File;
use Zipper;
use Artisan;
use DB;
use DataTables;
use DOMDocument;

class ShortcodeModule extends ModuleController
{   
    protected $template;
    protected $path ='Shortcode.';

    public function __construct(){
       $this->template = config('packagebridge.default_template');          
    }

    public function getShorcodeURI($content){

        preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
        $tagnames = $matches[1];
        $pattern = $this->get_shortcode_regex( $tagnames );
        $content = preg_replace_callback( "/$pattern/", array(get_class($this), 'do_shortcode_tag'), $content );   
        return $content;     
    }

    protected function get_shortcode_regex( $tagnames = null ) {
           
          $tagregexp = join( '|', array_map('preg_quote', $tagnames) );
           
            // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
            // Also, see shortcode_unautop() and shortcode.js.
            return
                      '\\['                              // Opening bracket
                    . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
                    . "($tagregexp)"                     // 2: Shortcode name
                    . '(?![\\w-])'                       // Not followed by word character or hyphen
                    . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
                    .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
                    .     '(?:'
                    .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
                    .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
                    .     ')*?'
                    . ')'
                    . '(?:'
                    .     '(\\/)'                        // 4: Self closing tag ...
                    .     '\\]'                          // ... and closing bracket
                    . '|'
                    .     '\\]'                          // Closing bracket
                    .     '(?:'
                    .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
                    .             '[^\\[]*+'             // Not an opening bracket
                    .             '(?:'
                    .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
                    .                 '[^\\[]*+'         // Not an opening bracket
                    .             ')*+'
                    .         ')'
                    .         '\\[\\/\\2\\]'             // Closing shortcode tag
                    .     ')?'
                    . ')'
                    . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }

    protected function shortcode_parse_atts($text) {
        $atts = array();
        $pattern = $this->get_shortcode_atts_regex();
        $text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
        if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
                foreach ($match as $m) {
                        if (!empty($m[1]))
                                $atts[strtolower($m[1])] = stripcslashes($m[2]);
                        elseif (!empty($m[3]))
                                $atts[strtolower($m[3])] = stripcslashes($m[4]);
                        elseif (!empty($m[5]))
                                $atts[strtolower($m[5])] = stripcslashes($m[6]);
                        elseif (isset($m[7]) && strlen($m[7]))
                                $atts[] = stripcslashes($m[7]);
                        elseif (isset($m[8]) && strlen($m[8]))
                                $atts[] = stripcslashes($m[8]);
                        elseif (isset($m[9]))
                                $atts[] = stripcslashes($m[9]);
                }
                // Reject any unclosed HTML elements
                foreach( $atts as &$value ) {
                        if ( false !== strpos( $value, '<' ) ) {
                                if ( 1 !== preg_match( '/^[^<]*+(?:<[^>]*+>[^<]*+)*+$/', $value ) ) {
                                        $value = '';
                                }
                        }
                }
        } else {
                $atts = ltrim($text);
        }
        return $atts;
    }

    protected function get_shortcode_atts_regex() {
            return '/([\w-]+)\s*=\s*"([^"]*)"(?:\s|$)|([\w-]+)\s*=\s*\'([^\']*)\'(?:\s|$)|([\w-]+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|\'([^\']*)\'(?:\s|$)|(\S+)(?:\s|$)/';
    }

    public function do_shortcode_tag($m){
        
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr($m[0], 1, -1);
        }

        $tag = $m[2];
        $attr = $this->shortcode_parse_atts( $m[3] );
      
        $controllerName = "\Nepbaycloudservices\Plugins\Modules\[module]";        
        $controllerName = str_replace('[module]', ucfirst(strtolower($tag)).'Module', $controllerName); 
        if(method_exists($controllerName, 'executeShortcode')){                 
            $content = isset( $m[5] ) ? $m[5] : null  ;          
            $params = app($controllerName)->executeShortcode( $attr, $content, $tag);
            $output = $m[1] . $params . $m[6];
            return $output;

        }else{           
            return $m[0];
        }
    }
    

}
