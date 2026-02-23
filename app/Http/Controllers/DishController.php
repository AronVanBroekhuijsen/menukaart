<?php

namespace App\Http\Controllers;

use Request;
use Redirect;
use Carbon\Carbon;
use App\Models\Dish;
use App\Models\DishNl;
use App\Models\DishEn;
use App\Models\DishDe;
use App\Models\SubCourse;
use App\Models\Menu;
use App\Models\Setting;
use App\Traits\FunctionsTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    use FunctionsTrait;

    /**
     * View/Edit the Menu dishes.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function dish_view(Request $request)
    {
        $request = (object) $request::all();
        if (!isset($request->menu)) {
            $request->menu = '';
        }
        if (!isset($request->search_title)) {
            $request->search_title = '';
        }
        if (!isset($request->disabled)) {
            $request->disabled = '';
        }
        $menus = Menu::get();
        $items = collect();
        $page = $request->page ?? 1;

        $beers = SubCourse::where('course_id', '=', Setting::find(3)->value)->get();
        $wines = SubCourse::where('course_id', '=', Setting::find(2)->value)->get();

        $with_products = Dish::where([
            ['product_id', '!=', '0'],
            ['product_id', '!=', 'NULL']
        ])->get();

        foreach($menus as $menu) {
            foreach($menu->courses as $courses) {
                foreach($courses->sub_courses as $sub_courses) {
                    if($menu->title($menu->id) != $request->menu && $courses->title($courses->id) != $request->menu && $sub_courses->title($sub_courses->id) != $request->menu && $request->menu != null) {continue;}
                    foreach($sub_courses->dishes as $dishes) {

                        // foreach ($with_products as $with_product) {
                        //     foreach ($with_product->product_id as $product_id) {
                        //         if ($dishes->id == $product_id) {
                        //             $dishes->setAttribute('sub_product', $with_product);
                        //         }
                        //     }
                        // }
                        if (stripos($dishes->title($dishes->id)->nl, $request->search_title) !== false || $request->search_title == '') {
                            if ($request->disabled == 'on') {
                                if ($dishes->toggle == true) {
                                    $items->add($dishes);
                                }
                            } elseif ($request->disabled == '') {
                                $items->add($dishes);
                            }
                        }
                    }
                }
            }
        }

        foreach ($with_products as $with_product) {
            if(($menu->title($menu->id) != $request->menu && $request->menu != null) && $request->menu != '0') {continue;}
            $items->add($with_product);
        }

        $items = $this->pagination($items, 20, $page);

        return view('editor.dish-view', ['items' => $items, 'menus' => $menus, 'current' => $request->menu, 'search_title' => $request->search_title, 'disabled' => $request->disabled, 'beers' => $beers, 'wines' => $wines]);
    }

    public function change_dish_view($id)
    {
        $dishes = Dish::get();
        $item = Dish::find($id);

        $menus = Menu::get();
        $beers = SubCourse::where('course_id', '=', Setting::find(3)->value)->get();
        $wines = SubCourse::where('course_id', '=', Setting::find(2)->value)->get();

        $html = view('editor.dish_modal_change', ['dishes' => $dishes, 'item' => $item, 'menus' => $menus, 'beers' => $beers, 'wines' => $wines])->render();

        return $html;
    }


    public function change_select_view($selected)
    {
        if ($selected == 'true') {
            $dishes = Dish::get();

            $html = view('editor.dish_product_select', ['dishes' => $dishes])->render();
            return $html;
        }
        return '';
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_dish(Request $request)
    {
        $file = $request::file('img');
        if ($file != null) {
            $filename = md5($file->getClientOriginalName() . microtime());
            Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
        }

        if (str_replace(',', '.', $request::input('price')) == '') {
            $price = 0;
        } else {
            $price = $request::input('price');
        }
        if (str_replace(',', '.', $request::input('price_large')) == '') {
            $price_large = 0;
        } else {
            $price_large = $request::input('price_large');
        }

        $dish = new Dish();
        $dish->order = Dish::where('sub_course_id', '=', $request::input('category'))->count() + 1;
        $dish->image = $filename ?? '';
        $dish->price = $price;
        $dish->price_large = $price_large;
        $dish->beer_id = $request::input('beer_id') ?? '';
        $dish->wine_id = $request::input('wine_id') ?? '';
        $dish->vegan = $request::input('vegan');
        $dish->glute = $request::input('glute');
        $dish->lactose = $request::input('lactose');
        $dish->sauce = $request::input('sauce');
        $dish->vos_image = $request::input('vos_image');
        $dish->sub_course_id = $request::input('category');
        if ($request::has('join_product')) {
            $dish->product_id = collect($request::input('products'))->implode(',');
        } else {
            $dish->product_id = 0;
        }
        $dish->save();

        $translation = new DishNl();
        $translation->dish_id = $dish->id;
        $translation->title = Str::title(Str::lower($request::input('title')));
        $translation->info = $request::input('info');
        $translation->big_description = $request::input('big_description');
        $translation->save();

        $translation_en = new DishEn();
        $translation_en->dish_id = $dish->id;
        $translation_en->title = Str::title(Str::lower($request::input('title_en')));
        $translation_en->info = $request::input('info_en');
        $translation_en->big_description = $request::input('big_description_en');
        $translation_en->save();

        $translation_de = new DishDe();
        $translation_de->dish_id = $dish->id;
        $translation_de->title = Str::title(Str::lower($request::input('title_de')));
        $translation_de->info = $request::input('info_de');
        $translation_de->big_description = $request::input('big_description_de');
        $translation_de->save();

        return Redirect::back();
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_dish($id, Request $request)
    {
        $file = $request::file('img');

        $dish = Dish::find($id);

        if ($request::input('img-remove') == 'true') {
            Storage::disk('images')->delete($dish->image);
            $dish->image = '';
        }

        if ($file != null) {
            Storage::disk('images')->delete($dish->image);

            $filename = md5($file->getClientOriginalName() . microtime());
            Storage::disk('images')->put($filename, file_get_contents($file->getRealPath()));
            $dish->image = $filename;
        }

        if (str_replace(',', '.', $request::input('price')) == '') {
            $price = 0;
        } else {
            $price = $request::input('price');
        }
        if (str_replace(',', '.', $request::input('price_large')) == '') {
            $price_large = 0;
        } else {
            $price_large = $request::input('price_large');
        }

        $dish->price = $price;
        $dish->price_large = $price_large;
        $dish->beer_id = $request::input('beer_id') ?? '';
        $dish->wine_id = $request::input('wine_id') ?? '';
        $dish->vegan = $request::input('vegan');
        $dish->glute = $request::input('glute');
        $dish->lactose = $request::input('lactose');
        $dish->sauce = $request::input('sauce');
        $dish->vos_image = $request::input('vos_image');
        $dish->sub_course_id = $request::input('category');
        if ($request::has('join_product')) {
            $dish->product_id = collect($request::input('products'))->implode(',');
        } else {
            $dish->product_id = 0;
        }
        $dish->save();

        $translation = DishNl::where('dish_id', '=', $id)->first();
        $translation->title = Str::title(Str::lower($request::input('title')));
        $translation->info = $request::input('info');
        $translation->big_description = $request::input('big_description');
        $translation->save();

        $translation = DishEn::where('dish_id', '=', $id)->first();
        $translation->title = Str::title(Str::lower($request::input('title_en')));
        $translation->info = $request::input('info_en');
        $translation->big_description = $request::input('big_description_en');
        $translation->save();

        $translation = DishDe::where('dish_id', '=', $id)->first();
        $translation->title = Str::title(Str::lower($request::input('title_de')));
        $translation->info = $request::input('info_de');
        $translation->big_description = $request::input('big_description_de');
        $translation->save();

        return Redirect::back();
    }


    /**
     * Store a newly created dish in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function duplicate_dish($id)
    {
        $dish = Dish::find($id);
        $newDish = $dish->replicate();
        $newDish->order = Dish::where('sub_course_id', '=', $dish->sub_course_id)->count() + 1;
        $newDish->toggle = 1;
        $newDish->created_at = Carbon::now();
        $newDish->save();

        $dishNl = DishNl::where('dish_id', '=', $id)->first();
        $newDishNl = $dishNl->replicate();
        $newDishNl->dish_id = $newDish->id;
        $newDishNl->title = $newDishNl->title.'(kopie)';
        $newDishNl->created_at = Carbon::now();
        $newDishNl->save();

        $dishEn = DishEn::where('dish_id', '=', $id)->first();
        $newDishEn = $dishEn->replicate();
        $newDishEn->dish_id = $newDish->id;
        $newDishEn->title = $newDishEn->title.'(kopie)';
        $newDishEn->created_at = Carbon::now();
        $newDishEn->save();

        $dishDe = DishDe::where('dish_id', '=', $id)->first();
        $newDishDe = $dishDe->replicate();
        $newDishDe->dish_id = $newDish->id;
        $newDishDe->title = $newDishDe->title.'(kopie)';
        $newDishDe->created_at = Carbon::now();
        $newDishDe->save();

        return Redirect::back();
    }


    /**
     * delete dish in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy_dish($id)
    {
        Dish::destroy($id);
        DishNl::where('dish_id', '=', $id)->delete();
        DishEn::where('dish_id', '=', $id)->delete();
        DishDe::where('dish_id', '=', $id)->delete();

        return Redirect::back();
    }
}
