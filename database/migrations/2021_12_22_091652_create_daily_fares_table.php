<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDailyFaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_fares', function (Blueprint $table) {
            $table->id();
            $table->foreignId("country")->constrained("countries")->nullable();
            $table->foreignId("vehicle_type")->constrained("vehicle_management")->nullable();
            $table->string("road_trip")->nullable();
            $table->double("base_fare")->nullable();
            $table->double("base_fare_km")->nullable();
            $table->double("price_per_km")->nullable();
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
        Schema::dropIfExists('daily_fares');
    }
}
