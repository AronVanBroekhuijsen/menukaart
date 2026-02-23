<?php

namespace App\Http\Controllers;

use Request;
use App\Models\Menu;
use App\Models\Course;
use App\Models\SubCourse;
use App\Models\Dish;

class OrderController extends Controller
{
    public function order_view($type, $id)
    {
        if ($type ==  'menu') {
            $items = Menu::where('toggle', '=', 0)->orderBy('order')->get();

            $next_type = 'course';
        } elseif ($type == 'course') {
            $items = Course::where([
                ['toggle', '=', 0],
                ['menu_id', '=', $id]
            ])->orderBy('order')->get();

            $next_type = 'sub_course';
        } elseif ($type == 'sub_course') {
            $items = SubCourse::where([
                ['toggle', '=', 0],
                ['course_id', '=', $id]
            ])->orderBy('order')->get();

            $next_type = 'dish';
        } elseif ($type == 'dish') {
            $items = Dish::where([
                ['toggle', '=', 0],
                ['sub_course_id', '=', $id]
            ])->orderBy('order')->get();

            $next_type = 'none';
        } elseif ($type == 'sub_product') {
            $items = Dish::where([
                ['toggle', '=', 0],
                ['id', '=', $id]
            ])->orderBy('order')->first();

            $next_type = 'none';
        }

        return view('editor.order_view', ['items' => $items, 'type' => $type, 'next_type' => $next_type]);
    }

    public function change_order(Request $request) {

        if ($request::input('type') == 'menu') {
            foreach ($request::input('item') as $id => $value) {
                $menu = Menu::find($id);
                $menu->order = $value;
                $menu->save();
            }
        } elseif ($request::input('type') == 'course') {
            foreach ($request::input('item') as $id => $value) {
                $course = Course::find($id);
                $course->order = $value;
                $course->save();
            }
        } elseif ($request::input('type') == 'sub_course') {
            foreach ($request::input('item') as $id => $value) {
                $sub_course = SubCourse::find($id);
                $sub_course->order = $value;
                $sub_course->save();
            }
        } elseif ($request::input('type') == 'dish') {
            foreach ($request::input('item') as $id => $value) {
                $dish = Dish::find($id);
                $dish->order = $value;
                $dish->save();
            }
        } elseif ($request::input('type') == 'sub_product') {
            foreach ($request::input('item') as $id => $value) {
                $dish = Dish::find($id);
                $dish->order = $value;
                $dish->save();
            }
        }

        return redirect()->back();
    }
}
