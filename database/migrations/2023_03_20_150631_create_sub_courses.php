<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id');
            $table->text('image');
            $table->timestamps();
        });

        Schema::create('sub_course_nl', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_course_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->timestamps();
        });

        Schema::create('sub_course_en', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_course_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->timestamps();
        });

        Schema::create('sub_course_de', function (Blueprint $table) {
            $table->id();
            $table->integer('sub_course_id');
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
        Schema::dropIfExists('sub_courses');
        Schema::dropIfExists('sub_course_nl');
        Schema::dropIfExists('sub_course_en');
        Schema::dropIfExists('sub_course_de');
    }
}
