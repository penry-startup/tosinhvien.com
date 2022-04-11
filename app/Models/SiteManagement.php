<?php

namespace App\Models;

use App\Traits\Imageable;

class SiteManagement extends BaseModel
{
    use Imageable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'site_management';

    /**
     * The attribute that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_name',
        'greeting',
        'global_notification',
        'top_slogan',
        'sub_top_slogan',
        'maintenance_mode',
        'support_phone',
        'support_email',
        'default_sender_email_address',
        'default_email_sender_name',
        'facebook_link',
        'facebook_fanpage_link',
        'zalo_phone',
        'zalo_group_link',
        'instagram_link',
        'youtube_link',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_type',
        'meta_locale',
        'meta_author'
    ];
}
