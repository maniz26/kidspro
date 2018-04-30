<?php
/**
* Language file for City
*
*/

return array(

    'title' =>'Review',
    'no_review_exists' => 'No Review exists with that id [:id]',

    'breadcrum' =>[     
        'list'    => 'Review List',
        'create'  => 'New Review',
        'edit'    => 'Edit Review',   
    ],
    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Review?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'success' => [
        'create' => 'New Review is created successfully.',
        'update' => 'Review is updated successfully.',
        'delete' => 'Review is deleted successfully.',
        'statusupdate' => 'Review has been approved',
        'review_create' => 'Review has been created successfully and is in queue for approval.',
    ],

    'error' => [
        'create' => 'Error on creating Review.',
        'update' => 'Error on updating Review.', 
        'delete' => 'Error on deleting Review.',
        'statusupdate' => 'Error on updating Status.',
        'cant_review' => 'You must login to review.',
        'review_cant_create' => 'Error creating review.',
        'already_reviewed' => 'You have already reviewed this package.',
        'review_not_approved' => 'You have already reviewed this package but your review is not approved by admin.',       
    ],

    'fields' => [
        'package'     => 'Package',
        'user'        => 'User',
        'rating'      => 'Rating',
        'review'      => 'Review',
        'status'      => 'Status',
        'created_at'  => 'Created At',
        'actions'     => 'Actions',
        'approved'    => 'approved',
        'unapproved'  => 'Unapproved',          
    ],
);



