<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id');
            $table->text('image');
            $table->timestamps();
        });

        Schema::create('course_nl', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->timestamps();
        });

        Schema::create('course_en', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->timestamps();
        });

        Schema::create('course_de', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
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
        Schema::dropIfExists('courses');
        Schema::dropIfExists('course_nl');
        Schema::dropIfExists('course_en');
        Schema::dropIfExists('course_de');
    }
}
