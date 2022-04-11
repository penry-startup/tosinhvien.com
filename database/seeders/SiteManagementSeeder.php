<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SiteManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('site_management')->truncate();
        \DB::table('SET FOREIGN_KEY_CHECKS=1;');

        \DB::table('site_management')->insert([
            'id'                           => 1,
            'brand_name'                   => 'ToSinhVien',
            'greeting'                     => 'Hi',
            'global_notification'          => 'Global notification',
            'top_slogan'                   => 'Guiding you through life’s financial journey',
            'sub_top_slogan'               => 'Compare rates, crunch numbers and get expert guidance for life’s biggest financial moments.',
            'maintenance_mode'             => false,
            'support_phone'                => '0385763717',
            'support_email'                => 'tosinhvien.support@gmail.com',
            'default_sender_email_address' => 'tosinhvien.support@gmail.com',
            'default_email_sender_name'    => 'toSV',
            'facebook_link'                => 'https://facebook.com',
            'facebook_fanpage_link'        => 'https://facebook.com',
            'zalo_phone'                   => 'https://zalo.me/0385763717',
            'zalo_group_link'              => '',
            'instagram_link'               => 'https://instagram.com',
            'youtube_link'                 => 'https://youtube.com',
            'meta_title'                   => 'Meta title',
            'meta_description'             => 'Meta description',
            'meta_keywords'                => 'Meta keywords',
            'meta_type'                    => 'Meta type',
            'meta_locale'                  => 'Meta locale',
            'meta_author'                  => 'Meta author',
            'created_at'                   => Carbon::now(),
            'updated_at'                   => Carbon::now()
        ]);
    }
}
