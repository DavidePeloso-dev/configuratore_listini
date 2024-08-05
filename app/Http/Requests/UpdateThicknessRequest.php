<?php

namespace App\Http\Requests;

use App\Models\Thickness;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateThicknessRequest extends FormRequest
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
        //dd($this->thickness);
        $thickness = Thickness::where('catalog_id', $this->input('catalog_id'))->where('value', $this->thickness)->first();
        return [
            'value' => ['required', Rule::unique('thicknesses')->where('catalog_id', $this->input('catalog_id'))->ignore($thickness->id)],
            'catalog_id' => 'required'
        ];
    }
}
