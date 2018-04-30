<?php

namespace Nepbaycloudservices\Backendcp\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentCategoryRequest extends FormRequest {

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

        return  [
            'title' => 'required',
            'description' => 'required'                  
        ];        
    }

    public function messages(){
        return [
            'title.required' =>  __('backendcp::contentcategory.validation.title') ,
            'description.required' => __('backendcp::contentcategory.validation.fulltext') ,            
        ];

    }

}