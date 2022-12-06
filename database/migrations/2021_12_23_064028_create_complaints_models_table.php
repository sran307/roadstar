<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints_models', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("trip_id")->nullable();
            $table->foreignId("customer")->constrained("customers")->nullable();
            $table->foreignId("driver")->constrained("drivers")->nullable();
            $table->foreignId("category")->constrained("complaint_categories")->nullable();
            $table->foreignId("sub_category")->constrained("complaint_subs")->nullable();
            $table->char("description")->nullable();
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
        Schema::dropIfExists('complaints_models');
    }
}
