<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'delivery_charge' => 'required',
            'payment_method' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please fill out your name.',
            'country.required' => 'Please fill out your country.',
            'city.required' => 'Please fill out your city.',
            'address.required' => 'Please fill out your address.',
            'postcode.required' => 'Please fill out your postcode.',
            'phone.required' => 'Please fill out your phone number.',
            'email.required' => 'Please fill out your phone number.',
            'delivery_charge.required' => 'Please select your shipping address.',
            'payment_method.required' => 'Please select your payment method.',

        ];
    }
}
