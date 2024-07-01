<?php

namespace App\Http\Requests\Category;

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
            'parent_id' => 'integer|exists:categories,parent_id',
            'title' => 'required|string|max:255|unique:categories,title,' . $this->category->id,
            'keywords' => 'string|max:255|nullable',
            'description' => 'string|max:255|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'status' => 'required|boolean'
        ];
    }
}
