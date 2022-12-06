<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFleetModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fleet_models', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->string("type")->nullable();
            $table->string("speed")->nullable();
            $table->integer("rating")->nullable();
            $table->string("amount_per_day")->nullable();
            $table->integer("passengers")->nullable();
            $table->string("button_name")->nullable();
            $table->string("button_url")->nullable();
            $table->string("number_of_bookings")->nullable();
            $table->string("status")->nullable();
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
        Schema::dropIfExists('fleet_models');
    }
}
