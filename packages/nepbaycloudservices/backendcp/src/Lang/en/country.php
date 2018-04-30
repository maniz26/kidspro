<?php
/**
* Language file for Country
*
*/

return array(

    'title' =>'Countries',

    'breadcrum' =>[     
        'list'    => 'Countries',
        'create'  => 'New Country',
        'edit'    => 'Edit Country',   
    ],

    'success' => [
        'create' => 'New Country is created.',
        'update' => 'Country is updated.',
        'delete' => 'Country is deleted.',
        'statusupdate' => 'Country status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Feedback. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Country.',
        'update' => 'Error on updating Country.',        
    ],

    'fields' => [
        'root'          =>'--Root--',
        'name'          => 'Name',
        'parent'        => 'Parent Country',
        'status'        => 'Status',
        'description'   => 'Description',
        'image'         => 'Country Icon',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Country Name. Eg. Nepal',
         'description'  => 'Describe the Country'
    ],
    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.'
    ]

);



