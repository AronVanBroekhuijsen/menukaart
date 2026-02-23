<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('order')->after('id');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->integer('order')->after('id');
        });

        Schema::table('sub_courses', function (Blueprint $table) {
            $table->integer('order')->after('id');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->integer('order')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->dropColumn('order');
        });

        Schema::table('sub_courses', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
}
