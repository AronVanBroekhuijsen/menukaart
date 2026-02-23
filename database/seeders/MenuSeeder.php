<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Drankenkaart
        DB::table('menus')->insert(
            [
                'id' => 1,
                'title' => 'Drankenkaart',
                'sub_title' => 'Frisdranken – Bierkaart – Wijnkaart – Koffie & thee',
            ]);

        // DB::table('courses')->insert([
        //     [
        //         'id' => 1,
        //         'title' => 'Verse dranken',
        //         'menu_id' => 1,
        //     ],[
        //         'id' => 2,
        //         'title' => 'Bierkaart',
        //         'menu_id' => 1,
        //     ]
        // ]);

        // DB::table('sub_courses')->insert([
        //     [
        //         'id' => 1,
        //         'title' => '',
        //         'sub_title' => '',
        //         'course_id' => 1,
        //     ],[
        //         'id' => 2,
        //         'title' => 'Pils van de tap',
        //         'sub_title' => '',
        //         'course_id' => 2,
        //     ],[
        //         'id' => 3,
        //         'title' => 'Speciaalbier van de tap',
        //         'sub_title' => 'Veel eigen Vos-bieren uit eigen Bierbrouwerij',
        //         'course_id' => 2,
        //     ]
        // ]);

        // DB::table('dishes')->insert([
        //     [
        //         'id' => 1,
        //         'title' => 'VERS GEPERSTE JUS D’ORANGE',
        //         'info' => '',
        //         'price' => 4.15,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 1,
        //     ],[
        //         'id' => 2,
        //         'title' => 'APPEL - ANANAS PERZIK VAN ’S LANDS BEST. 100% NATUURLIJK',
        //         'info' => '',
        //         'price' => 4.15,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 1,
        //     ],[
        //         'id' => 3,
        //         'title' => 'HEINEKEN SMALL',
        //         'info' => '',
        //         'price' => 3.30,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 2,
        //     ],[
        //         'id' => 4,
        //         'title' => 'HEINEKEN Large',
        //         'info' => '',
        //         'price' => 6.30,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 2,
        //     ],[
        //         'id' => 5,
        //         'title' => 'MEESTERSTUK JOPEN 2017',
        //         'info' => '',
        //         'price' => 6.45,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 3,
        //     ],[
        //         'id' => 6,
        //         'title' => 'VOS DUBBEL ONZE NIEUWSTE AANWINST',
        //         'info' => '',
        //         'price' => 5.25,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 3,
        //     ]
        // ]);


        // Dinerkaart
        DB::table('menus')->insert([
            [
                'id' => 2,
                'title' => 'Dinerkaart',
                'sub_title' => 'Hele dag',
            ]
        ]);

        // DB::table('courses')->insert([
        //     [
        //         'id' => 3,
        //         'title' => 'Voorgerechten',
        //         'menu_id' => 2,
        //     ],[
        //         'id' => 4,
        //         'title' => 'Hoofdgerechten',
        //         'menu_id' => 2,
        //     ]]
        // );

        // DB::table('sub_courses')->insert([
        //     [
        //         'id' => 4,
        //         'title' => 'Onze soepen',
        //         'sub_title' => 'Allen huisgemaakt',
        //         'course_id' => 3,
        //     ],[
        //         'id' => 5,
        //         'title' => 'Koude voorgerechten',
        //         'sub_title' => '',
        //         'course_id' => 3,
        //     ],[
        //         'id' => 6,
        //         'title' => 'Warme voorgerechten',
        //         'sub_title' => '',
        //         'course_id' => 3,
        //     ],[
        //         'id' => 7,
        //         'title' => 'Van ’t rund',
        //         'sub_title' => '',
        //         'course_id' => 4,
        //     ],[
        //         'id' => 8,
        //         'title' => 'Van ’t varken',
        //         'sub_title' => '',
        //         'course_id' => 4,
        //     ],[
        //         'id' => 9,
        //         'title' => 'Van de kip',
        //         'sub_title' => '',
        //         'course_id' => 4,
        //     ]
        // ]);

        // DB::table('dishes')->insert([
        //     [
        //         'id' => 7,
        //         'title' => 'PORTIE STOKBROOD KLEIN',
        //         'info' => 'Met stokbrood van Bakkerij Schuld . Geserveerd met huisgemaakte kruidenboter. Voor ca. 2 tot 3 personen.',
        //         'price' => 4.95,
        //         'beer_id' => '',
        //         'wine_id' => '',
        //         'vegan' => 1,
        //         'sauce' => 0,
        //         'sub_course_id' => 4,
        //     ],[
        //         'id' => 8,
        //         'title' => 'LICHTGEBONDEN TOMATENSOEP',
        //         'info' => 'Rijk gevulde soep met groenten en balletjes.',
        //         'price' => 6,
        //         'beer_id' => 'Dubbel Vos',
        //         'wine_id' => 'Merlot',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 4,
        //     ],[
        //         'id' => 9,
        //         'title' => 'TRIO VAN 3 KOUDE VISSOORTEN',
        //         'info' => 'Met gerookte forel, gerookte zalm en botervis.',
        //         'price' => 12.20,
        //         'beer_id' => 'Weize Vos',
        //         'wine_id' => 'Merlot',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 5,
        //     ],[
        //         'id' => 10,
        //         'title' => 'RUNDERCARPACCIO VAN OSSENHAAS',
        //         'info' => 'Carpaccio gesneden van de beste ossenhaas, met Parmezaanse kaas, zongedroogde tomaten en truffelmayonaise.',
        //         'price' => 13.50,
        //         'beer_id' => 'Blonde Vos',
        //         'wine_id' => 'Merlot',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 5,
        //     ],[
        //         'id' => 11,
        //         'title' => 'GEBAKKEN SCAMPI’S',
        //         'info' => 'Heerlijke gamba’s gebakken in de huisgemaakte kruidenboter met knoflook.',
        //         'price' => 11.50,
        //         'beer_id' => 'Koperen Vos',
        //         'wine_id' => 'Malbec',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 6,
        //     ],[
        //         'id' => 12,
        //         'title' => 'GEGRATINEERDE CHAMPIGNONS',
        //         'info' => 'Gebakken champignons met spekjes of vegetarisch, gegratineerd met kaas.',
        //         'price' => 9.90,
        //         'beer_id' => 'Weize Vos',
        //         'wine_id' => 'Malbec',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 6,
        //     ],[
        //         'id' => 13,
        //         'title' => 'SIRLOIN STEAK (600 GR.)',
        //         'info' => 'Dit vlees wordt gesneden  uit de boven/zijlende van de dikke lende van een rund. De sirloin steak is een botermals stuk rundvlees met een klein randje vet als smaakmaker. Geserveerd met kruidenboter.',
        //         'price' => 37.50,
        //         'beer_id' => 'Stoute Vos',
        //         'wine_id' => 'Malbec',
        //         'vegan' => 0,
        //         'sauce' => 1,
        //         'sub_course_id' => 7,
        //     ],[
        //         'id' => 14,
        //         'title' => 'BEEF CAJUN',
        //         'info' => 'Biefstuk van de haas in een zoet zure cajun saus.',
        //         'price' => 31.25,
        //         'beer_id' => 'Weize Vos',
        //         'wine_id' => 'Malbec',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 7,
        //     ],[
        //         'id' => 15,
        //         'title' => 'WIENER SCHNITZEL',
        //         'info' => 'Dun gesneden gepaneerd varkensvlees gebakken in de boter.',
        //         'price' => 19.50,
        //         'beer_id' => 'Blond Vos',
        //         'wine_id' => 'Cabernet Sauvigon',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 8,
        //     ],[
        //         'id' => 16,
        //         'title' => 'VARKENSHAAS',
        //         'info' => 'Het meest malse stukje van het varken.',
        //         'price' => 23,
        //         'beer_id' => 'Weize Vos',
        //         'wine_id' => 'Cabernet Sauvigon',
        //         'vegan' => 0,
        //         'sauce' => 1,
        //         'sub_course_id' => 8,
        //     ],[
        //         'id' => 17,
        //         'title' => 'GEBAKKEN KIPFILET',
        //         'info' => 'Malse gebakken kipfilet.',
        //         'price' => 18.50,
        //         'beer_id' => 'Blond Vos',
        //         'wine_id' => 'Cabernet Sauvigon',
        //         'vegan' => 0,
        //         'sauce' => 1,
        //         'sub_course_id' => 9,
        //     ],[
        //         'id' => 18,
        //         'title' => 'KIP CAJUN SCHOTEL',
        //         'info' => 'Stukjes malse kipfilet in heerlijke zoetzure saus.',
        //         'price' => 19.25,
        //         'beer_id' => 'Weize Vos',
        //         'wine_id' => 'Cabernet Sauvigon',
        //         'vegan' => 0,
        //         'sauce' => 0,
        //         'sub_course_id' => 9,
        //     ]
        // ]);


        // // Sausen
        // DB::table('sauces')->insert([
        //     [
        //         'id' => 1,
        //         'title' => 'Bakje peper-roomsaus',
        //         'price' => 2.50,
        //     ],[
        //         'id' => 2,
        //         'title' => 'Schaaltje gebakken champignons',
        //         'price' => 2.75,
        //     ],[
        //         'id' => 3,
        //         'title' => 'Schaaltje gebakken boerenmix (geb. groenten, champignons, ui & spekjes)',
        //         'price' => 3.50,
        //     ]
        // ]);
    }
}
