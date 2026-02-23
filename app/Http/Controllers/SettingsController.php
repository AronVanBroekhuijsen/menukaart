<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Models\Menu;
use App\Models\Setting;

class SettingsController extends Controller
{
    /**
     * Toggle everything on/off (menu, courses, subcourses, dishes)
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function settings()
    {
        $settings = collect();
        $settings->drinkmenu = Setting::find(1)->value ?? '';
        $settings->wine = Setting::find(2)->value ?? '';
        $settings->beer = Setting::find(3)->value ?? '';
        $settings->maincourses = Setting::find(4)->value ?? '';
        $settings->cocktailmenu = Setting::find(5)->value ?? '';
        $menus = Menu::get();

        return view('editor.settings', ['settings' => $settings, 'menus' => $menus]);
    }


    /**
     * Toggle everything on/off (menu, courses, subcourses, dishes)
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function save_settings(Request $request)
    {
        $setting = Setting::find(1);
        $setting->value = $request::input('drinkmenu');
        $setting->save();

        $setting = Setting::find(2);
        $setting->value = $request::input('wine_category');
        $setting->save();

        $setting = Setting::find(3);
        $setting->value = $request::input('beer_category');
        $setting->save();

        $setting = Setting::find(4);
        $setting->value = $request::input('maincourses');
        $setting->save();

        $setting = Setting::find(5);
        $setting->value = $request::input('cocktailmenu');
        $setting->save();

        return Redirect::back();
    }
}
