<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Models\Sauce;
use App\Models\SauceNl;
use App\Models\SauceEn;
use App\Models\SauceDe;

class SauceController extends Controller
{
    /**
     * View/Edit the Menu dishes.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function sauce_view(Request $request)
    {
        $sauces_view = Sauce::all();

        return view('editor.sauce-view', ['sauces_view' => $sauces_view]);
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_sauce(Request $request)
    {
        $sauce = new Sauce();
        $sauce->price = str_replace(',', '.', $request::input('price'));
        $sauce->save();

        $translation = new SauceNl();
        $translation->sauce_id = $sauce->id;
        $translation->title = $request::input('title');
        $translation->save();

        $translation_en = new SauceEn();
        $translation_en->sauce_id = $sauce->id;
        $translation_en->title = $request::input('title_en');
        $translation_en->save();

        $translation_de = new SauceDe();
        $translation_de->sauce_id = $sauce->id;
        $translation_de->title = $request::input('title_de');
        $translation_de->save();

        return Redirect::back();
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_sauce($id, Request $request)
    {
        $sauce = Sauce::find($id);
        $sauce->price = str_replace(',', '.', $request::input('price'));
        $sauce->save();

        $translation = SauceNl::where('sauce_id', '=', $id)->first();
        $translation->title = $request::input('title');
        $translation->save();

        $translation_en = SauceEn::where('sauce_id', '=', $id)->first();
        $translation_en->title = $request::input('title_en');
        $translation_en->save();

        $translation_de = SauceDe::where('sauce_id', '=', $id)->first();
        $translation_de->title = $request::input('title_de');
        $translation_de->save();

        return Redirect::back();
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy_sauce($id)
    {
        Sauce::destroy($id);
        SauceNl::where('sauce_id', '=', $id)->delete();
        SauceEn::where('sauce_id', '=', $id)->delete();
        SauceDe::where('sauce_id', '=', $id)->delete();

        return Redirect::back();
    }
}
