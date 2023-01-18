<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
        return [
            'color_name' => 'required|unique:colors',
            'color_code' => 'required|unique:colors',
        ];
    }
    public function messages()
    {
        return [
            'color_name.required' => 'Color nam koi?',
            'color_code.required' => 'Color code koi?',
            'color_name.unique' => 'category nam akbar ace',
            'color_code.unique' => 'category code akbar ace',
        ];
    }
}
