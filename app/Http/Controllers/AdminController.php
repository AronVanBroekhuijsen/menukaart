<?php

namespace App\Http\Controllers;

use Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Menu;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\Dish;
use App\Models\Sauce;
use App\Models\Side;
use App\Models\Setting;
use Redirect;

class AdminController extends Controller
{
    /**
     * Toggle everything on/off (menu, courses, subcourses, dishes)
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function toggle($id, $type)
    {
        if ($type == 'menu') {
            $menu = Menu::where('id', '=', $id)->first();
        } elseif ($type == 'courses') {
            $menu = Course::where('id', '=', $id)->first();
        } elseif ($type == 'sub_courses') {
            $menu = SubCourse::where('id', '=', $id)->first();
        } elseif ($type == 'dish') {
            $menu = Dish::where('id', '=', $id)->first();
        } elseif ($type == 'sauce') {
            $menu = Sauce::where('id', '=', $id)->first();
        } elseif ($type == 'side') {
            $menu = Side::where('id', '=', $id)->first();
        }
        $menu->toggle = !$menu->toggle;
        $menu->save();

        return Redirect::back();
    }

}
