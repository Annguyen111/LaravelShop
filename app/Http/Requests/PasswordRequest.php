<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'new_password' => 'required',
            'confirm_password' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'new_password' => 'Please type password again!',
            'confirm_password' => 'Please type password again!'
        ];
    }
}
