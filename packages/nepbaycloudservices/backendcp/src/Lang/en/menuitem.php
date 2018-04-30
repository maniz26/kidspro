<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Menu Items',

    'breadcrum' =>[     
        'list'    => 'Menu Items',
        'create'  => 'Menu Item: New',
        'edit'    => 'Menu Item: Edit',
    ],

    
    'success' => [
        'created' => 'Menu item created.',
        'updated' => 'Menu item updated.',
        'deleted' => '{0} :menu  menu item deleted. |[2,Inf] :menu menu item deleted.',        
        'status_publish' =>  '{0} :menu  menu item published. |[2,Inf] :menu menu item published.' ,         
        'status_unpuslish' => '{0} :menu menu item unpublished. |[2,Inf] :menu menu item unpublished.',
    ],


    'error' => [
        'create' => 'Error on creating Menu item.',
        'update' => 'Error on updating Menu item.',
        'delete' => 'Error on deleting Menu item.',
        'statusupdate' => 'Error updating Menu item Status.',        
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete? Confirming will permanently delete the selected items(s)!',                       
    ],

    'action' =>[

        'alert'=>'Plase first make a selection from the list'
    ],


    'fields' => [        
        'select'        =>'--Select--',
        'name'          => 'Name',
        'parent'        => 'Parent Item',
        'menu'          => 'Menu',
        'status'        => 'Status',
        'description'   => 'Description',        
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',        
        'menu_item_type'  => 'Menu Item Type',
        'select'        => 'Select',
        'position'      => 'Position',
        'target'        => 'Target',
        'target_parent' => 'Parent',
        'target_new'    => 'New Window',
        'select_content'    => 'Select Content',
        'link'          => 'Link',
        'new'           => 'New Menu Item',
        'delete'        => 'Delete',
        'title_placeholder' => 'Menu Name'
       
    ],

    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',        
        'parent_id' => 'Parent Item is required',
        'menu_id'   => 'Menu is required'
    ],
    
    'item'=>[
        'list' => 'Menu Item List'
    ],

    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Menu item?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'no_content_exists' =>'No menu item Exist.',

);



