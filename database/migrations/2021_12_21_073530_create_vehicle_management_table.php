<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_management', function (Blueprint $table) {
            $table->id();
            $table->foreignId("country_id")->constrained("countries");
            $table->string("vehicle_type")->nullable();
            $table->char("description")->nullable();
            $table->double("fare")->nullable();
            $table->double("price_km")->nullable();
            $table->string("image")->nullable();
            $table->string("vehicle_level")->nullable();
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
        Schema::dropIfExists('vehicle_management');
    }
}
