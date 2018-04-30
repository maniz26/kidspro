<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',['as' => 'home','uses' =>'\Nepbaycloudservices\PackageBridge\Controllers\PackageBridgeController@index']);

Route::group(['prefix'=>'backend','middleware'=>'admin'],function(){

    Route::get('/', ['as' => 'admin.root',
        'uses' => '\Nepbaycloudservices\Backendcp\Controllers\BackendController@index']);

    Route::get('content/list',					['as' =>'admin.content.list', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@list'] );
    Route::get('content/new',					['as' =>'admin.content.new', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@create'] );
    Route::get('content/edit/{id}',				['as' =>'admin.content.edit', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@edit'] );
    Route::post('content/save',					['as' =>'admin.content.save', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@save'] );
    Route::post('content/update',				['as' =>'admin.content.update', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@update'] );
    Route::get('content/data',					['as' =>'admin.content.data', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@getdata'] );
    Route::get('content/delete/{id}',			['as' =>'admin.content.delete', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@destroy'] );
    Route::get('content/confirm-delete/{id}',	['as' =>'admin.content.delete.confirm', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@getModalDelete'] );
    Route::get('content/status/{id}',			['as' =>'admin.content.status', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@status'] );
    Route::get('content/featured/{id}',			['as' =>'admin.content.featured', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@featured'] );
    Route::post('content/batch/delete',			['as' =>'admin.content.batch.delete', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@batchDelete'] );
    Route::post('content/batch/publish',		['as' =>'admin.content.batch.publish', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@batchPublish'] );
    Route::post('content/batch/unpublish',		['as' =>'admin.content.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@batchUnpublish'] );



    Route::get('content/category/list',					['as' =>'admin.content.category.list', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@categoryList'] );
    Route::get('content/category/new',					['as' =>'admin.content.category.new', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@createCategory'] );
    Route::get('content/category/edit/{id}',			['as' =>'admin.content.category.edit', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@editCategory'] );
    Route::post('content/category/save',				['as' =>'admin.content.category.save', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@saveCategory'] );
    Route::post('content/category/update',				['as' =>'admin.content.category.update', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@updateCategory'] );
    Route::get('content/category/data',					['as' =>'admin.content.category.data', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@getdataCategory'] );
    Route::get('content/category/delete/{id}',			['as' =>'admin.content.category.delete', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@destroyCategory'] );
    Route::get('content/category/confirm-delete/{id}',	['as' =>'admin.content.category.delete.confirm', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@getModalDeleteCategory'] );
    Route::get('content/category/status/{id}',			['as' =>'admin.content.category.status', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@statusCategory'] );
    Route::get('content/category/featured/{id}',		['as' =>'admin.content.category.featured', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@featuredCategory'] );
    Route::post('content/category/batch/delete',		['as' =>'admin.content.category.batch.delete', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@batchDeleteCategory'] );
    Route::post('content/category/batch/publish',		['as' =>'admin.content.category.batch.publish', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@batchPublishCategory'] );
    Route::post('content/category/batch/unpublish',		['as' =>'admin.content.category.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\ContentModule@batchUnpublishCategory'] );

    Route::get('menu/list', 				['as' =>'admin.menu.list',				'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@list'] );
    Route::get('menu/new',					['as' =>'admin.menu.new',				'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@create'] );
    Route::get('menu/edit/{id}',			['as' =>'admin.menu.edit',				'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@edit'] );
    Route::post('menu/save',				['as' =>'admin.menu.save',				'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@save'] );
    Route::post('menu/update',				['as' =>'admin.menu.update',			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@update'] );
    Route::get('menu/data',					['as' =>'admin.menu.data',				'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getdata'] );
    Route::get('menu/confirm-delete/{id}',	['as' =>'admin.menu.delete.confirm', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getModalDelete'] );
    Route::get('menu/delete/{id}',			['as' =>'admin.menu.delete',			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@delete'] );
    Route::get('menu/status/{id}',			['as' =>'admin.menu.status',			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@status'] );
    Route::post('menu/batch/delete',		['as' =>'admin.menu.batch.delete', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@batchDelete'] );
    Route::post('menu/batch/publish',		['as' =>'admin.menu.batch.publish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@batchPublish'] );
    Route::post('menu/batch/unpublish',		['as' =>'admin.menu.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@batchUnpublish'] );


    Route::get('menu/item/list',			['as' =>'admin.menu.item.list', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@menuItemList'] );
    Route::get('menu/item/data',			['as' =>'admin.menu.item.data', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getMenuItemData'] );
    Route::get('menu/item/new',				['as' =>'admin.menu.item.new', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@createMenuItem'] );
    Route::post('menu/item/save',			['as' =>'admin.menu.item.save', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@saveMenuItem'] );
    Route::get('menu/item/edit/{id}',		['as' =>'admin.menu.item.edit', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@editMenuItem'] );
    Route::post('menu/item/update',			['as' =>'admin.menu.item.update', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@updateMenuItem'] );
    Route::get('menu/item/confirm-delete/{id}',	['as' =>'admin.menu.item.delete.confirm', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getModalDeleteMenuItem'] );
    Route::get('menu/item/delete/{id}',		['as' =>'admin.menu.item.delete', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@deleteMenuItem'] );
    Route::get('menu/item/status/{id}',		['as' =>'admin.menu.item.status', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@statusSubMenu'] );
    Route::get('menu/item/type',			['as' =>'admin.menu.item.type', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getItemTypes'] );
    Route::post('menu/item/batch/delete',	['as' =>'admin.menu.item.batch.delete', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@batchDeleteMenuItem'] );
    Route::post('menu/item/batch/publish',	['as' =>'admin.menu.item.batch.publish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@batchPublishMenuItem'] );
    Route::post('menu/item/batch/unpublish',['as' =>'admin.menu.item.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@batchUnpublishMenuItem'] );
    Route::get('menu/item/menuitems/{id}',	['as' =>'admin.menu.item.items', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getMenuItemItems']);
    Route::get('menu/item/component/{id}/{type}',	['as' =>'admin.menu.item.modules', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@getModuleItems']);
    Route::post('menu/item/order/save',			['as' =>'admin.menu.item.order.save', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\MenuModule@saveMenuOrder'] );


    Route::get('settings',			['as' =>'admin.setting.settings', 'uses' => '\Nepbaycloudservices\Backendcp\Modules\SettingModule@settings'] );
    Route::Post('settings/update',	['as' =>'admin.setting.update',   'uses' => '\Nepbaycloudservices\Backendcp\Modules\SettingModule@update'] );

    Route::get('domflight/tickets', 		['as' => 'admin.domflight.tickets', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendTickets']);
    Route::get('domflight/ticket/data', 	['as' => 'admin.domflight.tickets.data', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendGetTicketData']);
    Route::get('domflight/tickets/print/{id}', 		['as' => 'admin.doflight.ticket.print', 'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendPrintTicket']);
    Route::get('domflight/tickets/send/{id}', 		['as' => 'admin.doflight.ticket.send',  'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendSendTicket']);

    Route::get('domflight/bookings', 		['as' => 'admin.domflight.bookings', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendBookings']);
    Route::get('domflight/bookings/data', 	['as' => 'admin.domflight.bookings.data', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendGetBookingsData']);
    Route::get('domflight/user/message/{id}', 	['as' => 'admin.domflight.messagebox', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendSendMessgeForm']);
    Route::post('domflight/user/message/send', 	['as' => 'admin.domflight.messagebox.send', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@backendSendMessge']);






    Route::get('activity/list',					['as' =>'admin.activity.list', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@list'] );
    Route::get('activity/new',					['as' =>'admin.activity.new', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@create'] );
    Route::get('activity/edit/{id}',				['as' =>'admin.activity.edit', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@edit'] );
    Route::post('activity/save',					['as' =>'admin.activity.save', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@save'] );
    Route::post('activity/update',				['as' =>'admin.activity.update', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@update'] );
    Route::get('activity/data',					['as' =>'admin.activity.data', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@getdata'] );
    Route::get('activity/delete/{id}',			['as' =>'admin.activity.delete', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@destroy'] );
    Route::get('activity/confirm-delete/{id}',	['as' =>'admin.activity.delete.confirm', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@getModalDelete'] );
    Route::get('activity/status/{id}',			['as' =>'admin.activity.status', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@status'] );
    Route::get('activity/featured/{id}',			['as' =>'admin.activity.featured', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@featured'] );
    Route::post('activity/batch/delete',			['as' =>'admin.activity.batch.delete', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@batchDelete'] );
    Route::post('activity/batch/publish',		['as' =>'admin.activity.batch.publish', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@batchPublish'] );
    Route::post('activity/batch/unpublish',		['as' =>'admin.activity.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\ActivityModule@batchUnpublish'] );



    Route::get('destination/list',					['as' =>'admin.destination.list', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@list'] );
    Route::get('destination/new',					['as' =>'admin.destination.new', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@create'] );
    Route::get('destination/edit/{id}',				['as' =>'admin.destination.edit', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@edit'] );
    Route::post('destination/save',					['as' =>'admin.destination.save', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@save'] );
    Route::post('destination/update',				['as' =>'admin.destination.update', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@update'] );
    Route::get('destination/data',					['as' =>'admin.destination.data', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@getdata'] );
    Route::get('destination/delete/{id}',			['as' =>'admin.destination.delete', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@destroy'] );
    Route::get('destination/confirm-delete/{id}',	['as' =>'admin.destination.delete.confirm', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@getModalDelete'] );
    Route::get('destination/status/{id}',			['as' =>'admin.destination.status', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@status'] );
    Route::get('destination/featured/{id}',			['as' =>'admin.destination.featured', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@featured'] );
    Route::post('destination/batch/delete',			['as' =>'admin.destination.batch.delete', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@batchDelete'] );
    Route::post('destination/batch/publish',		['as' =>'admin.destination.batch.publish', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@batchPublish'] );
    Route::post('destination/batch/unpublish',		['as' =>'admin.destination.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\DestinationModule@batchUnpublish'] );




    Route::get('place/list',					['as' =>'admin.place.list', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@list'] );
    Route::get('place/new',					['as' =>'admin.place.new', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@create'] );
    Route::get('place/edit/{id}',				['as' =>'admin.place.edit', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@edit'] );
    Route::post('place/save',					['as' =>'admin.place.save', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@save'] );
    Route::post('place/update',				['as' =>'admin.place.update', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@update'] );
    Route::get('place/data',					['as' =>'admin.place.data', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@getdata'] );
    Route::get('place/delete/{id}',			['as' =>'admin.place.delete', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@destroy'] );
    Route::get('place/confirm-delete/{id}',	['as' =>'admin.place.delete.confirm', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@getModalDelete'] );
    Route::get('place/status/{id}',			['as' =>'admin.place.status', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@status'] );
    Route::get('place/featured/{id}',			['as' =>'admin.place.featured', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@featured'] );
    Route::post('place/batch/delete',			['as' =>'admin.place.batch.delete', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@batchDelete'] );
    Route::post('place/batch/publish',		['as' =>'admin.place.batch.publish', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@batchPublish'] );
    Route::post('place/batch/unpublish',		['as' =>'admin.place.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\PlaceModule@batchUnpublish'] );


    Route::get('package/list',['as'=>'admin.package.list','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@list']);
    Route::get('package/new',['as'=>'admin.package.new','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@create']);
    Route::get('package/edit/{id}',['as'=>'admin.package.edit','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@edit']);
    Route::post('package/save',['as'=>'admin.package.save','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@save']);
    Route::post('package/update',['as'=>'admin.package.update','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@update']);
    Route::get('package/data',['as'=>'admin.package.data','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@getdata']);
    Route::get('package/delete/{id}',['as'=>'admin.package.delete','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@destroy']);
    Route::get('package/confirm-delete/{id}',['as'=>'admin.package.delete.confirm','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@getModalDelete']);
    Route::get('package/status/{id}',['as'=>'admin.package.status','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@status']);
    Route::get('package/featured/{id}',['as'=>'admin.package.featured','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@featured']);
    Route::post('package/batch/delete',['as'=>'admin.package.batch.delete','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@batchDelete']);
    Route::post('package/batch/publish',['as'=>'admin.package.batch.publish','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@batchPublish']);
    Route::post('package/batch/unpublish',['as'=>'admin.package.batch.unpublish','uses'=>'\Nepbaycloudservices\Plugins\Modules\PackageModule@batchUnpublish']);
    Route::get('package/addimage','\Nepbaycloudservices\Plugins\Modules\PackageModule@addimage')->name('admin.package.addimage');
    Route::get('package/loadImages','\Nepbaycloudservices\Plugins\Modules\PackageModule@loadImages')->name('admin.package.loadImages');

    Route::get('customfield/list','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@list')->name('admin.customfield.list');
    Route::get('customfield/new','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@create')->name('admin.customfield.new');
    Route::get('customfield/edit/{id}','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@edit')->name('admin.customfield.edit');
    Route::post('customfield/save','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@save')->name('admin.customfield.save');
    Route::post('customfield/update','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@update')->name('admin.customfield.update');
    Route::get('customfield/data','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@getdata')->name('admin.customfield.data');
    Route::get('customfield/delete/{id}','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@delete')->name('admin.customfield.delete');
    Route::get('customfield/status/{id}','\Nepbaycloudservices\Plugins\Modules\CustomfieldModule@status')->name('admin.customfield.status');

    Route::get('gallery/image/list','\Nepbaycloudservices\Plugins\Modules\GalleryModule@imageList')->name('admin.gallery.image.list');
    Route::get('gallery/image/new','\Nepbaycloudservices\Plugins\Modules\GalleryModule@createImage')->name('admin.gallery.image.new');
    Route::get('gallery/image/data','\Nepbaycloudservices\Plugins\Modules\GalleryModule@getImageData')->name('admin.gallery.image.data');
    Route::post('gallery/image/upload','\Nepbaycloudservices\Plugins\Modules\GalleryModule@uploadImage')->name('admin.gallery.image.upload');
    Route::get('gallery/image/edit/{id}','\Nepbaycloudservices\Plugins\Modules\GalleryModule@editImage')->name('admin.gallery.image.edit');
    Route::get('gallery/image/modal/edit/{id}','\Nepbaycloudservices\Plugins\Modules\GalleryModule@getEditModal')->name('admin.gallery.image.modal.edit');
    Route::post('gallery/image/update','\Nepbaycloudservices\Plugins\Modules\GalleryModule@updateImage')->name('admin.gallery.image.update');


    Route::get('gallery/image/confirm/delete/{id}','\Nepbaycloudservices\Plugins\Modules\GalleryModule@getDeleteModal')->name('admin.gallery.image.delete.confirm');
    Route::get('gallery/image/delete/{id}','\Nepbaycloudservices\Plugins\Modules\GalleryModule@deleteImage')->name('admin.gallery.image.delete');
    Route::post('gallery/image/delselected','\Nepbaycloudservices\Plugins\Modules\GalleryModule@delSelected')->name('admin.gallery.image.delselected');
    Route::get('gallery/image/delall/{id}','\Nepbaycloudservices\Plugins\Modules\GalleryModule@delAll')->name('admin.gallery.image.delall');

    Route::get('review/list','\Nepbaycloudservices\Plugins\Modules\ReviewModule@list')->name('review.list');
    Route::get('review/data','\Nepbaycloudservices\Plugins\Modules\ReviewModule@getdata')->name('review.data');
    Route::get('review/delete/{id}','\Nepbaycloudservices\Plugins\Modules\ReviewModule@destroy')->name('review.delete');
    Route::get('review/confirm-delete/{id}', '\Nepbaycloudservices\Plugins\Modules\ReviewModule@getModalDelete')->name('review.confirm-delete');
    Route::get('review/status/{id}','\Nepbaycloudservices\Plugins\Modules\ReviewModule@status')->name('review.status');





    Route::get('offer/list',					['as' =>'admin.offer.list', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@list'] );
    Route::get('offer/new',					['as' =>'admin.offer.new', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@create'] );
    Route::get('offer/edit/{id}',				['as' =>'admin.offer.edit', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@edit'] );
    Route::post('offer/save',					['as' =>'admin.offer.save', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@save'] );
    Route::post('offer/update',				['as' =>'admin.offer.update', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@update'] );
    Route::get('offer/data',					['as' =>'admin.offer.data', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@getdata'] );
    Route::get('offer/delete/{id}',			['as' =>'admin.offer.delete', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@destroy'] );
    Route::get('offer/confirm-delete/{id}',	['as' =>'admin.offer.delete.confirm', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@getModalDelete'] );
    Route::get('offer/status/{id}',			['as' =>'admin.offer.status', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@status'] );
    Route::get('offer/featured/{id}',			['as' =>'admin.offer.featured', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@featured'] );
    Route::post('offer/batch/delete',			['as' =>'admin.offer.batch.delete', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@batchDelete'] );
    Route::post('offer/batch/publish',		['as' =>'admin.offer.batch.publish', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@batchPublish'] );
    Route::post('offer/batch/unpublish',		['as' =>'admin.offer.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\OfferModule@batchUnpublish'] );


    Route::get('news/create',					['as' =>'admin.news.create', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\NewsModule@create'] );
    Route::post('news/save',					['as' =>'admin.news.save', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\NewsModule@save'] );


    Route::get('module/list',					['as' =>'admin.module.list', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@list'] );
    Route::post('module/install',				['as' =>'admin.module.install', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@save'] );
    Route::get('module/edit/{id}',					['as' =>'admin.module.edit', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@edit'] );
    Route::post('module/update',				['as' =>'admin.module.update', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@update'] );
    Route::get('module/data',					['as' =>'admin.module.data', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@getdata'] );
    Route::get('module/uninstall/{id}',			['as' =>'admin.module.uninstall', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@destroy'] );
    Route::get('module/confirm-uninstall/{id}',	['as' =>'admin.module.uninstall.confirm', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@getModalUninstall'] );
    Route::get('module/status/{id}',			['as' =>'admin.module.status', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@status'] );
    Route::get('module/featured/{id}',			['as' =>'admin.module.featured', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@featured'] );
    Route::post('module/batch/uninstall',		['as' =>'admin.module.batch.uninstall', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@batchUninstall'] );
    Route::post('module/batch/publish',			['as' =>'admin.module.batch.publish', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@batchPublish'] );
    Route::post('module/batch/unpublish',		['as' =>'admin.module.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\ModuleModule@batchUnpublish'] );




    Route::get('flightschedule/list',					['as' =>'admin.flightschedule.list', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleList'] );
    Route::get('flightschedule/new',					['as' =>'admin.flightschedule.new', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleCreate'] );
    Route::get('flightschedule/edit/{id}',				['as' =>'admin.flightschedule.edit', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleEdit'] );
    Route::post('flightschedule/save',					['as' =>'admin.flightschedule.save', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleSave'] );
    Route::post('flightschedule/update',				['as' =>'admin.flightschedule.update', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleUpdate'] );
    Route::get('flightschedule/data',					['as' =>'admin.flightschedule.data', 				'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleGetdata'] );
    Route::get('flightschedule/delete/{id}',			['as' =>'admin.flightschedule.delete', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleDestroy'] );
    Route::get('flightschedule/confirm-delete/{id}',	['as' =>'admin.flightschedule.delete.confirm', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleGetModalDelete'] );
    Route::get('flightschedule/status/{id}',			['as' =>'admin.flightschedule.status', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleStatus'] );
    Route::post('flightschedule/batch/delete',			['as' =>'admin.flightschedule.batch.delete', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleBatchDelete'] );
    Route::post('flightschedule/batch/publish',		['as' =>'admin.flightschedule.batch.publish', 		'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleBatchPublish'] );
    Route::post('flightschedule/batch/unpublish',		['as' =>'admin.flightschedule.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleBatchUnpublish'] );
    Route::post('flightschedule/order/save',			['as' =>'admin.flightschedule.order.save', 			'uses' => '\Nepbaycloudservices\Plugins\Modules\DomflightModule@flightScheduleMenuOrder'] );


    Route::get('user/list',					['as' =>'admin.user.list', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@list'] );
    Route::get('user/new',					['as' =>'admin.user.new', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@create'] );
    Route::get('user/edit/{id}',				['as' =>'admin.user.edit', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@edit'] );
    Route::post('user/save',					['as' =>'admin.user.save', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@save'] );
    Route::post('user/update',				['as' =>'admin.user.update', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@update'] );
    Route::get('user/data',					['as' =>'admin.user.data', 				'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@getdata'] );
    Route::get('user/delete/{id}',			['as' =>'admin.user.delete', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@destroy'] );
    Route::get('user/confirm-delete/{id}',	['as' =>'admin.user.delete.confirm', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@getModalDelete'] );
    Route::get('user/status/{id}',			['as' =>'admin.user.status', 			'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@status'] );
    Route::post('user/batch/delete',			['as' =>'admin.user.batch.delete', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@batchDelete'] );
    Route::post('user/batch/publish',		['as' =>'admin.user.batch.publish', 		'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@batchPublish'] );
    Route::post('user/batch/unpublish',		['as' =>'admin.user.batch.unpublish', 	'uses' => '\Nepbaycloudservices\Backendcp\Modules\UserModule@batchUnpublish'] );


    Route::get('template/list',['as'=>'admin.template.list','uses'=>'\Nepbaycloudservices\Backendcp\Modules\TemplateModule@list']);
    Route::get('template/{title}',['as'=>'admin.template','uses'=>'\Nepbaycloudservices\Backendcp\Modules\TemplateModule@layout']);
    Route::get('template/publish/{id}/{title}',['as'=>'admin.template.use','uses'=>'\Nepbaycloudservices\Backendcp\Modules\TemplateModule@publish']);
    Route::get('template/preview/{title}/{id}',['as'=>'admin.template.preview','uses'=>'\Nepbaycloudservices\Backendcp\Modules\TemplateModule@preview']);



});
Route::group(['prefix'=>'backend'],function(){

    Route::get('login', 			[ 'as' =>'admin.login', 			'uses' => '\Nepbaycloudservices\Backendcp\Controllers\Auth\LoginController@showLoginForm'] );
    Route::post('login', 			[ 'as' =>'admin.login.process', 	'uses' => '\Nepbaycloudservices\Backendcp\Controllers\Auth\LoginController@login'] );
    Route::any('logout',      		[ 'as' =>'admin.logout',			'uses' => '\Nepbaycloudservices\Backendcp\Controllers\Auth\LoginController@logout'] );
    Route::get('password-reset',	[ 'as' =>'admin.reset.password',  	'uses' => '\Nepbaycloudservices\Backendcp\Controllers\Auth\ForgotPasswordController@showLinkRequestForm'] );

});

Route::get('/course',['as'=>'courses','uses'=>'\Nepbaycloudservices\Plugins\Modules\CourseModule@index']);
Route::get('/blog',['as'=>'courses','uses'=>'\Nepbaycloudservices\Plugins\Modules\BlogModule@index']);
Route::get('/teacher',['as'=>'teacher','uses'=>'\Nepbaycloudservices\Plugins\Modules\TeacherModule@index']);
Route::get('/about_us',['as'=>'about','uses'=>'\Nepbaycloudservices\Plugins\Modules\AboutModule@index']);
Route::get('/contact_us',['as'=>'about','uses'=>'\Nepbaycloudservices\Plugins\Modules\ContactModule@index']);