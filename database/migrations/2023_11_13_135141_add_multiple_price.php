<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMultiplePrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dishes', function (Blueprint $table) {
            $table->decimal('price_large', $precision = 8, $scale = 2)->after('price');
        });

        Schema::table('course_nl', function (Blueprint $table) {
            $table->text('text_small')->after('sub_title')->nullable();
            $table->text('text_large')->after('text_small')->nullable();
        });
        Schema::table('course_en', function (Blueprint $table) {
            $table->text('text_small')->after('sub_title')->nullable();
            $table->text('text_large')->after('text_small')->nullable();
        });
        Schema::table('course_de', function (Blueprint $table) {
            $table->text('text_small')->after('sub_title')->nullable();
            $table->text('text_large')->after('text_small')->nullable();
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
            $table->dropColumn('price_large');
        });

        Schema::table('course_nl', function (Blueprint $table) {
            $table->dropColumn('text_small');
            $table->dropColumn('text_large');
        });
        Schema::table('course_en', function (Blueprint $table) {
            $table->dropColumn('text_small');
            $table->dropColumn('text_large');
        });
        Schema::table('course_de', function (Blueprint $table) {
            $table->dropColumn('text_small');
            $table->dropColumn('text_large');
        });
    }
}
