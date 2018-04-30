<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Offers',
    'no_offer_exists' => 'No Offer exists with that id [:id]',

    'breadcrum' =>[     
        'list'    => 'Offer List',
        'create'  => 'New Offer',
        'edit'    => 'Edit Offer',   
    ],
    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Offer?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'success' => [
        'create' => 'New Offer is created.',
        'update' => 'Offer is updated.',
        'delete' => 'Offer is deleted.',
        'statusupdate' => 'Offer status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Feedback. Please try again.',
    ],


    'error' => [
        'create' => 'Error on creating Offer.',
        'update' => 'Error on updating Offer.', 
        'delete' => 'Error on deleting Offer.',
        'statusupdate' => 'Error on updating Status.',       
    ],

    'fields' => [
        'from'          => 'From',
        'title'         => 'Title',        
        'to'            => 'To',
        'status'        => 'Status',
        'trip'           => 'Trip',
        'image'         => 'Image',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'ordering'      => 'Ordering',
        'description'    => 'Description', 
        'new'           => 'New Offer',
        'price'         => 'Price',
        'rate'          => 'Offer Rate',   
        'offerdate'     => 'Offer Date',
        'itinerary'     => 'Itinerary',        
        'currency'        =>  'Currency',    
       
    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Offer Name. Eg. Kathmandu',
         'description'  => 'Describe the City'
    ],

    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',
        'country' >'Country is required'
    ]

);



