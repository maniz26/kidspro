<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<menu>
<title>Module</title>
<icon>ti-book</icon>
 <submenu>
    <title>Module List</title>
    <url>{{route('admin.module.list')}}</url>
 </submenu>
 <submenu>
    <title>Install Module</title>
    <url>{{route('admin.module.install')}}</url>
 </submenu>

</menu> 