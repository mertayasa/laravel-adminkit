<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => ['required', 'max:255']
        ];

        if($this->method() == 'PATCH'){
            $rules += ['image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']];
        }else{
            $rules += ['image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']];
        }

        return $rules;
    }
}
