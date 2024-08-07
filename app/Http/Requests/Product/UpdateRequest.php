<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255|unique:products,title,' . $this->product->id,
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer',
            'description' => 'string|max:255|nullable',
            'price' => 'integer|nullable',
            'quantity' => 'integer|nullable',
            'category_id' => 'integer|nullable|exists:categories,id',
            'detail' => 'string|max:255|nullable',
            'keywords' => 'string|max:255|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|boolean',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
