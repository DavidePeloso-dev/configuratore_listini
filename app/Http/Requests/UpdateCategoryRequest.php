<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Category;

class UpdateCategoryRequest extends FormRequest
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
        //dd($this->input());
        $category = Category::where('catalog_id', $this->input('catalog_id'))->where('name', $this->input('name'))->first();
        return [
            'name' => ['required', Rule::unique('categories')->where('catalog_id', $this->input('catalog_id'))->ignore($category->id)],
            'catalog_id' => 'required'
        ];
    }
}
