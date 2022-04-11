<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_management', function (Blueprint $table) {
            // System Settings
            $table->increments('id');
            $table->string('brand_name')->nullable();
            $table->string('greeting')->nullable();
            $table->text('global_notification')->nullable();
            $table->text('top_slogan')->nullable();
            $table->text('sub_top_slogan')->nullable();
            $table->tinyInteger('maintenance_mode')->default(0);
            // Support Settings
            $table->string('support_phone')->nullable();
            $table->string('support_email')->nullable();
            $table->string('default_sender_email_address')->nullable();
            $table->string('default_email_sender_name')->nullable();
            // Social Settings
            $table->string('facebook_link')->nullable();
            $table->string('facebook_fanpage_link')->nullable();
            $table->string('zalo_phone')->nullable();
            $table->string('zalo_group_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('youtube_link')->nullable();
            // SEO Meta
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->string('meta_type')->nullable();
            $table->string('meta_locale')->nullable();
            $table->string('meta_author')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_management');
    }
}
