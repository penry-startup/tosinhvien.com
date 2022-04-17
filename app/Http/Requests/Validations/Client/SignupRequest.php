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
            'email' => 'bail|required|max:255|email|unique:students,email',
            'sex' => 'bail|required|in:'. implode(',', config('constants.sex.key')) .'',
            'password' => 'bail|required|password_valid|confirmed'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => trans('validation.custom.attributes.name'),
            'email' => trans('validation.custom.attributes.email'),
            'sex' => trans('validation.custom.attributes.sex'),
            'password' => trans('validation.custom.attributes.password')
        ];
    }
}
