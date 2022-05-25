<?php

namespace App\Http\Requests\Validations\Admin;

use App\Http\Requests\BaseRequest;

class MajorRequest extends BaseRequest
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

        return [
            'code'          => 'bail|required|max:255',
            'name'          => 'bail|required',
            'subject_group' => 'bail|required|max:255',
            'thpt_score'    => $data['thpt_score']  ? 'numeric' : '',
            'hocba_score'   => $data['hocba_score']  ? 'numeric' : '',
            'dgnl_score'    => $data['dgnl_score']  ? 'numeric' : '',
            'university_id' => 'bail|required|integer'
        ];
    }
}
