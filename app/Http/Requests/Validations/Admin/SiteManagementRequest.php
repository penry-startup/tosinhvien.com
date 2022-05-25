<?php

namespace App\Http\Requests\Validations\Admin;

use App\Http\Requests\BaseRequest;

class SiteManagementRequest extends BaseRequest
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

        $rules['brand_name']                   = 'bail|required|max:255';
        $rules['greeting']                     = 'bail|required|max:255';
        $rules['top_slogan']                   = 'bail|required';
        $rules['sub_top_slogan']               = 'bail|required';
        $rules['maintenance_mode']             = 'bail|required';
        $rules['support_phone']                = 'bail|required|phone_valid';
        $rules['support_email']                = 'bail|required|email';
        $rules['default_sender_email_address'] = 'bail|required|email';
        $rules['default_email_sender_name']    = 'bail|required|max:255';

        if (!empty($data['facebook_link'])) {
            $data['facebook_link'] = 'bail|url';
        }

        if (!empty($data['facebook_fanpage_link'])) {
            $data['facebook_fanpage_link'] = 'bail|url';
        }

        if (!empty($data['zalo_phone'])) {
            $data['zalo_phone'] = 'bail|phone_valid';
        }

        if (!empty($data['zalo_group_link'])) {
            $data['zalo_group_link'] = 'bail|url';
        }

        if (!empty($data['instagram_link'])) {
            $data['instagram_link'] = 'bail|url';
        }

        if (!empty($data['youtube_link'])) {
            $data['youtube_link'] = 'bail|url';
        }

        $rules['meta_title']       = 'bail|required';
        $rules['meta_description'] = 'bail|required';
        $rules['meta_keywords']    = 'bail|required';
        $rules['meta_type']        = 'bail|required';
        $rules['meta_locale']      = 'bail|required';
        $rules['meta_author']      = 'bail|required';

        return $rules;
    }
}
