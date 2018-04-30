<?php
/**
* Language file for flightschedule
*
*/

return array(

    'title' =>'Flight Schedule',
    'no_content_exists' => 'No ticket exists with that id [:id]',
    'content_not_found'     => 'Ticket [:id] does not exist.',

    'breadcrum' =>[ 
        'create'        => 'Flightscheudle :: New',
        'edit'          => 'Flightscheudle :: Edit',                        
        'list'            => 'Flight schedule List',        
    ],

    'list' => [
        'sn'                    => 'S/N',
        'from'                  => 'From',
        'to'                    => 'To',
        'flight_no'             => 'Flight No',
        'operation_days'        => 'Days of Operation',
        'etd'                => 'ETD',        
        'eta'           => 'ETA',
        'npr_fare'  => 'NPR Fare',
        'npr_fcs'   => 'NPR FSC',
        'inr_fare'  => 'INR Fare',
        'inr_fcs'   => 'INR FCS',
        'usd_fare'  => 'USD Fare',
        'usd_fcs'   => 'USD FCS',
        'aircraft'  => 'Air Craft', 
    ],

    'fields' =>[
        'new'   => 'New flight schedule'
    ],

     'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Schedule?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'success' => [
        'create' => 'Flightscheudle created.',        
        'delete' => 'Flightscheudle deleted.',
        'update'   => 'Flightscheudle updated.',
        'status_publish' =>  '{0} :Flightscheudle  Flightscheudle published. |[2,Inf] :Flightscheudle Flightscheudle published.' ,         
        'status_unpuslish' => '{0} :Flightscheudle Flightscheudle unpublished. |[2,Inf] :Flightscheudle Flightscheudle unpublished.',
        'featured'   => '{0} :Flightscheudle Flightscheudle featured. |[2,Inf] :Flightscheudle Flightscheudle featured.',
        'unfeatured'   => '{0} :Flightscheudle Flightscheudle unfeatured. |[2,Inf] :Flightscheudle Flightscheudle unfeatured.',
        'statusupdate'  =>'Stauts updated',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete? Confirming will permanently delete the selected items(s)!',                
        'deleted'   => '{0} :article Flightscheudle deleted. |[2,Inf] :Flightscheudle artilces deleted.', 
    ],


    'error' => [
        'create'    => 'Error on creating  Flightscheudle',
        'update'    => 'Error on updating  Flightscheudle.',        
        'delete'    => 'Error on deleting Flightscheudle(s)',
    ],

    'action' =>[

        'alert'=>'Plase first make a selection from the list'
    ],
);

