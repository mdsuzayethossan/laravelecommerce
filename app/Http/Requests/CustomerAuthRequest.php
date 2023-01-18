<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class CustomerAuthRequest extends FormRequest
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
            // 'name' => 'required',
            // 'email' => 'required|email|unique:customer_logins,email',
            // 'password' => 'required',
            // 'password' => Password::min(8)
            //     ->letters()
            //     ->mixedCase()
            //     ->numbers()
            //     ->symbols()
            //     ->uncompromised(),
            // 'cpassword' => 'required|same:password'
        ];
    }
}
