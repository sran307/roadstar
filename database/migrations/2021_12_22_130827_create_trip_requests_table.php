<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer")->constrained("customers")->nullable();
            $table->string("distance")->nullable();
            $table->foreignId("vehicle_type")->constrained("vehicle_management")->nullable();
            $table->char("pickup_address")->nullable();
            $table->string("pickup_lat")->nullable();
            $table->string("pickup_lon")->nullable();
            $table->char("drop_address")->nullable();
            $table->string("drop_lat")->nullable();
            $table->string("drop_lon")->nullable();
            $table->string("payment_method")->nullable();
            $table->double("total")->nullable();
            $table->double("subtotal")->nullable();
            $table->double("discount")->nullable();
            $table->double("tax")->nullable();
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
        Schema::dropIfExists('trip_requests');
    }
}
