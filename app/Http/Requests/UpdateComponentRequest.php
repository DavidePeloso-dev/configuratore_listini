<?php

namespace App\Http\Requests;

use App\Models\Component;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateComponentRequest extends FormRequest
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
        //dd($this->input('name'));
        $component = Component::where('category_id', $this->input('category_id'))->where('name', $this->input('name'))->first();
        return [
            'name' => ['required', Rule::unique('components')->where('category_id', $this->input('category_id'))->ignore($component->id)],
            'category_id' => 'required'
        ];
    }
}
