<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Destinations',
    'no_destination_exists' => 'No Destination exists with that id [:id]',

    'breadcrum' =>[     
        'list'    => 'Destinations List',
        'create'  => 'New Destination',
        'edit'    => 'Edit Destination',   
    ],
    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Destination?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'success' => [
        'create' => 'New Destination is created.',
        'update' => 'Destination is updated.',
        'delete' => 'Destination is deleted.',
        'statusupdate' => 'Destination status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Feedback. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Destination.',
        'update' => 'Error on updating Destination.', 
        'delete' => 'Error on deleting Destination.',
        'statusupdate' => 'Error on updating Status.',       
    ],

    'fields' => [
        'parent'        => 'Root Destination',
        'select'        =>'--Select--',
        'name'          => 'Destination Name',
        'parent'        => 'Parent Destination',
        'status'        => 'Status',
        'description'   => 'Description',
        'image'         => 'Image',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'activity'      => 'Activity',
        'short_desc'    => 'Short Description', 
        'new'           => 'New Destination',         
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Destination Name. Eg. Kathmandu',
         'description'  => 'Describe the City'
    ],

    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',
        'country' >'Country is required'
    ]

);



