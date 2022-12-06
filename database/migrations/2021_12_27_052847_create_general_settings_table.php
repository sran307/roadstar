<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string("site_name")->nullable();
            $table->string("meta_title")->nullable();
            $table->string("meta_keyword")->nullable();
            $table->string("meta_description")->nullable();
            $table->string("play_store_url")->nullable();
            $table->string("app_store_url")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("website_url")->nullable();
            $table->string("website_logo")->nullable();
            $table->string("facebook_url")->default("Not set")->nullable();
            $table->string("facebook_logo")->default("Not set")->nullable();
            $table->string("twitter_url")->default("Not set")->nullable();
            $table->string("twitter_logo")->default("Not set")->nullable();
            $table->string("linkedin_url")->default("Not set")->nullable();
            $table->string("linkedin_logo")->default("Not set")->nullable();
            $table->string("instagram_url")->default("Not set")->nullable();
            $table->string("instagram_logo")->default("Not set")->nullable();
            $table->string("youtube_url")->default("Not set")->nullable();
            $table->string("youtube_logo")->default("Not set")->nullable();
            $table->string("favicon")->nullable();
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
        Schema::dropIfExists('general_settings');
    }
}
