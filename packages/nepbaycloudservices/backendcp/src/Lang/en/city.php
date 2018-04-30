<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Cities',

    'breadcrum' =>[     
        'list'    => 'Cities',
        'create'  => 'New City',
        'edit'    => 'Edit City',   
    ],

    'success' => [
        'create' => 'New City is created.',
        'update' => 'City is updated.',
        'delete' => 'City is deleted.',
        'statusupdate' => 'City status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Feedback. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating City.',
        'update' => 'Error on updating City.',        
    ],

    'fields' => [
        'country'       =>'Country',
        'select'        =>'--Select--',
        'name'          => 'Name',
        'parent'        => 'Parent City',
        'status'        => 'Status',
        'description'   => 'Description',
        'image'         => 'City Icon',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter City Name. Eg. Kathmandu',
         'description'  => 'Describe the City'
    ],
    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',
        'country' >'Country is required'
    ]

);



