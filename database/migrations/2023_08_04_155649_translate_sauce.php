<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TranslateSauce extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sauce_nl', function (Blueprint $table) {
            $table->id();
            $table->integer('sauce_id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::create('sauce_en', function (Blueprint $table) {
            $table->id();
            $table->integer('sauce_id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::create('sauce_de', function (Blueprint $table) {
            $table->id();
            $table->integer('sauce_id');
            $table->text('title');
            $table->timestamps();
        });

        Schema::table('sauces', function (Blueprint $table) {
            $table->integer('toggle')->after('id')->default(0);
            $table->dropColumn('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sauce_nl');
        Schema::dropIfExists('sauce_de');
        Schema::dropIfExists('sauce_en');

        Schema::table('sauces', function (Blueprint $table) {
            $table->text('title')->after('id');
            $table->dropColumn('toggle');
        });
    }
}
