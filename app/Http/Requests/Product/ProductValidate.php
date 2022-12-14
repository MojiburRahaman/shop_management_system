<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductValidate extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'unique:products,title'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'sku_no' => ['required',],
            'purchase_rate'=>['required'],
            'sale_rate'=>['required'],
        ];
    }
    public function messages()
    {
        return [
            'category_id.required'  => 'Please Select a Category',
            'required.required'  => 'SKU No Required',
        ] ;
    }
}
