<?php
/**
* Language file for Activity
*
*/

return array(

    'title' =>'Activities',
    'no_activity_exists' => 'No Activity exists with that id [:id]',

    'breadcrum' =>[     
        'list'    => 'Activities',
        'activity_list'    => 'Activity List',
        'create'  => 'New Activity',
        'edit'    => 'Edit Activity',   
    ],
    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Activity?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'success' => [
        'create' => 'New Activity is created.',
        'update' => 'Activity is updated.',
        'delete' => 'Activity is deleted.',
        'statusupdate' => 'Activity status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Activity. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Activity.',
        'update' => 'Error on updating Activity.', 
        'statusupdate' => 'Error on activity status update',       
    ],

    'fields' => [
        'country'       =>'Country',
        'select'        =>'--Select--',
        'name'          => 'Name',
        'status'        => 'Status',
        'image'         => 'Image',
        'detail'         => 'Detail',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Activity Name. Eg. Trekking',
    ],
    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',
    ]

);



