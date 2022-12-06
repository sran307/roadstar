<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Widget2upgrade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('widget2_models', function (Blueprint $table) {
            $table->string("button_name")->nullable();
            $table->string("button_url")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('widget2_models', function (Blueprint $table) {
            $table->string("button_name")->nullable();
            $table->string("button_url")->nullable();
        });
    }
}
