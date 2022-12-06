<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWidget3ModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('widget3_models', function (Blueprint $table) {
            $table->id();
            $table->string("heading")->nullable();
            $table->string("images")->nullable();
            $table->text("details")->nullable();
            $table->string("button_name")->nullable();
            $table->string("button_url")->nullable();
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
        Schema::dropIfExists('widget3_models');
    }
}
