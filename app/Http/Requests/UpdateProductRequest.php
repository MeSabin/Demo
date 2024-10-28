<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'product_category' => 'required', 
            'image' => 'mimes:jpg, jpeg, png',
            'description' => 'required',
            'price' => 'required|numeric|min:100',
            'discount' => 'numeric|max:100',
            'stock' => 'required|integer'
        ];
    }
}
