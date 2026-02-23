<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGlutelactose extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->boolean('glute')->after('vegan');
            $table->boolean('lactose')->after('glute');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->dropColumn('glute');
            $table->dropColumn('lactose');
        });
    }
}
