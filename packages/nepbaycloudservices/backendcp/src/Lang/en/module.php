<?php
/**
* Language file for category
*
*/

return array(

    'title' =>'Modules',

    'breadcrum' =>[     
        'list'    => 'Modules List',
        'create'  => 'Install Module',        
    ],

    'success' => [
        'create' => 'Module installed  successfully.',        
        'delete' => 'Module is deleted.',
        'statusupdate' => 'Module status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this addon(s)?',                
        'deleted'   => 'There was an issue uninstalling the addons. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Module.',
        'update' => 'Error on updating Module.',        
    ],

    'fields' => [        
        'name'          => 'Name',
        'position'      => 'Position',       
        'status'        => 'Status',
        'description'   => 'Description',
        'upload'        => 'Upload Module File',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'save'          => 'Install Now',
        'new'           => 'Install'
       
    ],

    'list' => [        
        'name'          => 'Name',
        'position'      => 'Position',       
        'status'        => 'Status',
        'created'       => 'Created On', 
        'actions'       => "Actoins"
    ],

    'validation' =>[
        'invalid_file' =>'Invalid file format.Please upload zip file',        
    ]

);



