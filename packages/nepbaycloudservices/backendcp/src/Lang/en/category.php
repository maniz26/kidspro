<?php
/**
* Language file for category
*
*/

return array(

    'title' =>'Categories',

    'breadcrum' =>[     
        'list'    => 'Categories',
        'create'  => 'New Category',
        'edit'    => 'Edit Category',   
    ],

    'success' => [
        'create' => 'New Category is created.',
        'update' => 'Category is updated.',
        'delete' => 'Category is deleted.',
        'statusupdate' => 'Category status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Feedback. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Category.',
        'update' => 'Error on updating Category.',        
    ],

    'fields' => [
        'root'          =>'--Root--',
        'name'          => 'Name',
        'parent'        => 'Parent Category',
        'status'        => 'Status',
        'description'   => 'Description',
        'image'         => 'Category Icon',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Category Name. Eg. Automobile',
         'description'  => 'Describe the category'
    ],
    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.'
    ]

);



