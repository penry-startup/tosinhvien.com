<?php

namespace App\Http\Requests\Validations\Client;

use Illuminate\Foundation\Http\FormRequest;

class SignupRequest extends FormRequest
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
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|max:255|email|unique:students',
            'sex' => 'bail|required|integer|in:'. implode(',', config('constants.sex.key')) .'',
            'password' => 'bail|required|password_valid|confirmed'
        ];
    }
}
