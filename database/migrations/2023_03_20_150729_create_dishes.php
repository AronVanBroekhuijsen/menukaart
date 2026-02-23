<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->text('beer_id');
            $table->text('wine_id');
            $table->boolean('vegan');
            $table->boolean('sauce');
            $table->foreignId('sub_course_id');
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
        Schema::dropIfExists('dishes');
    }
}
