<?php

namespace App\Http\Requests\Validations\Admin;

use App\Http\Requests\BaseRequest;

class StudentRequest extends BaseRequest
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
        $data = request()->all();
        $id   = \Request::segment(count(\Request::segments()));

        $rules = [
            'name'      => 'bail|required|min:2|max:10',
            'sex'       => 'bail|required|in:'. implode(',', config('constants.sex.key')) .'',
            'email'     => 'bail|required|email|max:255|unique:students,email',
            'phone'     => 'bail|nullable|unique:students,phone',
            'is_active' => 'bail|required|in:'. implode(',', config('constants.is_active.key')) .'',
            'is_draft'  => 'bail|required|in:'. implode(',', config('constants.is_draft.key')) .'',
            'password'  => 'bail|required|password_valid'
        ];

        if (!empty($data['id']) && $id == $data['id']) {
            $rules['email']    = 'bail|required|email|max:255|unique:students,email,' . $data['id'];
            $rules['phone']    = 'bail|nullable|unique:students,phone,' . $data['id'];
            unset($rules['password']);
        }

        return $rules;
    }
}
