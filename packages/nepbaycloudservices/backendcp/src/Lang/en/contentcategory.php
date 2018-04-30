<?php
/**
* Language file for content
*
*/

return array(

    'title' =>'Content',    

    'breadcrum' =>[     
        'create'    => 'Category : New',
        'categories'  => 'Categories',
        'edit'      => 'Category : Edit'
    ],



    'success' => [
        'create' => 'Category created.',        
        'delete' => 'Category deleted.',
        'update'   => 'Category updated.',
        'status_publish' =>  '{0} :category  category published. |[2,Inf] :category categories published.' ,         
        'status_unpuslish' => '{0} :category category unpublished. |[2,Inf] :category categories unpublished.',
        'featured'   => '{0} :category category featured. |[2,Inf] :category categories featured.',
        'unfeatured'   => '{0} :category category unfeatured. |[2,Inf] :category categories unfeatured.',
    ],

    'delete' => [
        'alert'     => 'Are you sure you want to delete? Confirming will permanently delete the selected items(s)!',                
        'deleted'   => '{0} :category category deleted. |[2,Inf] :category categories deleted.', 
    ],


    'error' => [
        'create'    => 'Error on creating  category',
        'update'    => 'Error on updating  category.',        
        'delete'    => 'Error on deleting category.',
    ],

    'action' =>[

        'alert'=>'Plase first make a selection from the list'
    ],

    'fields' => [        
        'title'                     => 'Title',
        'title_placeholder'         =>'Category Title',        
        'fulltext'                  => 'Description',
        'fulltext_placeholder'      => 'Write category description here',        
        'status'                    => 'Status',
        'featured'                  => 'Featured',
        'image'                     => 'Image',                
        'publish'                   => 'Publish',
        'unpublish'                 => 'Unpublish',
        'save'                      =>  'Save',
        'change'                    => 'Change',
        'remove'                    => 'Remove',
        'select_img'                => 'Select Image',
        'yes'                       => 'Yes',
        'no'                        => 'No',
        'category'                  => 'Category',
        'created_at'                => 'Crated Date',
        'actions'                   => 'Actions',
        'delete'                    => 'Delete',   
        'parent'                    => 'Parent',
        'noparent'                  => '-No Parent-',
        'new'                       => 'New Category',
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
        'body'          => 'Are you sure you want to delete this Category?',
        'cancel'        => 'Cancel',
        'confirm'       => 'Yes',
    ],

);



