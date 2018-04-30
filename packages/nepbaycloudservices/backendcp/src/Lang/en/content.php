<?php
/**
* Language file for content
*
*/

return array(

    'title' =>'Content',    

    'breadcrum' =>[     
        'create'    => 'Article : New',
        'articles'  => 'Articles',
        'edit'      => 'Article : Edit'
    ],

    'success' => [
        'create' => 'Article created.',        
        'delete' => 'Article deleted.',
        'update'   => 'Article updated.',
        'status_publish' =>  '{0} :article  article published. |[2,Inf] :article artilces published.' ,         
        'status_unpuslish' => '{0} :article article unpublished. |[2,Inf] :article artilces unpublished.',
        'featured'   => '{0} :article article featured. |[2,Inf] :article artilces featured.',
        'unfeatured'   => '{0} :article article unfeatured. |[2,Inf] :article artilces unfeatured.',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete? Confirming will permanently delete the selected items(s)!',                
        'deleted'   => '{0} :article article deleted. |[2,Inf] :article artilces deleted.', 
    ],


    'error' => [
        'create'    => 'Error on creating  article',
        'update'    => 'Error on updating  article.',        
        'delete'    => 'Error on deleting article(s)',
    ],

    'action' =>[

        'alert'=>'Plase first make a selection from the list'
    ],

    'fields' => [        
        'title'          => 'Title',
        'title_placeholder' =>'Article Title',
        'introtext'     =>'Short Description',
        'introtext_placeholder'  => 'Write article short description here',
        'fulltext'      => 'Description',
        'fulltext_placeholder'  => 'Write article description here',        
        'status'        => 'Status',
        'featured'      => 'Featured',
        'image'         => 'Image',                
        'publish'       => 'Publish',
        'unpublish'     => 'Unpublish',
        'save'          =>  'Save',
        'change'        => 'Change',
        'remove'        => 'Remove',
        'select_img'    => 'Select Image',
        'yes'           => 'Yes',
        'no'            => 'No',
        'category'      => 'Category',
        'created_at'    => 'Crated Date',
        'actions'       => 'Actions',
        'delete'        => 'Delete',  
        'new'           => 'New Article',           
    ],

    'list' => [        
        'name'          => 'Name',
        'position'      => 'Position',       
        'status'        => 'Status',
        'created'       => 'Created On', 
        'actions'       => "Actoins"
    ],

    'validation' =>[
        'title' =>'Title is required.',        
        'fulltext'  => 'Description is required.'
    ],

    'modal' => [
        'title'         => 'Confirm Delete',
        'body'          => 'Are you sure you want to delete this Article?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

    'no_content_exists' =>'No Article Exist.',

);



