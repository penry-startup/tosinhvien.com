<?php

namespace App\Http\Requests\Validations\Client;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarStudentRequest extends FormRequest
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
            'avatar' => 'bail|required'
        ];
    }
}
