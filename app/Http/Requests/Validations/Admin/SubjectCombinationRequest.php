<?php

namespace App\Http\Requests\Validations\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubjectCombinationRequest extends FormRequest
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
            'name'     => 'bail|required|max:255',
            'group_id' => 'bail|required|integer|min:1'
        ];
    }
}
