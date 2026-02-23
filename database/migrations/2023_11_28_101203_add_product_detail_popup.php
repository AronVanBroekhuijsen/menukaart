<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductDetailPopup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dish_nl', function (Blueprint $table) {
            $table->text('big_description')->after('info')->nullable();
        });
        Schema::table('dish_en', function (Blueprint $table) {
            $table->text('big_description')->after('info')->nullable();
        });
        Schema::table('dish_de', function (Blueprint $table) {
            $table->text('big_description')->after('info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
