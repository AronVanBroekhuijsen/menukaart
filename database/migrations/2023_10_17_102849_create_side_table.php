<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sides', function (Blueprint $table) {
            $table->id();
            $table->integer('toggle')->default(0);
            $table->timestamps();
        });

        Schema::create('side_nl', function (Blueprint $table) {
            $table->id();
            $table->integer('side_id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::create('side_en', function (Blueprint $table) {
            $table->id();
            $table->integer('side_id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::create('side_de', function (Blueprint $table) {
            $table->id();
            $table->integer('side_id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::create('side_info', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('sub_title');
            $table->text('title_en');
            $table->text('sub_title_en');
            $table->text('title_de');
            $table->text('sub_title_de');
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
        Schema::dropIfExists('sides');
        Schema::dropIfExists('side_nl');
        Schema::dropIfExists('side_en');
        Schema::dropIfExists('side_de');
        Schema::dropIfExists('side_info');
    }
}
