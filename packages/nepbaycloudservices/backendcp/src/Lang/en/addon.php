<?php
/**
* Language file for category
*
*/

return array(

    'title' =>'Addons',

    'breadcrum' =>[     
        'list'    => 'Addons',
        'create'  => 'Install Addon',        
    ],

    'success' => [
        'create' => 'Addon installed  successfully.',        
        'delete' => 'Addon is deleted.',
        'statusupdate' => 'Addon status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this addon(s)?',                
        'deleted'   => 'There was an issue uninstalling the addons. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Addon.',
        'update' => 'Error on updating Addon.',        
    ],

    'fields' => [        
        'name'          => 'Name',
        'position'      => 'Position',       
        'status'        => 'Status',
        'description'   => 'Description',
        'upload'        => 'Upload Addon File',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'save'          =>  'Install Now'
       
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



