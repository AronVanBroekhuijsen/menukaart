<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use App\Models\Side;
use App\Models\SideNl;
use App\Models\SideEn;
use App\Models\SideDe;
use App\Models\SideInfo;

class SideController extends Controller
{
    /**
     * View/Edit the Menu dishes.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function side_view(Request $request)
    {
        $sides_view = Side::all();
        $side_info = SideInfo::first();
        if ($side_info == null) {
            $side_info = new SideInfo();
            $side_info->title = '';
            $side_info->sub_title = '';
            $side_info->title_en = '';
            $side_info->sub_title_en = '';
            $side_info->title_de = '';
            $side_info->sub_title_de = '';
            $side_info->save();
        }

        return view('editor.side-view', ['sides_view' => $sides_view, 'side_info' => $side_info]);
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_side(Request $request)
    {
        $side = new Side();
        $side->save();

        $translation = new SideNl();
        $translation->side_id = $side->id;
        $translation->title = $request::input('title');
        $translation->save();

        $translation_en = new SideEn();
        $translation_en->side_id = $side->id;
        $translation_en->title = $request::input('title_en');
        $translation_en->save();

        $translation_de = new SideDe();
        $translation_de->side_id = $side->id;
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
    public function change_side($id, Request $request)
    {
        $side = Side::find($id);
        $side->save();

        $translation = SideNl::where('side_id', '=', $id)->first();
        $translation->title = $request::input('title');
        $translation->save();

        $translation_en = SideEn::where('side_id', '=', $id)->first();
        $translation_en->title = $request::input('title_en');
        $translation_en->save();

        $translation_de = SideDe::where('side_id', '=', $id)->first();
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
    public function destroy_side($id)
    {
        Side::destroy($id);
        SideNl::where('side_id', '=', $id)->delete();
        SideEn::where('side_id', '=', $id)->delete();
        SideDe::where('side_id', '=', $id)->delete();

        return Redirect::back();
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function side_info($id, Request $request)
    {
        $side_info = SideInfo::find($id);
        $side_info->title = $request::input('title');
        $side_info->sub_title = $request::input('sub_title');
        $side_info->title_en = $request::input('title_en');
        $side_info->sub_title_en = $request::input('sub_title_en');
        $side_info->title_de = $request::input('title_de');
        $side_info->sub_title_de = $request::input('sub_title_de');
        $side_info->save();

        return Redirect::back();
    }
}
