<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Packages',
    'no_package_exists' => 'No Package exists with that id [:id]',

    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this package?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'breadcrum' =>[     
        'list'    => 'Package List',
        'create'  => 'New Package',
        'edit'    => 'Edit Package',   
    ],

    'success' => [
        'create' => 'New Package is created.',
        'update' => 'Package is updated.',
        'delete' => 'Package is deleted.',
        'statusupdate' => 'Package status is updated',
        'customize_create' => 'Your enquiry has been sent. Our support team will contact you shortly.',
    ],

    'error' => [
        'create' => 'Error on creating Package.',
        'update' => 'Error on updating Package.',
        'delete' => 'Error on deleting Package.',
        'statusupdate' => 'Error on package status update',
        'alias_already' => 'This alias is already taken.',
        'customize_cant_create' => 'There is some error sending enquiry.',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => 'There was an issue deleting the Feedback. Please try again.',
    ],

    'fields' => [
        'parent'        => 'Root Package',
        'select'        =>'--Select--',
        'name'          => 'Package Name',
        'alias'          => 'Alias',
        'parent'        => 'Parent Package',
        'status'        => 'Status',
        'description'   => 'Description',
        'image'         => 'Image',
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'activity'      => 'Activity',
        'short_desc'    => 'Short Description',  
        'destination'   => 'Destination' ,
        'title'         => 'Package Title',
        'overview'      => 'Overview', 
        'video'         => 'Video',
        'trip_map'      => 'Trip Map',
        'technical_experience'  => 'Technical Experience',
        'region'        => 'Region',
        'trip_start_from'   => 'Trip Start From',
        'trip_end_at'       =>'Trip End At',
        'fitness_ability'   => 'Fitness Ability',
        'max_altitude'  => 'Max Altitude',
        'difficulty'    => 'Difficulty',
        'easy'  => 'Easy',
        'basic' => 'Basic',
        'challenging'   => 'Challenging',
        'moderate'  => 'Moderate',
        'strenuous' => 'Strenuous',
        'guide' => 'Guide',
        'accomodation'  => 'Accomodation',
        'extra_info'    =>'Extra Info',
        'cost_includes' => 'Cost Includes',
        'cost_excludes' => 'Cost Excludes',
        'highlights'    => 'Highlights',
        'duration'  => 'Duration',
        'add_dates'    =>'Add Dates',
        'date_ranges'   => 'Date Ranges',
        'iday'  => 'Day',
        'iplace'  => 'Place',
        'ialtitude'  => 'Altitude',
        'ititle'    => 'Title',
        'idetail'   => 'Detail',
        'currency'  => 'Currency',
        'currencyNPR'   => 'NPR',
        'currencyUSD'   => 'USD',
        'group_size'=> 'Group Size',
        'min_group_size'    => 'Minimum Group Size',
        'group_price' => 'Group Cost',
        'individual_price'  => 'Individual Cost',
        'discount'  => 'Discount %',
        'add_images'    => 'Add Images',
        'refresh_images'    => 'Refresh Images',

        'package_info'=> 'Package Info',
        'package_details'   => 'Package Details',
        'package_date'  => 'Available Date',
        'package_itinerary' => 'Package Itinerary',
        'package_size_price'=> 'Group Size & Price',
        'package_gallery'   => 'Package Gallery',
        'package_custom'   => 'Custom Fields',
        'featured'  => 'Featured',
        'new'   => 'New Package'

       
    ],

    'list' =>[
        'tripcode' =>'Trip Code',
        'Package'   => "Package",
        'title' => 'Package Title',
        'groupcost' => 'Group Cost'

    ],

   
    
    'placeholders' =>[
         'title'        => 'Enter Package Name. Eg. Kathmandu',
         'description'  => 'Describe the City'
    ],

    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.',
        'country' >'Country is required'
    ]

);



