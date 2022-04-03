<?php

namespace App\Http\Requests\Validations\Admin;

use App\Http\Requests\BaseRequest;

class UniversityRequest extends BaseRequest
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
        $id = \Request::segment(count(\Request::segments()));

        $rules = [
            'name'    => 'bail|required|max:255',
            'code'    => 'bail|required|max:255',
            'city_id' => 'bail|required|integer',
            'type'    => 'bail|in:'. implode(',', config('constants.university_type.key')) .'',
            'phone'   => 'bail|phone_valid|unique:universities',
            'website' => $data['website']  ? 'url' : '',
        ];

        if (!empty($id)) {
            $rules['phone'] = 'bail|phone_valid|unique:universities,phone,'.$id;
        }

        return $rules;
    }
}
