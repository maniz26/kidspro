<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<menu>
<title>Content</title>
<icon>ti-book</icon>
 <submenu>
    <title>Articles</title>
    <url>{{route('admin.content.list')}}</url>
 </submenu>
 <submenu>
    <title>New Article</title>
    <url>{{route('admin.content.new')}}</url>
 </submenu>
 <submenu>
    <title>Categories</title>
    <url>{{route('admin.content.category.list')}}</url>
 </submenu>
 <submenu>
    <title>New Category</title>
    <url>{{route('admin.content.category.new')}}</url>
 </submenu>
 <frontend>
 		<menu>
 			<title>Single Article</title>
 			<component>ContentModule</component>
 			<type>BACKEND</type> 			
 		</menu> 
 		<menu>
 			<title>Category Blog</title>
 			<component>ContentModule</component>
 			<type>BACKEND</type> 			
 		</menu> 		
 </frontend>
</menu> 