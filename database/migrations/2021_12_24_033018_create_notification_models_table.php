<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId("country")->constrained("countries")->nullable();
            $table->foreignId("type")->constrained("user_types")->nullable();
            $table->string("title")->nullable();
            $table->char("message")->nullable();
            $table->string("image")->nullable();
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
        Schema::dropIfExists('notification_models');
    }
}
