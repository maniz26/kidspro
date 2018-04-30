<?php

if (! function_exists('get_options_translator'))
{
    function get_options_translator($elements, $parent=0, $indent=0){
       $return = array();
         $locator= \App::getLocale();
        foreach($elements as $key => $val) {
            if($val->parent_id == $parent) {
                $val->indent =$indent;
                $val->title = str_repeat('--', $indent). $val->translate($locator)->title;
                $return[] = $val;
                $return = array_merge($return, get_options_translator($elements, $val->id, $indent+1));
            }
        }
        
        return $return;
    }
}

if (! function_exists('get_options'))
{
    function get_options($elements, $parent=0, $indent=0){
       $return = array();         
        foreach($elements as $key => $val) {
            if($val->parent_id == $parent) {
                $val->indent =$indent;
                $val->title = str_repeat('--', $indent). $val->title;
                $return[] = $val;
                $return = array_merge($return, get_options($elements, $val->id, $indent+1));
            }
        }
        
        return $return;
    }
}

if (! function_exists('buildCategory'))
{
    function buildCategory($parent, $category ,$index=null, $expand = false) {
            $html = "";
            $locator= \App::getLocale();
            if (isset($category['parent_cats'][$parent])) {
                
                if( $index == 1){
                    if($expand)
                        $html .= "<ul class=\"sidebar-menu Expandmenu\">\n";
                    else
                        $html .= "<ul class=\"sidebar-menu\">\n";
                }else{
                    $html .= "<ul class=\"sidebar-submenu\">\n";
                }

                foreach ($category['parent_cats'][$parent] as $cat_id) {
                    if (!isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li>\n  <a href='" . route('frontend.category.list',$category['categories'][$cat_id]->alias) . "'>" . $category['categories'][$cat_id]->title . "</a>\n</li> \n";
                    }
                    if (isset($category['parent_cats'][$cat_id])) {
                        $html .= "<li>\n  <a href='" . route('frontend.category.list',$category['categories'][$cat_id]->alias) . "'>" . $category['categories'][$cat_id]->title . "<span><i class=\"fa fa-angle-left pull-right\"></i></span></a> \n";
                        $html .= buildCategory($cat_id, $category);
                        $html .= "</li> \n";
                    }
                }
                $html .= "</ul> \n";
            }
            return $html;
        }
}
if (! function_exists('category_menu'))
{
    function category_menu($category){
        if( !isset($html) ){
            $html ='';
        } 
         $locator= \App::getLocale();
         if( isset($category->subCategory) && count($category->subCategory)> 0 ){
            $html .= '<ul class="search-submenu">';
                foreach ($category->subCategory as $subCat) {
                    if( isset($subCat->subCategory) && count($subCat->subCategory)> 0 ){
                         $image = isset($subCat->icon) && !empty($subCat->icon)? asset('uploads/'.$subCat->icon): asset('classified/img/extra-info.png');
                         $html .= '<li> <a href="#" data-category="'.$subCat->id.'"> <img src="'.$image.'" alt=""> '.$subCat->translate($locator)->title.'</a>';
                         $html .= category_menu($subCat);
                         $html .= "</li> \n"; 
                    }else{
                        $image = isset($subCat->icon) && !empty($subCat->icon)? asset('uploads/'.$subCat->icon): asset('classified/img/extra-info.png');
                        $html .= '<li> <a href="#" data-category="'.$subCat->id.'"><img src="'.$image.'" alt=""> '.$subCat->translate($locator)->title.'</a></li>' ;
                    }       
                }
            $html .= "</ul> \n";            
        }
        
        return $html;
    }
}
if (! function_exists('xml_to_array'))
{
    function xml_to_array($content) {    
        $fileContents = $content;
        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $fileContents);
        $xml = simplexml_load_string($xml);        
        $json = json_encode($xml);
        $responseArray = json_decode($json, true);
        return $responseArray;
    }    
}

if (! function_exists('unique_slug'))
{
    function unique_slug($slugText,$table,$id =null) { 
        $slug = str_slug( $slugText, '-');
        if($id){
            $slugCount = count( DB::table($table)->where('alias',$slug)->where('id', '<>', $id)->get() );          
            return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;
            
        }else{
            $slugCount = count(DB::table($table)->whereRaw("alias REGEXP '^{$slug}(-[0-9]*)?$'")->get()); 
            return ($slugCount > 0) ? "{$slug}-{$slugCount}" : $slug;        
        }
           
        
    }    
}


function generate_image_thumbnail($source_image_path, $thumbnail_image_path,$thumbnail_width=250,$thumbnail_height=300) {
    list($source_image_width, $source_image_height, $source_image_type) = getimagesize($source_image_path);

    $source_aspect_ratio = $source_image_width / $source_image_height;
    $thumbnail_aspect_ratio = $thumbnail_width / $thumbnail_height;
    if ($source_image_width <= $thumbnail_width && $source_image_height <= $thumbnail_height) {
        $thumbnail_image_width = $source_image_width;
        $thumbnail_image_height = $source_image_height;
    } elseif ($thumbnail_aspect_ratio > $source_aspect_ratio) {
        $thumbnail_image_width = (int)($thumbnail_width * $source_aspect_ratio);
        $thumbnail_image_height = $thumbnail_height;
    } else {
        $thumbnail_image_width = $thumbnail_width;
        $thumbnail_image_height = (int)($thumbnail_height / $source_aspect_ratio);
    }
    $thumbnail_gd_image = imagecreatetruecolor($thumbnail_image_width, $thumbnail_image_height);

    switch ($source_image_type) {
        case IMAGETYPE_GIF :
            $source_gd_image = imagecreatefromgif($source_image_path);
            setTransparency($thumbnail_gd_image,$source_gd_image);
            break;
        case IMAGETYPE_JPEG :
            $source_gd_image = imagecreatefromjpeg($source_image_path);
            break;
        case IMAGETYPE_PNG :
            $source_gd_image = imagecreatefrompng($source_image_path);
            setTransparency($thumbnail_gd_image,$source_gd_image);
            break;
    }
    if ($source_gd_image === false) {
        return false;
    }
    
    imagecopyresampled($thumbnail_gd_image, $source_gd_image, 0, 0, 0, 0, $thumbnail_image_width, $thumbnail_image_height, $source_image_width, $source_image_height);
    imagejpeg($thumbnail_gd_image, $thumbnail_image_path, 100);
    imagedestroy($source_gd_image);
    imagedestroy($thumbnail_gd_image);
    return true;
}

function setTransparency($new_image,$image_source){ 
    $transparencyIndex = imagecolortransparent($image_source); 
    $transparencyColor = array('red' => 255, 'green' => 255, 'blue' => 255);     
    if($transparencyIndex >= 0){
        $transparencyColor = imagecolorsforindex($image_source, $transparencyIndex);    
    }
    $transparencyIndex = imagecolorallocate($new_image, $transparencyColor['red'], $transparencyColor['green'], $transparencyColor['blue']); 
    imagefill($new_image, 0, 0, $transparencyIndex); 
    imagecolortransparent($new_image, $transparencyIndex);        
}


function generateDestinationLists(array $elements,$ids=null, $parentId = 0,$indent = 0) {
    //echo "<pre>";print_r($elements);exit;
    $arr = array();
    if($ids != null){
        $dests = explode(',',$ids);
        foreach($dests as $dest){
            $arr[$dest]= $dest;
        }
    }
    $html = '';
    foreach ($elements as $key => $element) {
        if ($element['parent_id'] == $parentId) {
            
                if(isset($arr[$element['id']])){
                    $html.= '<option value="' . $element['id'] . '" selected="selected">';
                    $html.= str_repeat('--', $indent);
                    $html.= $element['title'] . '</option>' . PHP_EOL;
                }else{
                    $html.= '<option value="' . $element['id'] . '">';
                    $html.= str_repeat('--', $indent);
                    $html.= $element['title'] . '</option>' . PHP_EOL;
                }
            $html.= generateDestinationLists($elements,$ids, $element['id'],$indent + 1);
        }
        
    }
    return $html;
}

function translateCurrency($numbers){
   $locator= \App::getLocale();

   $np = array('०','१','२','३','४','५','६','७','८') ;
   $en = array(0,1,2,3,4,5,6,7,8,9) ;

   $numb = (string) $numbers;
   $strLen = strlen($numb);
   $translatedNumber = null ;
   for($i=0;$i<=$strLen; $i++){
        
        $char = substr($numb,$i,1);
        
        switch($locator){
            case 'np':
                if( isset(${$locator}[$char])){
                    $translatedNumber .=${$locator}[$char];    
                }else{
                    $translatedNumber .= $char;
                } 
                break;
            case 'en':
            if( isset(${$locator}[$char])){
                $translatedNumber .=${$locator}[$char];    
            }else{
                $translatedNumber .= $char;
            }
            break;
        }
   }

   return $translatedNumber;



}


if (!function_exists('isAssoc')) {

    function isAssoc($arr) {
        return array_keys($arr) !== range(0, count($arr) - 1);
    }
}


if (!function_exists('language_recusive')) {

    function language_recusive($name,$language,$index,$subIndex=null) {        
        $html ='';
        
        if( is_array($language)) {
            
            foreach ($language as $key => $value) {            
                if( is_array($value)){
                    $subIndex .= '['.$key.']';
                    $html .= language_recusive($name,$value,$index,$subIndex);                
                } else{ 
                    if($subIndex!=''){
                        $fieldName = $name.'['.$index.']'.$subIndex.'['.$key.']';
                    }else{
                        $fieldName = $name.'['.$index.']'.'['.$key.']';    
                    }

                    $html .=' <div class="form-group">
                            <label class="col-sm-3 control-label">'.$key.'</label>
                            <div class="col-sm-9">
                                <input type="text" name="'.$fieldName.'"  class="form-control" value="'.$value.'">
                            </div>
                    </div>';
                }       
            }
        }else{
           $fieldName = $name.'['.$index.']';  
           $html .=' <div class="form-group">
                            <label class="col-sm-3 control-label">'.$index.'</label>
                            <div class="col-sm-9">
                                <input type="text" name="'.$fieldName.'"  class="form-control" value="'.$language.'">
                            </div>
                    </div>'; 
        }

        return $html;
        
    }
}


if (!function_exists('prettyPrint')) {

    function prettyPrint($result, $file) {
        $result= str_replace('&lt;', '<',$result);
        $result= str_replace('&gt;', '>',$result);
        libxml_use_internal_errors(TRUE);
        $dom = new DOMDocument;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($result);
        $dom->formatOutput = true;
        writeFile($file, $dom->saveXML());
        return $dom->saveXML();
    }
}


if (!function_exists('xmlToJson')) {

    function xmlToJson($content) {
    
        //use DOMDocument;
        $fileContents = $content;
        $xml = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $fileContents);
        $xml = simplexml_load_string($xml);        
        $json = json_encode($xml);
        $responseArray = json_decode($json, true);

        return $responseArray;
    }
}

if (!function_exists('writeFile')) {

    function writeFile($file, $content) {
      
        file_put_contents($file, $content);
        
    }
}




if (! function_exists('multilevelMenu'))
{
    function multilevelMenu($parent, $menu ,$index=null, $expand = false) {
        $html = "";
        $locator= \App::getLocale();
        if (isset($menu['parent_item'][$parent])) {
            foreach ($menu['parent_item'][$parent] as $menu_id) {
                if (!isset($menu['parent_item'][$menu_id])) {
                    if (isset($menu['menus'][$menu_id]->external_link)) {
                        $link = $menu['menus'][$menu_id]->external_link;
                    } elseif (isset($menu['menus'][$menu_id]->content_link)) {
                        $link = $menu['menus'][$menu_id]->content_link;
                    } elseif (isset($menu['menus'][$menu_id]->menu_link)) {
                        $content = $menu['menus'][$menu_id]->menu_link;
                        if (false === strpos($content, '[')) {
                            $link = $menu['menus'][$menu_id]->menu_link;
                        } else {
                            $link = app("\Nepbaycloudservices\Backendcp\Modules\ShortcodeModule")
                                ->getShorcodeURI($menu['menus'][$menu_id]->menu_link);
                        }
                    } else {
                        $link = '#';
                    }
                }
                if ($menu['menus'][$menu_id]->title=='Home'){
                    $html .= "<li class='active'>
                            <a href='".$link."' >"
                        . $menu['menus'][$menu_id]->title .
                        "</a>";
                }else{
                    $html .= "<li>
                            <a href='".$link."'>"
                        . $menu['menus'][$menu_id]->title .
                        "</a>";
                }

                if (isset($menu['parent_item'][$menu_id])) {

                    if( isset($menu['menus'][$menu_id]->external_link) ){
                        $link = $menu['menus'][$menu_id]->external_link;
                    }
                    elseif( isset($menu['menus'][$menu_id]->content_link) ){
                        $link = $menu['menus'][$menu_id]->content_link;
                    }
                    elseif( isset($menu['menus'][$menu_id]->menu_link )){
                        $link = $menu['menus'][$menu_id]->menu_link;
                    }
                    else{
                        $link ='#';
                    }

                    $html .= "<ul class=\"dropdown\">";
                    $html .= multilevelMenu($menu_id, $menu);
                    $html .= "
                            </ul>
                            </li>";
                }

            }
        }
        return $html;
    }
}

if (!function_exists('getCurrencyCodeNumber')) {

    function getCurrencyCodeNumber($searchCurrency) {

        $currencycodeStr = "
        W1siRW50aXR5IiwiQ3VycmVuY3kiLCJBbHBoYWJldGljIENvZGUiLCJOdW1lcmljIENvZGUiLCJNaW5vciB1bml0IiwiV2l0aGRyYXdhbCBEYXRlIiwiUmVtYXJrIl0sWyJBRkdIQU5JU1RBTiIsIkFmZ2hhbmkiLCJBRk4iLCI5NzEiLCIyIiwiIiwiIl0sWyJcdTAwYzVMQU5EIElTTEFORFMiLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiQUxCQU5JQSIsIkxlayIsIkFMTCIsIjgiLCIyIiwiIiwiIl0sWyJBTEdFUklBIiwiQWxnZXJpYW4gRGluYXIiLCJEWkQiLCIxMiIsIjIiLCIiLCIiXSxbIkFNRVJJQ0FOIFNBTU9BIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiQU5ET1JSQSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJBTkdPTEEiLCJLd2FuemEiLCJBT0EiLCI5NzMiLCIyIiwiIiwiIl0sWyJBTkdVSUxMQSIsIkVhc3QgQ2FyaWJiZWFuIERvbGxhciIsIlhDRCIsIjk1MSIsIjIiLCIiLCIiXSxbIkFOVEFSQ1RJQ0EiLCJObyB1bml2ZXJzYWwgY3VycmVuY3kiLCIiLCIiLCIiLCIiLCIiXSxbIkFOVElHVUEgQU5EIEJBUkJVREEiLCJFYXN0IENhcmliYmVhbiBEb2xsYXIiLCJYQ0QiLCI5NTEiLCIyIiwiIiwiIl0sWyJBUkdFTlRJTkEiLCJBcmdlbnRpbmUgUGVzbyIsIkFSUyIsIjMyIiwiMiIsIiIsIiJdLFsiQVJNRU5JQSIsIkFybWVuaWFuIERyYW0iLCJBTUQiLCI1MSIsIjIiLCIiLCIiXSxbIkFSVUJBIiwiQXJ1YmFuIEZsb3JpbiIsIkFXRyIsIjUzMyIsIjIiLCIiLCIiXSxbIkFVU1RSQUxJQSIsIkF1c3RyYWxpYW4gRG9sbGFyIiwiQVVEIiwiMzYiLCIyIiwiIiwiIl0sWyJBVVNUUklBIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIkFaRVJCQUlKQU4iLCJBemVyYmFpamFuaWFuIE1hbmF0IiwiQVpOIiwiOTQ0IiwiMiIsIiIsIiJdLFsiQkFIQU1BUyIsIkJhaGFtaWFuIERvbGxhciIsIkJTRCIsIjQ0IiwiMiIsIiIsIiJdLFsiQkFIUkFJTiIsIkJhaHJhaW5pIERpbmFyIiwiQkhEIiwiNDgiLCIzIiwiIiwiIl0sWyJCQU5HTEFERVNIIiwiVGFrYSIsIkJEVCIsIjUwIiwiMiIsIiIsIiJdLFsiQkFSQkFET1MiLCJCYXJiYWRvcyBEb2xsYXIiLCJCQkQiLCI1MiIsIjIiLCIiLCIiXSxbIkJFTEFSVVMiLCJCZWxhcnVzc2lhbiBSdWJsZSIsIkJZUiIsIjk3NCIsIjAiLCIiLCIiXSxbIkJFTEdJVU0iLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiQkVMSVpFIiwiQmVsaXplIERvbGxhciIsIkJaRCIsIjg0IiwiMiIsIiIsIiJdLFsiQkVOSU4iLCJDRkEgRnJhbmMgQkNFQU8iLCJYT0YiLCI5NTIiLCIwIiwiIiwiIl0sWyJCRVJNVURBIiwiQmVybXVkaWFuIERvbGxhciIsIkJNRCIsIjYwIiwiMiIsIiIsIiJdLFsiQkhVVEFOIiwiTmd1bHRydW0iLCJCVE4iLCI2NCIsIjIiLCIiLCIiXSxbIkJIVVRBTiIsIkluZGlhbiBSdXBlZSIsIklOUiIsIjM1NiIsIjIiLCIiLCIiXSxbIkJPTElWSUEsIFBMVVJJTkFUSU9OQUwgU1RBVEUgT0YiLCJCb2xpdmlhbm8iLCJCT0IiLCI2OCIsIjIiLCIiLCIiXSxbIkJPTElWSUEsIFBMVVJJTkFUSU9OQUwgU1RBVEUgT0YiLCJNdmRvbCIsIkJPViIsIjk4NCIsIjIiLCIiLCIiXSxbIkJPTkFJUkUsIFNJTlQgRVVTVEFUSVVTIEFORCBTQUJBIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiQk9TTklBIEFORCBIRVJaRUdPVklOQSIsIkNvbnZlcnRpYmxlIE1hcmsiLCJCQU0iLCI5NzciLCIyIiwiIiwiIl0sWyJCT1RTV0FOQSIsIlB1bGEiLCJCV1AiLCI3MiIsIjIiLCIiLCIiXSxbIkJPVVZFVCBJU0xBTkQiLCJOb3J3ZWdpYW4gS3JvbmUiLCJOT0siLCI1NzgiLCIyIiwiIiwiIl0sWyJCUkFaSUwiLCJCcmF6aWxpYW4gUmVhbCIsIkJSTCIsIjk4NiIsIjIiLCIiLCIiXSxbIkJSSVRJU0ggSU5ESUFOIE9DRUFOIFRFUlJJVE9SWSIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIkJSVU5FSSBEQVJVU1NBTEFNIiwiQnJ1bmVpIERvbGxhciIsIkJORCIsIjk2IiwiMiIsIiIsIiJdLFsiQlVMR0FSSUEiLCJCdWxnYXJpYW4gTGV2IiwiQkdOIiwiOTc1IiwiMiIsIiIsIiJdLFsiQlVSS0lOQSBGQVNPIiwiQ0ZBIEZyYW5jIEJDRUFPIiwiWE9GIiwiOTUyIiwiMCIsIiIsIiJdLFsiQlVSVU5ESSIsIkJ1cnVuZGkgRnJhbmMiLCJCSUYiLCIxMDgiLCIwIiwiIiwiIl0sWyJDQU1CT0RJQSIsIlJpZWwiLCJLSFIiLCIxMTYiLCIyIiwiIiwiIl0sWyJDQU1FUk9PTiIsIkNGQSBGcmFuYyBCRUFDIiwiWEFGIiwiOTUwIiwiMCIsIiIsIiJdLFsiQ0FOQURBIiwiQ2FuYWRpYW4gRG9sbGFyIiwiQ0FEIiwiMTI0IiwiMiIsIiIsIiJdLFsiQ0FQRSBWRVJERSIsIkNhcGUgVmVyZGUgRXNjdWRvIiwiQ1ZFIiwiMTMyIiwiMiIsIiIsIiJdLFsiQ0FZTUFOIElTTEFORFMiLCJDYXltYW4gSXNsYW5kcyBEb2xsYXIiLCJLWUQiLCIxMzYiLCIyIiwiIiwiIl0sWyJDRU5UUkFMIEFGUklDQU4gUkVQVUJMSUMiLCJDRkEgRnJhbmMgQkVBQyIsIlhBRiIsIjk1MCIsIjAiLCIiLCIiXSxbIkNIQUQiLCJDRkEgRnJhbmMgQkVBQyIsIlhBRiIsIjk1MCIsIjAiLCIiLCIiXSxbIkNISUxFIiwiVW5pZGFkZXMgZGUgZm9tZW50byIsIkNMRiIsIjk5MCIsIjAiLCIiLCIiXSxbIkNISUxFIiwiQ2hpbGVhbiBQZXNvIiwiQ0xQIiwiMTUyIiwiMCIsIiIsIiJdLFsiQ0hJTkEiLCJZdWFuIFJlbm1pbmJpIiwiQ05ZIiwiMTU2IiwiMiIsIiIsIiJdLFsiQ0hSSVNUTUFTIElTTEFORCIsIkF1c3RyYWxpYW4gRG9sbGFyIiwiQVVEIiwiMzYiLCIyIiwiIiwiIl0sWyJDT0NPUyAoS0VFTElORykgSVNMQU5EUyIsIkF1c3RyYWxpYW4gRG9sbGFyIiwiQVVEIiwiMzYiLCIyIiwiIiwiIl0sWyJDT0xPTUJJQSIsIkNvbG9tYmlhbiBQZXNvIiwiQ09QIiwiMTcwIiwiMiIsIiIsIiJdLFsiQ09MT01CSUEiLCJVbmlkYWQgZGUgVmFsb3IgUmVhbCIsIkNPVSIsIjk3MCIsIjIiLCIiLCIiXSxbIkNPTU9ST1MiLCJDb21vcm8gRnJhbmMiLCJLTUYiLCIxNzQiLCIwIiwiIiwiIl0sWyJDT05HTyIsIkNGQSBGcmFuYyBCRUFDIiwiWEFGIiwiOTUwIiwiMCIsIiIsIiJdLFsiQ09OR08sIFRIRSBERU1PQ1JBVElDIFJFUFVCTElDIE9GIiwiQ29uZ29sZXNlIEZyYW5jIiwiQ0RGIiwiOTc2IiwiMiIsIiIsIiJdLFsiQ09PSyBJU0xBTkRTIiwiTmV3IFplYWxhbmQgRG9sbGFyIiwiTlpEIiwiNTU0IiwiMiIsIiIsIiJdLFsiQ09TVEEgUklDQSIsIkNvc3RhIFJpY2FuIENvbG9uIiwiQ1JDIiwiMTg4IiwiMiIsIiIsIiJdLFsiQ1x1MDBkNFRFIEQnSVZPSVJFIiwiQ0ZBIEZyYW5jIEJDRUFPIiwiWE9GIiwiOTUyIiwiMCIsIiIsIiJdLFsiQ1JPQVRJQSIsIkNyb2F0aWFuIEt1bmEiLCJIUksiLCIxOTEiLCIyIiwiIiwiIl0sWyJDVUJBIiwiUGVzbyBDb252ZXJ0aWJsZSIsIkNVQyIsIjkzMSIsIjIiLCIiLCIiXSxbIkNVQkEiLCJDdWJhbiBQZXNvIiwiQ1VQIiwiMTkyIiwiMiIsIiIsIiJdLFsiQ1VSQVx1MDBjN0FPIiwiTmV0aGVybGFuZHMgQW50aWxsZWFuIEd1aWxkZXIiLCJBTkciLCI1MzIiLCIyIiwiIiwiIl0sWyJDWVBSVVMiLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiQ1pFQ0ggUkVQVUJMSUMiLCJDemVjaCBLb3J1bmEiLCJDWksiLCIyMDMiLCIyIiwiIiwiIl0sWyJERU5NQVJLIiwiRGFuaXNoIEtyb25lIiwiREtLIiwiMjA4IiwiMiIsIiIsIiJdLFsiREpJQk9VVEkiLCJEamlib3V0aSBGcmFuYyIsIkRKRiIsIjI2MiIsIjAiLCIiLCIiXSxbIkRPTUlOSUNBIiwiRWFzdCBDYXJpYmJlYW4gRG9sbGFyIiwiWENEIiwiOTUxIiwiMiIsIiIsIiJdLFsiRE9NSU5JQ0FOIFJFUFVCTElDIiwiRG9taW5pY2FuIFBlc28iLCJET1AiLCIyMTQiLCIyIiwiIiwiIl0sWyJFQ1VBRE9SIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiRUdZUFQiLCJFZ3lwdGlhbiBQb3VuZCIsIkVHUCIsIjgxOCIsIjIiLCIiLCIiXSxbIkVMIFNBTFZBRE9SIiwiRWwgU2FsdmFkb3IgQ29sb24iLCJTVkMiLCIyMjIiLCIyIiwiIiwiIl0sWyJFTCBTQUxWQURPUiIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIkVRVUFUT1JJQUwgR1VJTkVBIiwiQ0ZBIEZyYW5jIEJFQUMiLCJYQUYiLCI5NTAiLCIwIiwiIiwiIl0sWyJFUklUUkVBIiwiTmFrZmEiLCJFUk4iLCIyMzIiLCIyIiwiIiwiIl0sWyJFU1RPTklBIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIkVUSElPUElBIiwiRXRoaW9waWFuIEJpcnIiLCJFVEIiLCIyMzAiLCIyIiwiIiwiIl0sWyJFVVJPUEVBTiBVTklPTiAiLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiRkFMS0xBTkQgSVNMQU5EUyAoTUFMVklOQVMpIiwiRmFsa2xhbmQgSXNsYW5kcyBQb3VuZCIsIkZLUCIsIjIzOCIsIjIiLCIiLCIiXSxbIkZBUk9FIElTTEFORFMiLCJEYW5pc2ggS3JvbmUiLCJES0siLCIyMDgiLCIyIiwiIiwiIl0sWyJGSUpJIiwiRmlqaSBEb2xsYXIiLCJGSkQiLCIyNDIiLCIyIiwiIiwiIl0sWyJGSU5MQU5EIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIkZSQU5DRSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJGUkVOQ0ggR1VJQU5BIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIkZSRU5DSCBQT0xZTkVTSUEiLCJDRlAgRnJhbmMiLCJYUEYiLCI5NTMiLCIwIiwiIiwiIl0sWyJGUkVOQ0ggU09VVEhFUk4gVEVSUklUT1JJRVMiLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiR0FCT04iLCJDRkEgRnJhbmMgQkVBQyIsIlhBRiIsIjk1MCIsIjAiLCIiLCIiXSxbIkdBTUJJQSIsIkRhbGFzaSIsIkdNRCIsIjI3MCIsIjIiLCIiLCIiXSxbIkdFT1JHSUEiLCJMYXJpIiwiR0VMIiwiOTgxIiwiMiIsIiIsIiJdLFsiR0VSTUFOWSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJHSEFOQSIsIkdoYW5hIENlZGkiLCJHSFMiLCI5MzYiLCIyIiwiIiwiIl0sWyJHSUJSQUxUQVIiLCJHaWJyYWx0YXIgUG91bmQiLCJHSVAiLCIyOTIiLCIyIiwiIiwiIl0sWyJHUkVFQ0UiLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiR1JFRU5MQU5EIiwiRGFuaXNoIEtyb25lIiwiREtLIiwiMjA4IiwiMiIsIiIsIiJdLFsiR1JFTkFEQSIsIkVhc3QgQ2FyaWJiZWFuIERvbGxhciIsIlhDRCIsIjk1MSIsIjIiLCIiLCIiXSxbIkdVQURFTE9VUEUiLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiR1VBTSIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIkdVQVRFTUFMQSIsIlF1ZXR6YWwiLCJHVFEiLCIzMjAiLCIyIiwiIiwiIl0sWyJHVUVSTlNFWSIsIlBvdW5kIFN0ZXJsaW5nIiwiR0JQIiwiODI2IiwiMiIsIiIsIiJdLFsiR1VJTkVBIiwiR3VpbmVhIEZyYW5jIiwiR05GIiwiMzI0IiwiMCIsIiIsIiJdLFsiR1VJTkVBLUJJU1NBVSIsIkNGQSBGcmFuYyBCQ0VBTyIsIlhPRiIsIjk1MiIsIjAiLCIiLCIiXSxbIkdVWUFOQSIsIkd1eWFuYSBEb2xsYXIiLCJHWUQiLCIzMjgiLCIyIiwiIiwiIl0sWyJIQUlUSSIsIkdvdXJkZSIsIkhURyIsIjMzMiIsIjIiLCIiLCIiXSxbIkhBSVRJIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiSEVBUkQgSVNMQU5EIEFORCBNY0RPTkFMRCBJU0xBTkRTIiwiQXVzdHJhbGlhbiBEb2xsYXIiLCJBVUQiLCIzNiIsIjIiLCIiLCIiXSxbIkhPTFkgU0VFIChWQVRJQ0FOIENJVFkgU1RBVEUpIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIkhPTkRVUkFTIiwiTGVtcGlyYSIsIkhOTCIsIjM0MCIsIjIiLCIiLCIiXSxbIkhPTkcgS09ORyIsIkhvbmcgS29uZyBEb2xsYXIiLCJIS0QiLCIzNDQiLCIyIiwiIiwiIl0sWyJIVU5HQVJZIiwiRm9yaW50IiwiSFVGIiwiMzQ4IiwiMiIsIiIsIiJdLFsiSUNFTEFORCIsIkljZWxhbmQgS3JvbmEiLCJJU0siLCIzNTIiLCIwIiwiIiwiIl0sWyJJTkRJQSIsIkluZGlhbiBSdXBlZSIsIklOUiIsIjM1NiIsIjIiLCIiLCIiXSxbIklORE9ORVNJQSIsIlJ1cGlhaCIsIklEUiIsIjM2MCIsIjIiLCIiLCIiXSxbIklOVEVSTkFUSU9OQUwgTU9ORVRBUlkgRlVORCAoSU1GKVx1MDBhMCIsIlNEUiAoU3BlY2lhbCBEcmF3aW5nIFJpZ2h0KSIsIlhEUiIsIjk2MCIsIk4uQS4iLCIiLCIiXSxbIklSQU4sIElTTEFNSUMgUkVQVUJMSUMgT0YiLCJJcmFuaWFuIFJpYWwiLCJJUlIiLCIzNjQiLCIyIiwiIiwiIl0sWyJJUkFRIiwiSXJhcWkgRGluYXIiLCJJUUQiLCIzNjgiLCIzIiwiIiwiIl0sWyJJUkVMQU5EIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIklTTEUgT0YgTUFOIiwiUG91bmQgU3RlcmxpbmciLCJHQlAiLCI4MjYiLCIyIiwiIiwiIl0sWyJJU1JBRUwiLCJOZXcgSXNyYWVsaSBTaGVxZWwiLCJJTFMiLCIzNzYiLCIyIiwiIiwiIl0sWyJJVEFMWSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJKQU1BSUNBIiwiSmFtYWljYW4gRG9sbGFyIiwiSk1EIiwiMzg4IiwiMiIsIiIsIiJdLFsiSkFQQU4iLCJZZW4iLCJKUFkiLCIzOTIiLCIwIiwiIiwiIl0sWyJKRVJTRVkiLCJQb3VuZCBTdGVybGluZyIsIkdCUCIsIjgyNiIsIjIiLCIiLCIiXSxbIkpPUkRBTiIsIkpvcmRhbmlhbiBEaW5hciIsIkpPRCIsIjQwMCIsIjMiLCIiLCIiXSxbIktBWkFLSFNUQU4iLCJUZW5nZSIsIktaVCIsIjM5OCIsIjIiLCIiLCIiXSxbIktFTllBIiwiS2VueWFuIFNoaWxsaW5nIiwiS0VTIiwiNDA0IiwiMiIsIiIsIiJdLFsiS0lSSUJBVEkiLCJBdXN0cmFsaWFuIERvbGxhciIsIkFVRCIsIjM2IiwiMiIsIiIsIiJdLFsiS09SRUEsIERFTU9DUkFUSUMgUEVPUExFXHUyMDE5UyBSRVBVQkxJQyBPRiIsIk5vcnRoIEtvcmVhbiBXb24iLCJLUFciLCI0MDgiLCIyIiwiIiwiIl0sWyJLT1JFQSwgUkVQVUJMSUMgT0YiLCJXb24iLCJLUlciLCI0MTAiLCIwIiwiIiwiIl0sWyJLVVdBSVQiLCJLdXdhaXRpIERpbmFyIiwiS1dEIiwiNDE0IiwiMyIsIiIsIiJdLFsiS1lSR1laU1RBTiIsIlNvbSIsIktHUyIsIjQxNyIsIjIiLCIiLCIiXSxbIkxBTyBQRU9QTEVcdTIwMTlTIERFTU9DUkFUSUMgUkVQVUJMSUMiLCJLaXAiLCJMQUsiLCI0MTgiLCIyIiwiIiwiIl0sWyJMQVRWSUEiLCJMYXR2aWFuIExhdHMiLCJMVkwiLCI0MjgiLCIyIiwiIiwiIl0sWyJMRUJBTk9OIiwiTGViYW5lc2UgUG91bmQiLCJMQlAiLCI0MjIiLCIyIiwiIiwiIl0sWyJMRVNPVEhPIiwiTG90aSIsIkxTTCIsIjQyNiIsIjIiLCIiLCIiXSxbIkxFU09USE8iLCJSYW5kIiwiWkFSIiwiNzEwIiwiMiIsIiIsIiJdLFsiTElCRVJJQSIsIkxpYmVyaWFuIERvbGxhciIsIkxSRCIsIjQzMCIsIjIiLCIiLCIiXSxbIkxJQllBIiwiTGlieWFuIERpbmFyIiwiTFlEIiwiNDM0IiwiMyIsIiIsIiJdLFsiTElFQ0hURU5TVEVJTiIsIlN3aXNzIEZyYW5jIiwiQ0hGIiwiNzU2IiwiMiIsIiIsIiJdLFsiTElUSFVBTklBIiwiTGl0aHVhbmlhbiBMaXRhcyIsIkxUTCIsIjQ0MCIsIjIiLCIiLCIiXSxbIkxVWEVNQk9VUkciLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiTUFDQU8iLCJQYXRhY2EiLCJNT1AiLCI0NDYiLCIyIiwiIiwiIl0sWyJNQUNFRE9OSUEsIFRIRSBGT1JNRVIgWVVHT1NMQVYgUkVQVUJMSUMgT0YiLCJEZW5hciIsIk1LRCIsIjgwNyIsIjIiLCIiLCIiXSxbIk1BREFHQVNDQVIiLCJNYWxhZ2FzeSBBcmlhcnkiLCJNR0EiLCI5NjkiLCIyIiwiIiwiIl0sWyJNQUxBV0kiLCJLd2FjaGEiLCJNV0siLCI0NTQiLCIyIiwiIiwiIl0sWyJNQUxBWVNJQSIsIk1hbGF5c2lhbiBSaW5nZ2l0IiwiTVlSIiwiNDU4IiwiMiIsIiIsIiJdLFsiTUFMRElWRVMiLCJSdWZpeWFhIiwiTVZSIiwiNDYyIiwiMiIsIiIsIiJdLFsiTUFMSSIsIkNGQSBGcmFuYyBCQ0VBTyIsIlhPRiIsIjk1MiIsIjAiLCIiLCIiXSxbIk1BTFRBIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIk1BUlNIQUxMIElTTEFORFMiLCJVUyBEb2xsYXIiLCJVU0QiLCI4NDAiLCIyIiwiIiwiIl0sWyJNQVJUSU5JUVVFIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIk1BVVJJVEFOSUEiLCJPdWd1aXlhIiwiTVJPIiwiNDc4IiwiMiIsIiIsIiJdLFsiTUFVUklUSVVTIiwiTWF1cml0aXVzIFJ1cGVlIiwiTVVSIiwiNDgwIiwiMiIsIiIsIiJdLFsiTUFZT1RURSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJNRU1CRVIgQ09VTlRSSUVTIE9GIFRIRSBBRlJJQ0FOIERFVkVMT1BNRU5UIEJBTksgR1JPVVAiLCJBREIgVW5pdCBvZiBBY2NvdW50IiwiWFVBIiwiOTY1IiwiTi5BLiIsIiIsIiJdLFsiTUVYSUNPIiwiTWV4aWNhbiBQZXNvIiwiTVhOIiwiNDg0IiwiMiIsIiIsIiJdLFsiTUVYSUNPIiwiTWV4aWNhbiBVbmlkYWQgZGUgSW52ZXJzaW9uIChVREkpIiwiTVhWIiwiOTc5IiwiMiIsIiIsIiJdLFsiTUlDUk9ORVNJQSwgRkVERVJBVEVEIFNUQVRFUyBPRiIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIk1PTERPVkEsIFJFUFVCTElDIE9GIiwiTW9sZG92YW4gTGV1IiwiTURMIiwiNDk4IiwiMiIsIiIsIiJdLFsiTU9OQUNPIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIk1PTkdPTElBIiwiVHVncmlrIiwiTU5UIiwiNDk2IiwiMiIsIiIsIiJdLFsiTU9OVEVORUdSTyIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJNT05UU0VSUkFUIiwiRWFzdCBDYXJpYmJlYW4gRG9sbGFyIiwiWENEIiwiOTUxIiwiMiIsIiIsIiJdLFsiTU9ST0NDTyIsIk1vcm9jY2FuIERpcmhhbSIsIk1BRCIsIjUwNCIsIjIiLCIiLCIiXSxbIk1PWkFNQklRVUUiLCJNb3phbWJpcXVlIE1ldGljYWwiLCJNWk4iLCI5NDMiLCIyIiwiIiwiIl0sWyJNWUFOTUFSIiwiS3lhdCIsIk1NSyIsIjEwNCIsIjIiLCIiLCIiXSxbIk5BTUlCSUEiLCJOYW1pYmlhIERvbGxhciIsIk5BRCIsIjUxNiIsIjIiLCIiLCIiXSxbIk5BTUlCSUEiLCJSYW5kIiwiWkFSIiwiNzEwIiwiMiIsIiIsIiJdLFsiTkFVUlUiLCJBdXN0cmFsaWFuIERvbGxhciIsIkFVRCIsIjM2IiwiMiIsIiIsIiJdLFsiTkVQQUwiLCJOZXBhbGVzZSBSdXBlZSIsIk5QUiIsIjUyNCIsIjIiLCIiLCIiXSxbIk5FVEhFUkxBTkRTIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIk5FVyBDQUxFRE9OSUEiLCJDRlAgRnJhbmMiLCJYUEYiLCI5NTMiLCIwIiwiIiwiIl0sWyJORVcgWkVBTEFORCIsIk5ldyBaZWFsYW5kIERvbGxhciIsIk5aRCIsIjU1NCIsIjIiLCIiLCIiXSxbIk5JQ0FSQUdVQSIsIkNvcmRvYmEgT3JvIiwiTklPIiwiNTU4IiwiMiIsIiIsIiJdLFsiTklHRVIiLCJDRkEgRnJhbmMgQkNFQU8iLCJYT0YiLCI5NTIiLCIwIiwiIiwiIl0sWyJOSUdFUklBIiwiTmFpcmEiLCJOR04iLCI1NjYiLCIyIiwiIiwiIl0sWyJOSVVFIiwiTmV3IFplYWxhbmQgRG9sbGFyIiwiTlpEIiwiNTU0IiwiMiIsIiIsIiJdLFsiTk9SRk9MSyBJU0xBTkQiLCJBdXN0cmFsaWFuIERvbGxhciIsIkFVRCIsIjM2IiwiMiIsIiIsIiJdLFsiTk9SVEhFUk4gTUFSSUFOQSBJU0xBTkRTIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiTk9SV0FZIiwiTm9yd2VnaWFuIEtyb25lIiwiTk9LIiwiNTc4IiwiMiIsIiIsIiJdLFsiT01BTiIsIlJpYWwgT21hbmkiLCJPTVIiLCI1MTIiLCIzIiwiIiwiIl0sWyJQQUtJU1RBTiIsIlBha2lzdGFuIFJ1cGVlIiwiUEtSIiwiNTg2IiwiMiIsIiIsIiJdLFsiUEFMQVUiLCJVUyBEb2xsYXIiLCJVU0QiLCI4NDAiLCIyIiwiIiwiIl0sWyJQQUxFU1RJTklBTiBURVJSSVRPUlksIE9DQ1VQSUVEIiwiTm8gdW5pdmVyc2FsIGN1cnJlbmN5IiwiIiwiIiwiIiwiIiwiIl0sWyJQQU5BTUEiLCJCYWxib2EiLCJQQUIiLCI1OTAiLCIyIiwiIiwiIl0sWyJQQU5BTUEiLCJVUyBEb2xsYXIiLCJVU0QiLCI4NDAiLCIyIiwiIiwiIl0sWyJQQVBVQSBORVcgR1VJTkVBIiwiS2luYSIsIlBHSyIsIjU5OCIsIjIiLCIiLCIiXSxbIlBBUkFHVUFZIiwiR3VhcmFuaSIsIlBZRyIsIjYwMCIsIjAiLCIiLCIiXSxbIlBFUlUiLCJOdWV2byBTb2wiLCJQRU4iLCI2MDQiLCIyIiwiIiwiIl0sWyJQSElMSVBQSU5FUyIsIlBoaWxpcHBpbmUgUGVzbyIsIlBIUCIsIjYwOCIsIjIiLCIiLCIiXSxbIlBJVENBSVJOIiwiTmV3IFplYWxhbmQgRG9sbGFyIiwiTlpEIiwiNTU0IiwiMiIsIiIsIiJdLFsiUE9MQU5EIiwiWmxvdHkiLCJQTE4iLCI5ODUiLCIyIiwiIiwiIl0sWyJQT1JUVUdBTCIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJQVUVSVE8gUklDTyIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIlFBVEFSIiwiUWF0YXJpIFJpYWwiLCJRQVIiLCI2MzQiLCIyIiwiIiwiIl0sWyJSXHUwMGM5VU5JT04iLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiUk9NQU5JQSIsIk5ldyBSb21hbmlhbiBMZXUiLCJST04iLCI5NDYiLCIyIiwiIiwiIl0sWyJSVVNTSUFOIEZFREVSQVRJT04iLCJSdXNzaWFuIFJ1YmxlIiwiUlVCIiwiNjQzIiwiMiIsIiIsIiJdLFsiUldBTkRBIiwiUndhbmRhIEZyYW5jIiwiUldGIiwiNjQ2IiwiMCIsIiIsIiJdLFsiU0FJTlQgQkFSVEhcdTAwYzlMRU1ZIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIlNBSU5UIEhFTEVOQSwgQVNDRU5TSU9OIEFORCBUUklTVEFOIERBIENVTkhBIiwiU2FpbnQgSGVsZW5hIFBvdW5kIiwiU0hQIiwiNjU0IiwiMiIsIiIsIiJdLFsiU0FJTlQgS0lUVFMgQU5EIE5FVklTIiwiRWFzdCBDYXJpYmJlYW4gRG9sbGFyIiwiWENEIiwiOTUxIiwiMiIsIiIsIiJdLFsiU0FJTlQgTFVDSUEiLCJFYXN0IENhcmliYmVhbiBEb2xsYXIiLCJYQ0QiLCI5NTEiLCIyIiwiIiwiIl0sWyJTQUlOVCBNQVJUSU4gKEZSRU5DSCBQQVJUKSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJTQUlOVCBQSUVSUkUgQU5EIE1JUVVFTE9OIiwiRXVybyIsIkVVUiIsIjk3OCIsIjIiLCIiLCIiXSxbIlNBSU5UIFZJTkNFTlQgQU5EIFRIRSBHUkVOQURJTkVTIiwiRWFzdCBDYXJpYmJlYW4gRG9sbGFyIiwiWENEIiwiOTUxIiwiMiIsIiIsIiJdLFsiU0FNT0EiLCJUYWxhIiwiV1NUIiwiODgyIiwiMiIsIiIsIiJdLFsiU0FOIE1BUklOTyIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJTQU8gVE9NRSBBTkQgUFJJTkNJUEUiLCJEb2JyYSIsIlNURCIsIjY3OCIsIjIiLCIiLCIiXSxbIlNBVURJIEFSQUJJQSIsIlNhdWRpIFJpeWFsIiwiU0FSIiwiNjgyIiwiMiIsIiIsIiJdLFsiU0VORUdBTCIsIkNGQSBGcmFuYyBCQ0VBTyIsIlhPRiIsIjk1MiIsIjAiLCIiLCIiXSxbIlNFUkJJQSAiLCJTZXJiaWFuIERpbmFyIiwiUlNEIiwiOTQxIiwiMiIsIiIsIiJdLFsiU0VZQ0hFTExFUyIsIlNleWNoZWxsZXMgUnVwZWUiLCJTQ1IiLCI2OTAiLCIyIiwiIiwiIl0sWyJTSUVSUkEgTEVPTkUiLCJMZW9uZSIsIlNMTCIsIjY5NCIsIjIiLCIiLCIiXSxbIlNJTkdBUE9SRSIsIlNpbmdhcG9yZSBEb2xsYXIiLCJTR0QiLCI3MDIiLCIyIiwiIiwiIl0sWyJTSU5UIE1BQVJURU4gKERVVENIIFBBUlQpIiwiTmV0aGVybGFuZHMgQW50aWxsZWFuIEd1aWxkZXIiLCJBTkciLCI1MzIiLCIyIiwiIiwiIl0sWyJTSVNURU1BIFVOSVRBUklPIERFIENPTVBFTlNBQ0lPTiBSRUdJT05BTCBERSBQQUdPUyBcIlNVQ1JFXCIgIiwiU3VjcmUiLCJYU1UiLCI5OTQiLCJOLkEuIiwiIiwiIl0sWyJTTE9WQUtJQSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJTTE9WRU5JQSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJTT0xPTU9OIElTTEFORFMiLCJTb2xvbW9uIElzbGFuZHMgRG9sbGFyIiwiU0JEIiwiOTAiLCIyIiwiIiwiIl0sWyJTT01BTElBIiwiU29tYWxpIFNoaWxsaW5nIiwiU09TIiwiNzA2IiwiMiIsIiIsIiJdLFsiU09VVEggQUZSSUNBIiwiUmFuZCIsIlpBUiIsIjcxMCIsIjIiLCIiLCIiXSxbIlNPVVRIIEdFT1JHSUEgQU5EIFRIRSBTT1VUSCBTQU5EV0lDSCBJU0xBTkRTIiwiTm8gdW5pdmVyc2FsIGN1cnJlbmN5IiwiIiwiIiwiIiwiIiwiIl0sWyJTT1VUSCBTVURBTiIsIlNvdXRoIFN1ZGFuZXNlIFBvdW5kIiwiU1NQIiwiNzI4IiwiMiIsIiIsIiJdLFsiU1BBSU4iLCJFdXJvIiwiRVVSIiwiOTc4IiwiMiIsIiIsIiJdLFsiU1JJIExBTktBIiwiU3JpIExhbmthIFJ1cGVlIiwiTEtSIiwiMTQ0IiwiMiIsIiIsIiJdLFsiU1VEQU4iLCJTdWRhbmVzZSBQb3VuZCIsIlNERyIsIjkzOCIsIjIiLCIiLCIiXSxbIlNVUklOQU1FIiwiU3VyaW5hbSBEb2xsYXIiLCJTUkQiLCI5NjgiLCIyIiwiIiwiIl0sWyJTVkFMQkFSRCBBTkQgSkFOIE1BWUVOIiwiTm9yd2VnaWFuIEtyb25lIiwiTk9LIiwiNTc4IiwiMiIsIiIsIiJdLFsiU1dBWklMQU5EIiwiTGlsYW5nZW5pIiwiU1pMIiwiNzQ4IiwiMiIsIiIsIiJdLFsiU1dFREVOIiwiU3dlZGlzaCBLcm9uYSIsIlNFSyIsIjc1MiIsIjIiLCIiLCIiXSxbIlNXSVRaRVJMQU5EIiwiV0lSIEV1cm8iLCJDSEUiLCI5NDciLCIyIiwiIiwiIl0sWyJTV0lUWkVSTEFORCIsIlN3aXNzIEZyYW5jIiwiQ0hGIiwiNzU2IiwiMiIsIiIsIiJdLFsiU1dJVFpFUkxBTkQiLCJXSVIgRnJhbmMiLCJDSFciLCI5NDgiLCIyIiwiIiwiIl0sWyJTWVJJQU4gQVJBQiBSRVBVQkxJQyIsIlN5cmlhbiBQb3VuZCIsIlNZUCIsIjc2MCIsIjIiLCIiLCIiXSxbIlRBSVdBTiwgUFJPVklOQ0UgT0YgQ0hJTkEiLCJOZXcgVGFpd2FuIERvbGxhciIsIlRXRCIsIjkwMSIsIjIiLCIiLCIiXSxbIlRBSklLSVNUQU4iLCJTb21vbmkiLCJUSlMiLCI5NzIiLCIyIiwiIiwiIl0sWyJUQU5aQU5JQSwgVU5JVEVEIFJFUFVCTElDIE9GIiwiVGFuemFuaWFuIFNoaWxsaW5nIiwiVFpTIiwiODM0IiwiMiIsIiIsIiJdLFsiVEhBSUxBTkQiLCJCYWh0IiwiVEhCIiwiNzY0IiwiMiIsIiIsIiJdLFsiVElNT1ItTEVTVEUiLCJVUyBEb2xsYXIiLCJVU0QiLCI4NDAiLCIyIiwiIiwiIl0sWyJUT0dPIiwiQ0ZBIEZyYW5jIEJDRUFPIiwiWE9GIiwiOTUyIiwiMCIsIiIsIiJdLFsiVE9LRUxBVSIsIk5ldyBaZWFsYW5kIERvbGxhciIsIk5aRCIsIjU1NCIsIjIiLCIiLCIiXSxbIlRPTkdBIiwiUGFcdTIwMTlhbmdhIiwiVE9QIiwiNzc2IiwiMiIsIiIsIiJdLFsiVFJJTklEQUQgQU5EIFRPQkFHTyIsIlRyaW5pZGFkIGFuZCBUb2JhZ28gRG9sbGFyIiwiVFREIiwiNzgwIiwiMiIsIiIsIiJdLFsiVFVOSVNJQSIsIlR1bmlzaWFuIERpbmFyIiwiVE5EIiwiNzg4IiwiMyIsIiIsIiJdLFsiVFVSS0VZIiwiVHVya2lzaCBMaXJhIiwiVFJZIiwiOTQ5IiwiMiIsIiIsIiJdLFsiVFVSS01FTklTVEFOIiwiVHVya21lbmlzdGFuIE5ldyBNYW5hdCIsIlRNVCIsIjkzNCIsIjIiLCIiLCIiXSxbIlRVUktTIEFORCBDQUlDT1MgSVNMQU5EUyIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIlRVVkFMVSIsIkF1c3RyYWxpYW4gRG9sbGFyIiwiQVVEIiwiMzYiLCIyIiwiIiwiIl0sWyJVR0FOREEiLCJVZ2FuZGEgU2hpbGxpbmciLCJVR1giLCI4MDAiLCIyIiwiIiwiIl0sWyJVS1JBSU5FIiwiSHJ5dm5pYSIsIlVBSCIsIjk4MCIsIjIiLCIiLCIiXSxbIlVOSVRFRCBBUkFCIEVNSVJBVEVTIiwiVUFFIERpcmhhbSIsIkFFRCIsIjc4NCIsIjIiLCIiLCIiXSxbIlVOSVRFRCBLSU5HRE9NIiwiUG91bmQgU3RlcmxpbmciLCJHQlAiLCI4MjYiLCIyIiwiIiwiIl0sWyJVTklURUQgU1RBVEVTIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiVU5JVEVEIFNUQVRFUyIsIlVTIERvbGxhciAoTmV4dCBkYXkpIiwiVVNOIiwiOTk3IiwiMiIsIiIsIiJdLFsiVU5JVEVEIFNUQVRFUyIsIlVTIERvbGxhciAoU2FtZSBkYXkpIiwiVVNTIiwiOTk4IiwiMiIsIiIsIiJdLFsiVU5JVEVEIFNUQVRFUyBNSU5PUiBPVVRMWUlORyBJU0xBTkRTIiwiVVMgRG9sbGFyIiwiVVNEIiwiODQwIiwiMiIsIiIsIiJdLFsiVVJVR1VBWSIsIlVydWd1YXkgUGVzbyBlbiBVbmlkYWRlcyBJbmRleGFkYXMgKFVSVUlVUlVJKSIsIlVZSSIsIjk0MCIsIjAiLCIiLCIiXSxbIlVSVUdVQVkiLCJQZXNvIFVydWd1YXlvIiwiVVlVIiwiODU4IiwiMiIsIiIsIiJdLFsiVVpCRUtJU1RBTiIsIlV6YmVraXN0YW4gU3VtIiwiVVpTIiwiODYwIiwiMiIsIiIsIiJdLFsiVkFOVUFUVSIsIlZhdHUiLCJWVVYiLCI1NDgiLCIwIiwiIiwiIl0sWyJWYXRpY2FuIENpdHkgU3RhdGUgKEhPTFkgU0VFKSIsIkV1cm8iLCJFVVIiLCI5NzgiLCIyIiwiIiwiIl0sWyJWRU5FWlVFTEEsIEJPTElWQVJJQU4gUkVQVUJMSUMgT0YiLCJCb2xpdmFyIEZ1ZXJ0ZSIsIlZFRiIsIjkzNyIsIjIiLCIiLCIiXSxbIlZJRVQgTkFNIiwiRG9uZyIsIlZORCIsIjcwNCIsIjAiLCIiLCIiXSxbIlZJUkdJTiBJU0xBTkRTIChCUklUSVNIKSIsIlVTIERvbGxhciIsIlVTRCIsIjg0MCIsIjIiLCIiLCIiXSxbIlZJUkdJTiBJU0xBTkRTIChVUykiLCJVUyBEb2xsYXIiLCJVU0QiLCI4NDAiLCIyIiwiIiwiIl0sWyJXQUxMSVMgQU5EIEZVVFVOQSIsIkNGUCBGcmFuYyIsIlhQRiIsIjk1MyIsIjAiLCIiLCIiXSxbIldFU1RFUk4gU0FIQVJBIiwiTW9yb2NjYW4gRGlyaGFtIiwiTUFEIiwiNTA0IiwiMiIsIiIsIiJdLFsiWUVNRU4iLCJZZW1lbmkgUmlhbCIsIllFUiIsIjg4NiIsIjIiLCIiLCIiXSxbIlpBTUJJQSIsIlphbWJpYW4gS3dhY2hhIiwiWk1LIiwiODk0IiwiMiIsIiIsIiJdLFsiWklNQkFCV0UiLCJaaW1iYWJ3ZSBEb2xsYXIiLCJaV0wiLCI5MzIiLCIyIiwiIiwiIl0sWyJaWjAxX0JvbmQgTWFya2V0cyBVbml0IEV1cm9wZWFuX0VVUkNPIiwiQm9uZCBNYXJrZXRzIFVuaXQgRXVyb3BlYW4gQ29tcG9zaXRlIFVuaXQgKEVVUkNPKSIsIlhCQSIsIjk1NSIsIk4uQS4iLCIiLCIiXSxbIlpaMDJfQm9uZCBNYXJrZXRzIFVuaXQgRXVyb3BlYW5fRU1VLTYiLCJCb25kIE1hcmtldHMgVW5pdCBFdXJvcGVhbiBNb25ldGFyeSBVbml0IChFLk0uVS4tNikiLCJYQkIiLCI5NTYiLCJOLkEuIiwiIiwiIl0sWyJaWjAzX0JvbmQgTWFya2V0cyBVbml0IEV1cm9wZWFuX0VVQS05IiwiQm9uZCBNYXJrZXRzIFVuaXQgRXVyb3BlYW4gVW5pdCBvZiBBY2NvdW50IDkgKEUuVS5BLi05KSIsIlhCQyIsIjk1NyIsIk4uQS4iLCIiLCIiXSxbIlpaMDRfQm9uZCBNYXJrZXRzIFVuaXQgRXVyb3BlYW5fRVVBLTE3IiwiQm9uZCBNYXJrZXRzIFVuaXQgRXVyb3BlYW4gVW5pdCBvZiBBY2NvdW50IDE3IChFLlUuQS4tMTcpIiwiWEJEIiwiOTU4IiwiTi5BLiIsIiIsIiJdLFsiWlowNV9VSUMtRnJhbmMiLCJVSUMtRnJhbmMiLCJYRlUiLCJOaWwiLCJOLkEuIiwiIiwiIl0sWyJaWjA2X1Rlc3RpbmdfQ29kZSIsIkNvZGVzIHNwZWNpZmljYWxseSByZXNlcnZlZCBmb3IgdGVzdGluZyBwdXJwb3NlcyIsIlhUUyIsIjk2MyIsIk4uQS4iLCIiLCIiXSxbIlpaMDdfTm9fQ3VycmVuY3kiLCJUaGUgY29kZXMgYXNzaWduZWQgZm9yIHRyYW5zYWN0aW9ucyB3aGVyZSBubyBjdXJyZW5jeSBpcyBpbnZvbHZlZCIsIlhYWCIsIjk5OSIsIk4uQS4iLCIiLCIiXSxbIlpaMDhfR29sZCIsIkdvbGQiLCJYQVUiLCI5NTkiLCJOLkEuIiwiIiwiIl0sWyJaWjA5X1BhbGxhZGl1bSIsIlBhbGxhZGl1bSIsIlhQRCIsIjk2NCIsIk4uQS4iLCIiLCIiXSxbIlpaMTBfUGxhdGludW0iLCJQbGF0aW51bSIsIlhQVCIsIjk2MiIsIk4uQS4iLCIiLCIiXSxbIlpaMTFfU2lsdmVyIiwiU2lsdmVyIiwiWEFHIiwiOTYxIiwiTi5BLiIsIiIsIiJdLFsiQUZHSEFOSVNUQU4iLCJBZmdoYW5pIiwiQUZBIiwiNCIsIiIsIjIwMDMtMDEiLCIiXSxbIlx1MDBjNUxBTkQgSVNMQU5EUyIsIk1hcmtrYSIsIkZJTSIsIjI0NiIsIiIsIjIwMDItMDMiLCIiXSxbIkFMQkFOSUEiLCJPbGQgTGVrIiwiQUxLIiwiXHUyMDE0IiwiIiwiMTk4OS0xMiIsIm5vbiBJU08gY29kZSJdLFsiQU5ET1JSQSIsIkFuZG9ycmFuIFBlc2V0YSIsIkFEUCIsIjIwIiwiIiwiMjAwMy0wNyIsIiJdLFsiQU5ET1JSQSIsIlNwYW5pc2ggUGVzZXRhIiwiRVNQIiwiNzI0IiwiIiwiMjAwMi0wMyIsIiJdLFsiQU5ET1JSQSIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjIwMDItMDMiLCIiXSxbIkFOR09MQSIsIkt3YW56YSIsIkFPSyIsIlx1MjAxNCIsIiIsIjE5OTEtMDMiLCIiXSxbIkFOR09MQSIsIk5ldyBLd2FuemEiLCJBT04iLCIyNCIsIiIsIjIwMDAtMDIiLCIiXSxbIkFOR09MQSIsIkt3YW56YSBSZWFqdXN0YWRvIiwiQU9SIiwiOTgyIiwiIiwiMjAwMC0wMiIsIiJdLFsiQVJHRU5USU5BIiwiQXVzdHJhbCIsIkFSQSIsIjMyIiwiIiwiMTk5Mi0wMSIsIiJdLFsiQVJHRU5USU5BIiwiUGVzbyBBcmdlbnRpbm8iLCJBUlAiLCIzMiIsIiIsIjE5ODUtMDciLCIiXSxbIkFSR0VOVElOQSIsIlBlc28iLCJBUlkiLCJcdTIwMTQiLCIiLCIxOTg5IHRvIDE5OTAiLCJub24gSVNPIGNvZGUiXSxbIkFSTUVOSUEiLCJSdXNzaWFuIFJ1YmxlIiwiUlVSIiwiODEwIiwiIiwiMTk5NC0wOCIsIiJdLFsiQVVTVFJJQSIsIlNjaGlsbGluZyIsIkFUUyIsIjQwIiwiIiwiMjAwMi0wMyIsIiJdLFsiQVpFUkJBSUpBTiIsIkF6ZXJiYWlqYW4gTWFuYXQiLCJBWU0iLCI5NDUiLCIiLCIyMDA1LTEwIiwibm9uIElTTyBjb2RlIl0sWyJBWkVSQkFJSkFOIiwiQXplcmJhaWphbmlhbiBNYW5hdCIsIkFaTSIsIjMxIiwiIiwiMjAwNS0xMiIsIiJdLFsiQVpFUkJBSUpBTiIsIlJ1c3NpYW4gUnVibGUiLCJSVVIiLCI4MTAiLCIiLCIxOTk0LTA4IiwiIl0sWyJCRUxBUlVTIiwiQmVsYXJ1c3NpYW4gUnVibGUiLCJCWUIiLCIxMTIiLCIiLCIyMDAxLTAxIiwiIl0sWyJCRUxBUlVTIiwiUnVzc2lhbiBSdWJsZSIsIlJVUiIsIjgxMCIsIiIsIjE5OTQtMDYiLCIiXSxbIkJFTEdJVU0iLCJDb252ZXJ0aWJsZSBGcmFuYyIsIkJFQyIsIjk5MyIsIiIsIjE5OTAtMDMiLCIiXSxbIkJFTEdJVU0iLCJCZWxnaWFuIEZyYW5jICIsIkJFRiIsIjU2IiwiIiwiMjAwMi0wMyIsIiJdLFsiQkVMR0lVTSIsIkZpbmFuY2lhbCBGcmFuYyIsIkJFTCIsIjk5MiIsIiIsIjE5OTAtMDMiLCIiXSxbIkJPTElWSUEiLCJQZXNvIGJvbGl2aWFubyIsIkJPUCIsIlx1MjAxNCIsIiIsIjE5ODctMDIiLCIiXSxbIkJPU05JQSBBTkQgSEVSWkVHT1ZJTkEiLCJEaW5hciIsIkJBRCIsIjcwIiwiIiwiMTk5Ny0wNyIsIiJdLFsiQlJBWklMIiwiQ3J1emVpcm8iLCJCUkIiLCJcdTIwMTQiLCIiLCIxOTg2LTAzIiwiIl0sWyJCUkFaSUwiLCJDcnV6YWRvIiwiQlJDIiwiNzYiLCIiLCIxOTg5LTAyIiwiIl0sWyJCUkFaSUwiLCJDcnV6ZWlybyIsIkJSRSIsIjc2IiwiIiwiMTk5My0wMyIsIiJdLFsiQlJBWklMIiwiTmV3IENydXphZG8iLCJCUk4iLCI3NiIsIiIsIjE5OTAtMDMiLCIiXSxbIkJSQVpJTCIsIkNydXplaXJvIFJlYWwiLCJCUlIiLCI5ODciLCIiLCIxOTk0LTA3IiwiIl0sWyJCVUxHQVJJQSIsIkxldiBBXC81MiIsIkJHSiIsIlx1MjAxNCIsIiIsIjE5ODkgdG8gMTk5MCIsIm5vbiBJU08gY29kZSJdLFsiQlVMR0FSSUEiLCJMZXYgQVwvNjIiLCJCR0siLCJcdTIwMTQiLCIiLCIxOTg5IHRvIDE5OTAiLCJub24gSVNPIGNvZGUiXSxbIkJVTEdBUklBIiwiTGV2IiwiQkdMIiwiMTAwIiwiIiwiMjAwMy0xMSIsIiJdLFsiQlVSTUFcdTAwYTAiLCJOLkEuIiwiQlVLIiwiXHUyMDE0IiwiIiwiMTk5MC0wMiIsIiJdLFsiQ0hJTkEiLCJQZW9wbGVzIEJhbmsgRG9sbGFyIiwiQ05YIiwiXHUyMDE0IiwiIiwiMTk4OS0xMiIsIm5vbiBJU08gY29kZSJdLFsiQ1JPQVRJQSIsIkNyb2F0aWFuIERpbmFyIiwiSFJEIiwiMTkxIiwiIiwiMTk5NS0wMSIsIiJdLFsiQ1lQUlVTIiwiQ3lwcnVzIFBvdW5kIiwiQ1lQIiwiMTk2IiwiIiwiMjAwOC0wMSIsIiJdLFsiQ1pFQ0hPU0xPVkFLSUEiLCJLcm9uYSBBXC81MyIsIkNTSiIsIlx1MjAxNCIsIiIsIjE5ODkgdG8gMTk5MCIsIm5vbiBJU08gY29kZSJdLFsiQ1pFQ0hPU0xPVkFLSUEiLCJLb3J1bmEiLCJDU0siLCIyMDAiLCIiLCIxOTkzLTAzIiwiIl0sWyJFQ1VBRE9SIiwiU3VjcmUiLCJFQ1MiLCIyMTgiLCIiLCIyMDAwLTA5IiwiIl0sWyJFQ1VBRE9SIiwiVW5pZGFkIGRlIFZhbG9yIENvbnN0YW50ZSAoVVZDKSIsIkVDViIsIjk4MyIsIiIsIjIwMDAtMDkiLCIiXSxbIkVRVUFUT1JJQUwgR1VJTkVBIiwiRWt3ZWxlIiwiRVFFIiwiXHUyMDE0IiwiIiwiMTk4OS0xMiIsIiJdLFsiRVFVQVRPUklBTCBHVUlORUEiLCJFa3dlbGUiLCJHUUUiLCIyMjYiLCIiLCIxOTg2LTA2IiwiIl0sWyJFU1RPTklBIiwiS3Jvb24iLCJFRUsgIiwiMjMzIiwiIiwiMjAxMS0wMSIsIiJdLFsiRVVST1BFQU4gTU9ORVRBUlkgQ08tT1BFUkFUSU9OIEZVTkQgKEVNQ0YpICIsIkV1cm9wZWFuIEN1cnJlbmN5IFVuaXQgKEUuQy5VKSAiLCJYRVUgIiwiOTU0IiwiIiwiMTk5OS0wMSAiLCIiXSxbIkZJTkxBTkQiLCJNYXJra2EiLCJGSU0iLCIyNDYiLCIiLCIyMDAyLTAzIiwiIl0sWyJGUkFOQ0UiLCJGcmVuY2ggRnJhbmMiLCJGUkYiLCIyNTAiLCIiLCIyMDAyLTAzIiwiIl0sWyJGUkVOQ0ggIEdVSUFOQSIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjIwMDItMDMiLCIiXSxbIkZSRU5DSCBTT1VUSEVSTiBURVJSSVRPUklFUyIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjIwMDItMDMiLCIiXSxbIkdFT1JHSUEiLCJHZW9yZ2lhbiBDb3Vwb24iLCJHRUsiLCIyNjgiLCIiLCIxOTk1LTEwIiwiIl0sWyJHRU9SR0lBIiwiUnVzc2lhbiBSdWJsZSIsIlJVUiIsIjgxMCIsIiIsIjE5OTQtMDQiLCIiXSxbIkdFUk1BTiBERU1PQ1JBVElDIFJFUFVCTElDIiwiTWFyayBkZXIgRERSIiwiRERNIiwiMjc4IiwiIiwiMTk5MC0wNyB0byAxOTkwLTA5IiwiIl0sWyJHRVJNQU5ZIiwiRGV1dHNjaGUgTWFyayIsIkRFTSIsIjI3NiIsIiIsIjIwMDItMDMiLCIiXSxbIkdIQU5BIiwiQ2VkaSIsIkdIQyIsIjI4OCIsIiIsIjIwMDgtMDEiLCIiXSxbIkdIQU5BIiwiR2hhbmEgQ2VkaSAiLCJHSFAiLCI5MzkiLCIiLCIyMDA3LTA2IiwiIl0sWyJHUkVFQ0UiLCJEcmFjaG1hIiwiR1JEIiwiMzAwIiwiIiwiMjAwMi0wMyIsIiJdLFsiR1VBREVMT1VQRSIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjIwMDItMDMiLCIiXSxbIkdVSU5FQSIsIlN5bGkiLCJHTkUiLCJcdTIwMTQiLCIiLCIxOTg5LTEyIiwibm9uIElTTyBjb2RlIl0sWyJHVUlORUEiLCJTeWxpIiwiR05TIiwiXHUyMDE0IiwiIiwiMTk4Ni0wMiIsIiJdLFsiR1VJTkVBLUJJU1NBVSIsIkd1aW5lYSBFc2N1ZG8iLCJHV0UiLCJcdTIwMTQiLCIiLCIxOTc4IHRvIDE5ODEiLCIiXSxbIkdVSU5FQS1CSVNTQVUiLCJHdWluZWEtQmlzc2F1IFBlc28iLCJHV1AiLCI2MjQiLCIiLCIxOTk3LTA1IiwiIl0sWyJIT0xZIFNFRSAoVkFUSUNBTiBDSVRZIFNUQVRFKSIsIkl0YWxpYW4gTGlyYSIsIklUTCIsIjM4MCIsIiIsIjIwMDItMDMiLCIiXSxbIklDRUxBTkQiLCJPbGQgS3JvbmEiLCJJU0oiLCJcdTIwMTQiLCIiLCIxOTg5IHRvIDE5OTAiLCJub24gSVNPIGNvZGUiXSxbIklSRUxBTkQiLCJJcmlzaCBQb3VuZCIsIklFUCIsIjM3MiIsIiIsIjIwMDItMDMiLCIiXSxbIklTUkFFTCIsIlBvdW5kIiwiSUxQIiwiXHUyMDE0IiwiIiwiMTk3OCB0byAxOTgxIiwiIl0sWyJJU1JBRUwiLCJPbGQgU2hla2VsIiwiSUxSIiwiXHUyMDE0IiwiIiwiMTk4OSB0byAxOTkwIiwibm9uIElTTyBjb2RlIl0sWyJJVEFMWSIsIkl0YWxpYW4gTGlyYSIsIklUTCIsIjM4MCIsIiIsIjIwMDItMDMiLCIiXSxbIktBWkFLSFNUQU4iLCJSdXNzaWFuIFJ1YmxlIiwiUlVSIiwiODEwIiwiIiwiMTk5NC0wNSIsIiJdLFsiS1lSR1laU1RBTiIsIlJ1c3NpYW4gUnVibGUiLCJSVVIiLCI4MTAiLCIiLCIxOTkzLTAxIiwiIl0sWyJMQU8iLCJLaXAgUG90IFBvbCIsIkxBSiIsIlx1MjAxNCIsIiIsIjE5ODktMTIiLCJub24gSVNPIGNvZGUiXSxbIkxBVFZJQSIsIkxhdHZpYW4gUnVibGUiLCJMVlIiLCI0MjgiLCIiLCIxOTk0LTEyIiwiIl0sWyJMRVNPVEhPIiwiTWFsb3RpIiwiTFNNIiwiXHUyMDE0IiwiIiwiMTk4NS0wNSIsIiJdLFsiTEVTT1RITyIsIkZpbmFuY2lhbCBSYW5kIiwiWkFMIiwiOTkxIiwiIiwiMTk5NS0wMyIsIiJdLFsiTElUSFVBTklBIiwiVGFsb25hcyIsIkxUVCIsIjQ0MCIsIiIsIjE5OTMtMDciLCIiXSxbIkxVWEVNQk9VUkciLCJMdXhlbWJvdXJnIENvbnZlcnRpYmxlIEZyYW5jIiwiTFVDIiwiOTg5IiwiIiwiMTk5MC0wMyIsIiJdLFsiTFVYRU1CT1VSRyIsIkx1eGVtYm91cmcgRnJhbmMiLCJMVUYiLCI0NDIiLCIiLCIyMDAyLTAzIiwiIl0sWyJMVVhFTUJPVVJHIiwiTHV4ZW1ib3VyZyBGaW5hbmNpYWwgRnJhbmMiLCJMVUwiLCI5ODgiLCIiLCIxOTkwLTAzIiwiIl0sWyJNQURBR0FTQ0FSIiwiTWFsYWdhc3kgRnJhbmMiLCJNR0YiLCI0NTAiLCIiLCIyMDA0LTEyIiwiIl0sWyJNQUxESVZFUyIsIk1hbGRpdmUgUnVwZWUiLCJNVlEiLCJcdTIwMTQiLCIiLCIxOTg5LTEyIiwibm9uIElTTyBjb2RlIl0sWyJNQUxJIiwiTWFsaSBGcmFuYyIsIk1BRiIsIlx1MjAxNCIsIiIsIjE5ODktMTIiLCJub24gSVNPIGNvZGUiXSxbIk1BTEkiLCJNYWxpIEZyYW5jIiwiTUxGIiwiNDY2IiwiIiwiMTk4NC0xMSIsIiJdLFsiTUFMVEEiLCJNYWx0ZXNlIExpcmEiLCJNVEwiLCI0NzAiLCIiLCIyMDA4LTAxIiwiIl0sWyJNQUxUQSIsIk1hbHRlc2UgUG91bmQiLCJNVFAiLCJcdTIwMTQiLCIiLCIxOTgzLTA2IiwiIl0sWyJNQVJUSU5JUVVFIiwiRnJlbmNoIEZyYW5jIiwiRlJGIiwiMjUwIiwiIiwiMjAwMi0wMyIsIiJdLFsiTUFZT1RURSIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjIwMDItMDMiLCIiXSxbIk1FWElDTyIsIk1leGljYW4gUGVzbyIsIk1YUCIsIlx1MjAxNCAiLCIiLCIxOTkzLTAxICIsIiJdLFsiTU9MRE9WQSwgUkVQVUJMSUMgT0YiLCJSdXNzaWFuIFJ1YmxlIiwiUlVSIiwiODEwIiwiIiwiMTk5My0xMiIsIiJdLFsiTU9OQUNPIiwiRnJlbmNoIEZyYW5jIiwiRlJGIiwiMjUwIiwiIiwiMjAwMi0wMyIsIiJdLFsiTU9aQU1CSVFVRSIsIk1vemFtYmlxdWUgRXNjdWRvIiwiTVpFIiwiXHUyMDE0IiwiIiwiMTk3OCB0byAxOTgxIiwiIl0sWyJNT1pBTUJJUVVFIiwiTW96YW1iaXF1ZSBNZXRpY2FsIiwiTVpNIiwiNTA4IiwiIiwiMjAwNi0wNiIsIiJdLFsiTkVUSEVSTEFORFMiLCJOZXRoZXJsYW5kcyBHdWlsZGVyIiwiTkxHIiwiNTI4IiwiIiwiMjAwMi0wMyIsIiJdLFsiTkVUSEVSTEFORFMgQU5USUxMRVMiLCJOZXRoZXJsYW5kcyBBbnRpbGxlYW4gR3VpbGRlciAiLCJBTkciLCI1MzIiLCIiLCIyMDEwLTEwIiwiIl0sWyJOSUNBUkFHVUEiLCJDb3Jkb2JhIiwiTklDIiwiXHUyMDE0IiwiIiwiMTk5MC0xMCIsIiJdLFsiUEVSVSIsIlNvbCIsIlBFSCIsIlx1MjAxNCIsIiIsIjE5ODkgdG8gMTk5MCIsIm5vbiBJU08gY29kZSJdLFsiUEVSVSIsIkludGkiLCJQRUkiLCI2MDQiLCIiLCIxOTkxLTA3IiwiIl0sWyJQRVJVIiwiU29sIiwiUEVTIiwiNjA0IiwiIiwiMTk4Ni0wMiIsIiJdLFsiUE9MQU5EIiwiWmxvdHkiLCJQTFoiLCI2MTYiLCIiLCIxOTk3LTAxIiwiIl0sWyJQT1JUVUdBTCIsIlBvcnR1Z3Vlc2UgRXNjdWRvIiwiUFRFIiwiNjIwIiwiIiwiMjAwMi0wMyIsIiJdLFsiUlx1MDBjOVVOSU9OIiwiRnJlbmNoIEZyYW5jIiwiRlJGIiwiMjUwIiwiIiwiMjAwMi0wMyIsIiJdLFsiUk9NQU5JQSIsIkxldSBBXC81MiIsIlJPSyIsIlx1MjAxNCIsIiIsIjE5ODkgdG8gMTk5MCIsIm5vbiBJU08gY29kZSJdLFsiUk9NQU5JQSIsIk9sZCBMZXUiLCJST0wiLCI2NDIiLCIiLCIyMDA1LTA2IiwiIl0sWyJSVVNTSUFOIEZFREVSQVRJT04iLCJSdXNzaWFuIFJ1YmxlIiwiUlVSIiwiODEwIiwiIiwiMjAwNC0wMSIsIiJdLFsiU0FJTlQgTUFSVElOIiwiRnJlbmNoIEZyYW5jIiwiRlJGIiwiMjUwIiwiIiwiMTk5OS0wMSIsIiJdLFsiU0FJTlQgUElFUlJFIEFORCBNSVFVRUxPTiIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjIwMDItMDMiLCIiXSxbIlNBSU5ULUJBUlRIXHUwMGM5TEVNWSIsIkZyZW5jaCBGcmFuYyIsIkZSRiIsIjI1MCIsIiIsIjE5OTktMDEiLCIiXSxbIlNBTiBNQVJJTk8iLCJJdGFsaWFuIExpcmEiLCJJVEwiLCIzODAiLCIiLCIyMDAyLTAzIiwiIl0sWyJTRVJCSUEgQU5EIE1PTlRFTkVHUk8iLCJTZXJiaWFuIERpbmFyIiwiQ1NEIiwiODkxIiwiIiwiMjAwNi0xMCIsIiJdLFsiU0VSQklBIEFORCBNT05URU5FR1JPIiwiRXVybyIsIkVVUiAiLCI5NzgiLCIiLCIyMDA2LTEwIiwiIl0sWyJTTE9WQUtJQSIsIlNsb3ZhayBLb3J1bmEiLCJTS0siLCI3MDMiLCIiLCIyMDA5LTAxIiwiIl0sWyJTTE9WRU5JQSIsIlRvbGFyIiwiU0lUIiwiNzA1IiwiIiwiMjAwNy0wMSIsIiJdLFsiU09VVEggQUZSSUNBIiwiRmluYW5jaWFsIFJhbmQiLCJaQUwiLCI5OTEiLCIiLCIxOTk1LTAzIiwiIl0sWyJTT1VUSEVSTiBSSE9ERVNJQVx1MDBhMCIsIlJob2Rlc2lhbiBEb2xsYXIiLCJSSEQiLCJcdTIwMTQiLCIiLCIxOTc4IHRvIDE5ODEiLCIiXSxbIlNQQUlOIiwiU3BhbmlzaCBQZXNldGEiLCJFU0EiLCI5OTYiLCIiLCIxOTc4IHRvIDE5ODEiLCIiXSxbIlNQQUlOIiwiXCJBXCIgQWNjb3VudCAoY29udmVydGlibGUgUGVzZXRhIEFjY291bnQpIiwiRVNCIiwiOTk1IiwiIiwiMTk5NC0xMiIsIiJdLFsiU1BBSU4iLCJTcGFuaXNoIFBlc2V0YSIsIkVTUCIsIjcyNCIsIiIsIjIwMDItMDMiLCIiXSxbIlNVREFOIiwiU3VkYW5lc2UgRGluYXIiLCJTREQiLCI3MzYiLCIiLCIyMDA3LTA3IiwiIl0sWyJTVURBTiIsIlN1ZGFuZXNlIFBvdW5kIiwiU0RQIiwiXHUyMDE0IiwiIiwiMTk5OC0wNiIsIiJdLFsiU1VSSU5BTUUiLCJTdXJpbmFtIEd1aWxkZXIiLCJTUkciLCI3NDAiLCIiLCIyMDAzLTEyIiwiIl0sWyJTV0lUWkVSTEFORCIsIldJUiBGcmFuYyAoZm9yIGVsZWN0cm9uaWMpIiwiQ0hDIiwiOTQ4IiwiIiwiMjAwNC0xMSIsIiJdLFsiVEFKSUtJU1RBTiIsIlJ1c3NpYW4gUnVibGUiLCJSVVIiLCI4MTAiLCIiLCIxOTk1LTA1IiwiIl0sWyJUQUpJS0lTVEFOIiwiVGFqaWsgUnVibGUiLCJUSlIiLCI3NjIiLCIiLCIyMDAxLTA0IiwiIl0sWyJUSU1PUi1MRVNURSIsIlJ1cGlhaCIsIklEUiIsIjM2MCIsIiIsIjIwMDItMDciLCIiXSxbIlRJTU9SLUxFU1RFIiwiVGltb3IgRXNjdWRvIiwiVFBFIiwiNjI2IiwiIiwiMjAwMi0xMSIsIiJdLFsiVFVSS0VZIiwiT2xkIFR1cmtpc2ggTGlyYSIsIlRSTCIsIjc5MiIsIiIsIjIwMDUtMTIiLCIiXSxbIlRVUktFWSIsIk5ldyBUdXJraXNoIExpcmEiLCJUUlkiLCI5NDkiLCIiLCIyMDA5LTAxIiwiIl0sWyJUVVJLTUVOSVNUQU4iLCJSdXNzaWFuIFJ1YmxlIiwiUlVSIiwiODEwIiwiIiwiMTk5My0xMCIsIiJdLFsiVFVSS01FTklTVEFOIiwiVHVya21lbmlzdGFuIE1hbmF0IiwiVE1NIiwiNzk1IiwiIiwiMjAwOS0wMSIsIiJdLFsiVUdBTkRBIiwiVWdhbmRhIFNoaWxsaW5nIiwiVUdTIiwiXHUyMDE0IiwiIiwiMTk4Ny0wNSIsIiJdLFsiVUdBTkRBIiwiT2xkIFNoaWxsaW5nIiwiVUdXIiwiXHUyMDE0IiwiIiwiMTk4OSB0byAxOTkwIiwibm9uIElTTyBjb2RlIl0sWyJVS1JBSU5FIiwiS2FyYm92YW5ldCIsIlVBSyIsIjgwNCIsIiIsIjE5OTYtMDkiLCIiXSxbIlVOSU9OIE9GIFNPVklFVCBTT0NJQUxJU1QgUkVQVUJMSUNTIiwiUm91YmxlIiwiU1VSIiwiXHUyMDE0IiwiIiwiMTk5MC0xMiIsIiJdLFsiVVJVR1VBWSIsIk9sZCBVcnVndWF5IFBlc28iLCJVWU4iLCJcdTIwMTQiLCIiLCIxOTg5LTEyIiwibm9uIElTTyBjb2RlIl0sWyJVUlVHVUFZIiwiVXJ1Z3VheWFuIFBlc28iLCJVWVAiLCJcdTIwMTQgICIsIiIsIjE5OTMtMDMiLCIiXSxbIlVaQkVLSVNUQU4iLCJSdXNzaWFuIFJ1YmxlIiwiUlVSIiwiODEwIiwiIiwiMTk5NC0wNyIsIiJdLFsiVkVORVpVRUxBIiwiQm9saXZhciIsIlZFQiIsIjg2MiIsIiIsIjIwMDgtMDEiLCIiXSxbIlZJRVROQU0iLCJPbGQgRG9uZyIsIlZOQyIsIlx1MjAxNCIsIiIsIjE5ODktMTk5MCIsIm5vbiBJU08gY29kZSJdLFsiWUVNRU4sIERFTU9DUkFUSUMiLCJZZW1lbmkgRGluYXIiLCJZREQiLCI3MjAiLCIiLCIxOTkxLTA5IiwiIl0sWyJZVUdPU0xBVklBIiwiTmV3IFl1Z29zbGF2aWFuIERpbmFyIiwiWVVEIiwiXHUyMDE0IiwiIiwiMTk5MC0wMSIsIiJdLFsiWVVHT1NMQVZJQSIsIk5ldyBEaW5hciIsIllVTSIsIjg5MSIsIiIsIjIwMDMtMDciLCIiXSxbIllVR09TTEFWSUEiLCJZdWdvc2xhdmlhbiBEaW5hciIsIllVTiIsIjg5MCIsIiIsIjE5OTUtMTEiLCIiXSxbIlpBSVJFIiwiTmV3IFphaXJlIiwiWlJOIiwiMTgwIiwiIiwiMTk5OS0wNiIsIiJdLFsiWkFJUkUiLCJaYWlyZSIsIlpSWiIsIjE4MCIsIiIsIjE5OTQtMDIiLCIiXSxbIlpJTUJBQldFIiwiUmhvZGVzaWFuIERvbGxhciIsIlpXQyIsIlx1MjAxNCIsIiIsIjE5ODktMTIiLCJub24gSVNPIGNvZGUiXSxbIlpJTUJBQldFIiwiWmltYmFid2UgRG9sbGFyIChvbGQpIiwiWldEIiwiNzE2IiwiIiwiMjAwNi0wOCIsIiJdLFsiWklNQkFCV0UiLCJaaW1iYWJ3ZSBEb2xsYXIiLCJaV0QiLCI3MTYiLCIiLCIyMDA4LTA4IiwiIl0sWyJaSU1CQUJXRSIsIlppbWJhYndlIERvbGxhciAobmV3KSIsIlpXTiIsIjk0MiIsIiIsIjIwMDYtMDkiLCIiXSxbIlpJTUJBQldFIiwiWmltYmFid2UgRG9sbGFyIiwiWldSIiwiOTM1IiwiIiwiMjAwOS0wNiIsIiJdLFsiWlowMV9Hb2xkLUZyYW5jIiwiR29sZC1GcmFuYyIsIlhGTyIsIlx1MjAxNCIsIiIsIjIwMDYtMTAiLCIiXSxbIlpaMDJfUklORVQgRnVuZHMgQ29kZSIsIlJJTkVUIEZ1bmRzIENvZGUiLCJYUkUiLCJOLkEuIiwiIiwiMTk5OS0xMSIsIiJdXQ==
            ";

        $CurrencyCode = json_decode(base64_decode($currencycodeStr), true);

        foreach ($CurrencyCode as $k => $value) {
            if (in_array($searchCurrency, $value)) {
                $getccode = $CurrencyCode[$k][3];
                break;
            }
        }

        return $getccode;
    }
}





