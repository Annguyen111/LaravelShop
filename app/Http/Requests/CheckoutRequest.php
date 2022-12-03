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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',

            'country' => 'required',
            'street_address' => 'required',
            'town_city' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:10'
        ];
    }

    public function  messages()
    {
        return [
            'first_name' => 'Please type again!',
            'last_name' => 'Please type again!',

            'country' => 'Please type again!',
            'street_address' => 'Please type again!',
            'town_city' => 'Please type again!',
            'email' => 'Please type again!',
            'phone' => 'Please type again!'
        ];
    }
}
