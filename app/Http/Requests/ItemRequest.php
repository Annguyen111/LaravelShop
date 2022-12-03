<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'size' => 'required',
            'color' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'size' => 'Please choose size and color!',
            'color' => 'Please choose size and color!'
        ];
    }
}
