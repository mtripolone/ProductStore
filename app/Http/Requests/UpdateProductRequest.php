<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:products,name' ,
            'price' => 'required|numeric',
            'description' => 'required|string|max:500',
            'category' => 'required|string|max:255',
            'image_url' => 'nullable|url|max:255'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter a product name',
            'name.string' => 'Please enter a valid type',
            'name.unique' => 'This name is already in use',
            'name.max' => 'Please enter a valid type',
            'price.required' => 'Please enter a product price',
            'price.numeric' => 'Please enter a valid type',
            'price.max' => 'Please enter a valid type',
            'description.required' => 'Please enter a product description',
            'description.string' => 'Please enter a valid type',
            'description.max' => 'Please enter a valid type',
            'category.required' => 'Please enter a product category',
            'category.string' => 'Please enter a valid type',
            'category.max' => 'Please enter a valid type',
            'image_url.url' => 'Please enter a valid type',
            'image_url.max' => 'Please enter a valid type',
        ];
    }
}
