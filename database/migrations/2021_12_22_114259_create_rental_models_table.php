<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId("country")->constrained("countries")->nullable();
            $table->foreignId("vehicle_type")->constrained("vehicle_management")->nullable();
            $table->foreignId("package_id")->constrained("package_models")->nullable();
            $table->double("price_per_km")->nullable();
            $table->double("price_per_hour")->nullable();
            $table->double("package_price")->nullable();
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
        Schema::dropIfExists('rental_models');
    }
}
