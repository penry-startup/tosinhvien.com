<?php

namespace App\Http\Requests\Validations\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordStudentRequest extends FormRequest
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
        $studentId = \StudentFacades::studentInfo('id');

        return [
            'password_old' => 'bail|required|password_old:students,' . $studentId,
            'password'     => 'bail|required|password_valid'
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
            'password_old' => trans('validation.custom.attributes.password_old'),
            'password'     => trans('validation.custom.attributes.password'),
        ];
    }
}
