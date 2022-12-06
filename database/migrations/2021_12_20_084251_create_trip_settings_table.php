<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_settings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("commision")->default(0)->nullable();
            $table->bigInteger("time")->default(0)->nullable();
            $table->bigInteger("radius")->default(0)->nullable();
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
        Schema::dropIfExists('trip_settings');
    }
}
