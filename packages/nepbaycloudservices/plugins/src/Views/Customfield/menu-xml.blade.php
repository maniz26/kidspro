<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<menu>
<title>Custom Fields</title>
<icon>ti-layout-list-post</icon>
 <submenu>
    <title>List Custom Fields</title>
    <url>{{route('admin.customfield.list')}}</url>
 </submenu>
 <submenu>
    <title>New Custom Field</title>
    <url>{{route('admin.customfield.new')}}</url>
 </submenu>
</menu> 