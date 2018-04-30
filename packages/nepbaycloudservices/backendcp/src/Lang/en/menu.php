<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Menus',

    'breadcrum' =>[     
        'list'    => 'Menus',
        'create'  => 'Menu: New',
        'edit'    => 'Menu: Edit',

        'item'=>[
            'list' => 'Menu Item List'
        ] 
    ],

    
    'success' => [
        'created' => 'Menu created.',
        'updated' => 'Menu updated.',
        'deleted' => '{0} :menu  menu deleted. |[2,Inf] :menu menu deleted.',        
        'status_publish' =>  '{0} :menu  menu published. |[2,Inf] :menu menu published.' ,         
        'status_unpuslish' => '{0} :menu menu unpublished. |[2,Inf] :menu menu unpublished.',
    ],


    'error' => [
        'create' => 'Error on creating Menu.',
        'update' => 'Error on updating Menu.',
        'delete' => 'Error on deleting Menu.',
        'statusupdate' => 'Error updating Menu Status.',        
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
        'new'           => 'New Menu',
        'delete'        => 'Delete',
        'title_placeholder' => 'Menu Name',
        'short_code'    => 'Short Code',
       
    ],

    'placeholders' =>[
         'title'        => 'Enter City Name. Eg. Kathmandu',
         'description'  => 'Describe the City'
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
        'body'          => 'Are you sure you want to delete this Menu?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'no_content_exists' =>'No menu Exist.',

);



