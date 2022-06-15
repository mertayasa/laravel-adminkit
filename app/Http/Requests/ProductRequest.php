<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'price' => ['required', 'numeric', 'gt:0'],
            'discount_price' => ['nullable', 'numeric', 'gt:0'],
            'quantity' => ['required', 'numeric', 'gt:0'],
            'category_id' => ['required', 'numeric', 'exists:product_categories,id'],
        ];

        if($this->method() == 'PATCH'){
            $rules += ['image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']];
        }else{
            $rules += ['image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']];
        }

        return $rules;
    }
}
