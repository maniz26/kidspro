<?php
/**
* Language file for category
*
*/

return array(

    'title' =>'Users',

    'breadcrum' =>[     
        'list'    => 'User List',
        'create'  => 'New User',
        'edit'    => 'Edit User',   
    ],

    'success' => [
        'create' => 'New User is created.',
        'update' => 'User is updated.',
        'delete' => 'User is deleted.',
        'statusupdate' => 'User status is updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete this record(s)?',                
        'deleted'   => '{0} :user user deleted. |[2,Inf] :user artilces deleted.',
    ],

    'action' =>[

        'alert'=>'Plase first make a selection from the list'
    ],


    'error' => [
        'create' => 'Error on creating User.',
        'update' => 'Error on updating User.',        
    ],

    'fields' => [        
        'name'          => 'Name',
        'email'        => 'Email',
        'phone_number'        => 'Contact Number',
        'address'   => 'Address',
        'avatar'         => 'Avatar',
        'group'         => 'Group',                
        'new'           => 'Create New user',
        'select_img'  => 'Select New Avatar',
        'save'         => 'Save',
        'country'   => 'Country',
        'city'      => 'City'
       
    ],

    'list' =>[
        'name' =>'Name',
        'email' => 'Email',
        'contact_number'    => 'Contact Number',
        'role' => 'Group',
    ],

    'placeholders' =>[
         'title'        => 'Enter User Name. Eg. Automobile',
         'description'  => 'Describe the category'
    ],
    'validation' =>[
        'title' =>'Name is required',
        'title_min' =>'Name must be at least 3 characters.'
    ],
     'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this User?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

);



