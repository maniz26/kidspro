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
            'name' => 'required|max:20',
           'email'    => 'required|email|unique:users,email,'.\Auth::guard('user')->user()->id,             
        ];        
    }

    public function messages(){

              

        return [
            'name.required' =>  __('backendcp::name.validation.title') ,

        ];

    }

}