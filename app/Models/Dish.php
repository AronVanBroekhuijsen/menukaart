<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\Request;

class Dish extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'info',
        'price',
        'beer_id',
        'wine_id',
        'vegan',
        'sauce',
        'sub_course_id',
    ];

    public function title($value)
    {
        if (Route::currentRouteName() == 'dish_view' || Route::currentRouteName() == 'change_dish_view') {

            $full_title = collect();
            $full_title->nl = DishNl::where('dish_id', '=', $value)->first()->title ?? '';
            $full_title->en = DishEn::where('dish_id', '=', $value)->first()->title ?? '';
            $full_title->de = DishDe::where('dish_id', '=', $value)->first()->title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return DishNl::where('dish_id', '=', $value)->first()->title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return DishEn::where('dish_id', '=', $value)->first()->title ?? '';
                    break;
                case 'de':
                    return DishDe::where('dish_id', '=', $value)->first()->title ?? '';
                    break;
            }
        }
    }

    public function info($value)
    {
        if (Route::currentRouteName() == 'dish_view' || Route::currentRouteName() == 'change_dish_view') {

            $full_title = collect();
            $full_title->nl = DishNl::where('dish_id', '=', $value)->first()->info ?? '';
            $full_title->en = DishEn::where('dish_id', '=', $value)->first()->info ?? '';
            $full_title->de = DishDe::where('dish_id', '=', $value)->first()->info ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return DishNl::where('dish_id', '=', $value)->first()->info ?? '';
        }
        switch ($_GET['lang']) {
            case 'en':
                return DishEn::where('dish_id', '=', $value)->first()->info ?? '';
                break;
            case 'de':
                return DishDe::where('dish_id', '=', $value)->first()->info ?? '';
                break;
        }
    }

    public function big_description($value)
    {
        if (Route::currentRouteName() == 'dish_view' || Route::currentRouteName() == 'change_dish_view') {

            $full_title = collect();
            $full_title->nl = DishNl::where('dish_id', '=', $value)->first()->big_description ?? '';
            $full_title->en = DishEn::where('dish_id', '=', $value)->first()->big_description ?? '';
            $full_title->de = DishDe::where('dish_id', '=', $value)->first()->big_description ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return DishNl::where('dish_id', '=', $value)->first()->big_description ?? '';
        }
        switch ($_GET['lang']) {
            case 'en':
                return DishEn::where('dish_id', '=', $value)->first()->big_description ?? '';
                break;
            case 'de':
                return DishDe::where('dish_id', '=', $value)->first()->big_description ?? '';
                break;
        }
    }

    public function text_small($value)
    {
        if (Route::currentRouteName() == 'dish_view' || Route::currentRouteName() == 'change_dish_view') {

            $full_title = collect();
            $full_title->nl = DishNl::where('dish_id', '=', $value)->first()->text_small ?? '';
            $full_title->en = DishEn::where('dish_id', '=', $value)->first()->text_small ?? '';
            $full_title->de = DishDe::where('dish_id', '=', $value)->first()->text_small ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return DishNl::where('dish_id', '=', $value)->first()->text_small ?? '';
        }
        switch ($_GET['lang']) {
            case 'en':
                return DishEn::where('dish_id', '=', $value)->first()->text_small ?? '';
                break;
            case 'de':
                return DishDe::where('dish_id', '=', $value)->first()->text_small ?? '';
                break;
        }
    }

    public function text_large($value)
    {
        if (Route::currentRouteName() == 'dish_view' || Route::currentRouteName() == 'change_dish_view') {

            $full_title = collect();
            $full_title->nl = DishNl::where('dish_id', '=', $value)->first()->text_large ?? '';
            $full_title->en = DishEn::where('dish_id', '=', $value)->first()->text_large ?? '';
            $full_title->de = DishDe::where('dish_id', '=', $value)->first()->text_large ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return DishNl::where('dish_id', '=', $value)->first()->text_large ?? '';
        }
        switch ($_GET['lang']) {
            case 'en':
                return DishEn::where('dish_id', '=', $value)->first()->text_large ?? '';
                break;
            case 'de':
                return DishDe::where('dish_id', '=', $value)->first()->text_large ?? '';
                break;
        }
    }

    public function getPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }

    public function getPriceLargeAttribute($value)
    {
        return str_replace('.', ',', $value);
    }

    public function getBeerIdAttribute($value)
    {
        if (is_numeric($value)) {
            if (empty(Dish::find($value))) {
                return '';
            } else {
                return Dish::find($value)->title($value);
            }
        }
    }

    public function getWineIdAttribute($value)
    {
        if (is_numeric($value)) {
            if (empty(Dish::find($value))) {
                return '';
            } else {
                return Dish::find($value)->title($value);
            }
        }
    }

    public function getProductIdAttribute($value) {
        return explode(',', $value);
    }

    public function getSubProductAttribute($value) {
        $with_products = Dish::where([
            ['toggle', '=', 0],
            ['product_id', '!=', '0'],
            ['product_id', '!=', 'NULL']
        ])->orderBy('order')->get();

        foreach ($with_products as $with_product) {
            foreach ($with_product->product_id as $product_id) {
                if ($this->id == $product_id) {
                    $test[] = $with_product->title($with_product->id);
                }
            }
        }
        return $test ?? '';
    }



    public function getFullSubProductAttribute($value) {
        $with_products = Dish::where([
            ['toggle', '=', 0],
            ['product_id', '!=', '0'],
            ['product_id', '!=', 'NULL']
        ])->orderBy('order')->get();

        return $with_products ?? '';
    }

    public function sub_course(): BelongsTo
    {
        return $this->belongsTo(SubCourse::class);
    }

    public function category($value)
    {
        $sub_course = SubCourse::find($value->sub_course_id);
        if (is_null($sub_course)) {
            return '';
        }

        return $sub_course->title($sub_course->id);
    }

    public function drinkmenu() {
        $drinkmenu = Setting::find(1)->value;

        return $drinkmenu;
    }

    public function more_info() {
        if (!isset($_GET['lang'])) {
            return 'meer info';
        }
        switch ($_GET['lang']) {
            case 'en':
                return 'more info';
                break;
            case 'de':
                return 'Mehr Info';
                break;
        }
    }
}
