<?php

namespace App\Http\Controllers;

use Redirect;
use App\Models\Menu;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\Dish;
use App\Models\SideInfo;
use App\Models\Side;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $menus = Menu::where('toggle', '=', 0)->orderBy('order')->get();

        return view('main.home', ['menus' => $menus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu($menu, $id)
    {
        $menus = Menu::where('toggle', '=', 0)->get();
        $menu = Menu::where([['toggle', '=', 0],['id', '=', $id]])->first();
        $side_info = SideInfo::first();
        $sides = Side::where('toggle', '=', 0)->get();

        if ($side_info != null) {
            if (!isset($_GET['lang'])) {
                $side_info->title = $side_info->title;
                $side_info->sub_title = $side_info->sub_title;
            } else {
                switch ($_GET['lang']) {
                    case 'en':
                        $side_info->title = $side_info->title_en;
                        $side_info->sub_title = $side_info->sub_title_en;
                        break;
                    case 'de':
                        $side_info->title = $side_info->title_de;
                        $side_info->sub_title = $side_info->sub_title_de;
                        break;
                }
            }
        }

        $allergies = (object) [];
        if (!isset($_GET['lang'])) {
            $allergies->main = 'Allergenen informatie';
            $allergies->content = 'Alle gerechten kunnen sporen bevatten van diverse allergenen. Indien u een allergie hebt, moet u dit altijd duidelijk kenbaar maken bij ons personeel. Wij zullen uw gerecht dan met extra zorg (apart/gescheiden) bereiden.';
            $allergies->note = 'All onze gerechten met een <img src="'.asset('storage/images/vega.png').'" style="vertical-align: sub;" alt="Vega Icon"> zijn vegetarisch!';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    $allergies->main = 'Allergen information';
                    $allergies->content = 'All dishes may contain traces of various allergens. If you have an allergy, you must always make this clear to our staff. We will then prepare your dish with extra care (separately).';
                    $allergies->note = 'All our dishes with an <img src="'.asset('storage/images/vega.png').'" style="vertical-align: sub;" alt="Vega Icon"> are vegetarian!';
                    break;
                case 'de':
                    $allergies->main = 'Informationen zu Allergenen';
                    $allergies->content = 'Alle Gerichte können Spuren verschiedener Allergene enthalten. Wenn Sie eine Allergie haben, müssen Sie dies unbedingt unserem Personal mitteilen. Anschließend bereiten wir Ihr Gericht mit besonderer Sorgfalt (separat) zu.';
                    $allergies->note = 'Alle unsere Gerichte mit einem <img src="'.asset('storage/images/vega.png').'" style="vertical-align: sub;" alt="Vega Icon"> sind Vegetarier!';
                    break;
            }
        }

        if ($menu == null) {
            return redirect('/');
        }

        return view('main.menu', ['menu' => $menu, 'menus' => $menus, 'side_info' => $side_info, 'sides' => $sides, 'allergies' => $allergies]);
    }
}
