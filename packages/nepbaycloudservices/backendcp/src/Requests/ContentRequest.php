<?php

namespace Nepbaycloudservices\Backendcp\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest {

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
            'fulltext' => 'required'                  
        ];        
    }

    public function messages(){
        return [
            'title.required' =>  __('backendcp::content.validation.title') ,
            'fulltext.required' => __('backendcp::content.validation.fulltext') ,            
        ];

    }

}