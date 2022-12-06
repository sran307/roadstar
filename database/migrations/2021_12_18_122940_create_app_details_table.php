<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_details', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("logo")->nullable();
            $table->string("version")->nullable();
            $table->string("currency")->nullable();
            $table->string("login_image")->nullable();
            $table->char("about")->nullable();
            $table->double("amount")->nullable();
            $table->string("longitude")->nullable();
            $table->string("lattitude")->nullable();
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
        Schema::dropIfExists('app_details');
    }
}
