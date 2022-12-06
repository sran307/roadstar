<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("driver_id")->constrained("drivers");
            $table->string("country")->nullable();
            $table->string("driver")->nullable();
            $table->string("vehicle_type")->nullable();
            $table->string("brand")->nullable();
            $table->string("color")->nullable();
            $table->string("vehicle_name")->nullable();
            $table->string("vehicle_number")->nullable();
            $table->string("vehicle_image")->nullable();
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
        Schema::dropIfExists('driver_vehicles');
    }
}
