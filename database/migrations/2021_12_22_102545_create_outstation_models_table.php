<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutstationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outstation_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId("country")->constrained("countries")->nullable();
            $table->foreignId("vehicle_type")->constrained("vehicle_management")->nullable();
            $table->double("base_fare")->nullable();
            $table->double("base_fare_km")->nullable();
            $table->double("price_per_km")->nullable();
            $table->double("allowance")->nullable();
            $table->string("type")->nullable();
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
        Schema::dropIfExists('outstation_models');
    }
}
