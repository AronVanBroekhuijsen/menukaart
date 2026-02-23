<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dish_nl', function (Blueprint $table) {
            $table->id();
            $table->integer('dish_id');
            $table->text('title');
            $table->text('info')->nullable();
            $table->timestamps();
        });

        Schema::create('dish_de', function (Blueprint $table) {
            $table->id();
            $table->integer('dish_id');
            $table->text('title');
            $table->text('info')->nullable();
            $table->timestamps();
        });

        Schema::create('dish_en', function (Blueprint $table) {
            $table->id();
            $table->integer('dish_id');
            $table->text('title');
            $table->text('info')->nullable();
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
        Schema::dropIfExists('dish_nl');
        Schema::dropIfExists('dish_de');
        Schema::dropIfExists('dish_en');
    }
}
