<?php

namespace App\Http\Requests\Validations\Admin;

use App\Http\Requests\BaseRequest;

class SubjectRequest extends BaseRequest
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

        $rules['name'] = 'required|max:255|unique:subjects,name';

        if (!empty($data['id']) && $id == $data['id']) {
            $rules['name'] = 'required|max:255|unique:subjects,name,'.$id;
        }

        return $rules;
    }
}
