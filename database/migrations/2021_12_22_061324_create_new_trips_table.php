<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_trips', function (Blueprint $table) {
            $table->id();
            $table->string("trip_id")->nullable();
            $table->foreignId("customer_id")->constrained("customers")->nullable();
            $table->foreignId("driver_id")->constrained("drivers")->nullable();
            $table->bigInteger("phone_number")->nullable();
            $table->date("pickup_date")->nullable();
            $table->time("pickup_time")->nullable();
            $table->char("pickup_address")->nullable();
            $table->char("drop_address")->nullable();
            $table->string("pickup_lat")->nullable();
            $table->string("pickup_lon")->nullable();
            $table->string("vehicle_number")->nullable();
            $table->string("payment_method")->nullable();
            $table->string("subtotal")->nullable();
            $table->string("discount")->nullable();
            $table->string("fare")->nullable();
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
        Schema::dropIfExists('new_trips');
    }
}
