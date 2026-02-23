<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToggle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->integer('toggle')->after('id')->default(0);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->integer('toggle')->after('id')->default(0);
        });

        Schema::table('sub_courses', function (Blueprint $table) {
            $table->integer('toggle')->after('id')->default(0);
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->integer('toggle')->after('id')->default(0);
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
            $table->dropColumn('toggle');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn('toggle');
        });

        Schema::table('sub_courses', function (Blueprint $table) {
            $table->dropColumn('toggle');
        });

        Schema::table('dishes', function (Blueprint $table) {
            $table->dropColumn('toggle');
        });
    }
}
