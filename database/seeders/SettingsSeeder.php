<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'setting' => 'Drankenkaart',
                'value' => 1,
            ],[
                'id' => 2,
                'setting' => 'Wijn',
                'value' => 1,
            ],[
                'id' => 3,
                'setting' => 'Bier',
                'value' => 1,
            ],[
                'id' => 4,
                'setting' => 'Hoofdgerechten',
                'value' => 4,
            ]
        ]);
    }
}
