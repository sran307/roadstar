<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFareModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fare_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId("vehicle_type")->constrained("vehicle_management")->nullable();
            $table->double("waiting_charge")->nullable();
            $table->double("extra_hour_charge")->nullable();
            $table->double("fare_per_km")->nullable();
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
        Schema::dropIfExists('fare_models');
    }
}
