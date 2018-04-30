<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<menu>
<title>Menus</title>
<icon>ti-menu</icon>
 <submenu>
    <title>List Menu</title>
    <url>{{route('admin.menu.list')}}</url>
 </submenu>
 <submenu>
    <title>New Menu</title>
    <url>{{route('admin.menu.new')}}</url>
 </submenu>
 <submenu>
    <title>Lis Menu Items</title>
    <url>{{route('admin.menu.item.list')}}</url>
 </submenu>
 <submenu>
    <title>New Menu Item</title>
    <url>{{route('admin.menu.item.new')}}</url>
 </submenu>
</menu> 