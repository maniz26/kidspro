<?php

namespace Nepbaycloudservices\Backendcp\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
       
        return ['title' =>'required',
                'menu_id'   => 'required',
                'parent_id' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => __('backendcp::menu.validation.title') ,
            'menu_id.required' => __('backendcp::menu.validation.menu_id'),
            'parent_id.required' => __('backendcp::menu.validation.parent_id') ,
            
        ];

    }

}