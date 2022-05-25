<?php

namespace App\Http\Requests\Validations\Admin;

use App\Http\Requests\BaseRequest;
use Illuminate\Http\Request;

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
        $id   = \Request::segment(count(\Request::segments()));

        $rules = [
            'name'    => 'bail|required|max:255',
            'code'    => 'bail|required|max:255',
            'city_id' => 'bail|required|integer',
            'type'    => 'bail|required|in:'. implode(',', config('constants.university_type.key')) .'',
            'phone'   => 'bail|nullable|phone_valid|unique:universities',
            'website' => 'nullable|url',
        ];

        if (!empty($data['id']) && $id == $data['id']) {
            $rules['phone'] = 'bail|nullable|phone_valid|unique:universities,phone,' . $data['id'];
        }

        return $rules;
    }
}
