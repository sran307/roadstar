<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("gender")->nullable();
            $table->bigInteger("phone_number")->nullable();
            $table->string("email")->nullable();
            $table->string("password")->nullable();
            $table->string("image")->nullable();
            $table->string("aadhar_image")->nullable();
            $table->string("aadhar")->nullable();
            $table->date("dob")->nullable();
            $table->string("license_number")->nullable();
            $table->string("id_image")->nullable();
            $table->char("address")->nullable();
            $table->string("country")->nullable();
            $table->string("currency")->nullable();
            $table->string("daily")->nullable();
            $table->string("rental")->nullable();
            $table->string("outstation")->nullable();
            $table->string("commission")->nullable();
            $table->string("comm_type")->nullable();
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
        Schema::dropIfExists('drivers');
    }
}
