<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
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
            'code' => [
                'required',
                Rule::unique('articles')->where('catalog_id', $this->input('catalog_id'))
            ],
            'catalog_id' => 'required',
            'category_id' => 'required',
            'height' => 'nullable',
            'width' => 'nullable',
            'depth' => 'nullable',
        ];
    }
}
