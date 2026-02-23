<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->timestamps();
        });

        Schema::create('menu_nl', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_en', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id');
            $table->text('title');
            $table->text('sub_title')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_de', function (Blueprint $table) {
            $table->id();
            $table->integer('menu_id');
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
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_nl');
        Schema::dropIfExists('menu_en');
        Schema::dropIfExists('menu_de');
    }
}
