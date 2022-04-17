<?php

namespace App\Http\Requests\Validations\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileStudentRequest extends FormRequest
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
        $data      = request()->all();
        $studentId = \StudentFacades::studentInfo('id');

        $rules             = [];
        $rules['name']     = 'bail|required|min:2|max:10';
        $rules['username'] = 'bail|required|username_valid|max:255|unique:students,username,' . $studentId;
        $rules['email']    = 'bail|required|email|unique:students,email,' . $studentId;

        if (!empty($data['phone'])) {
            $rules['phone'] = 'bail|required|phone_valid|unique:students,phone,' . $studentId;
        }

        $currYear = (int) date('Y');
        $dgitsBwY = (string) $currYear-100 . ',' . (string) $currYear;


        $rules['dob'] = 'bail|required|integer|between:1,31';
        if (! empty($data['mob'])) {
            $rules['dob'] = $rules['dob'] . '|dob_valid:' . $data['mob'];
        }
        $rules['mob'] = 'bail|required|integer|between:1,12';
        $rules['yob'] = 'bail|required|integer|between:' . $dgitsBwY;
        $rules['sex'] = 'bail|required|in:'. implode(',', config('constants.sex.key')) .'';

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name'     => strtolower(trans('validation.custom.attributes.name')),
            'username' => strtolower(trans('validation.custom.attributes.username')),
            'email'    => strtolower(trans('validation.custom.attributes.email')),
            'phone'    => strtolower(trans('validation.custom.attributes.phone')),
            'sex'      => strtolower(trans('validation.custom.attributes.sex')),
            'dob'      => strtolower(trans('validation.custom.attributes.dob')),
            'mob'      => strtolower(trans('validation.custom.attributes.mob')),
            'yob'      => strtolower(trans('validation.custom.attributes.yob')),
        ];
    }

    public function messages()
    {
        return [
            'dob.dob_valid' => trans('validation.phone_valid')
        ];
    }
}
