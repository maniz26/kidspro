<?php
/**
* Language file for Place
*
*/

return array(

    'title' =>'Places To See',
    'no_Place_exists' => 'No Place exists with that id [:id]',

    'breadcrum' =>[     
        'list'    => 'Activities',
        'place_list'    => 'Place List',
        'create'  => 'New Place',
        'edit'    => 'Edit Place',   
    ],
    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Place?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'success' => [
        'create' => 'New Place is created.',
        'update' => 'Place is updated.',
        'delete' => 'Place is deleted.',
        'statusupdate' => 'Place status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Place. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Place.',
        'update' => 'Error on updating Place.', 
        'statusupdate' => 'Error on Place status update',       
    ],

    'fields' => [
        'name'          => 'Name',
        'destination_id'    => 'Destination',
        'activity_id'    => 'Activity',
        'status'        => 'Status',
        'image'         => 'Image',
        'detail'         => 'Detail',
        'created'         => 'Created At',
        'actions'         => 'Actions',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'new'           => 'New Place'
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Place Name. Eg. Kathmandu Durbar Square',
    ],
    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',
    ]

);



