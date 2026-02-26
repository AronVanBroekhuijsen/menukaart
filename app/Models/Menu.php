<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Carbon;

class Menu extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'sub_title',
    ];

    public function labels(): BelongsToMany
    {
        $now = Carbon::now();
        if (Route::currentRouteName() !== 'dish_view' && Route::currentRouteName() !== 'category_view' && Route::currentRouteName() !== 'add_label') {
            return $this->belongsToMany(Label::class, 'menu_label')
                ->where('start', '<=', $now)
                ->where('end', '>=', $now);
        } else {
            return $this->belongsToMany(Label::class, 'menu_label');
        }
    }

    public function title($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = MenuNl::where('menu_id', '=', $value)->first()->title ?? '';
            $full_title->en = MenuEn::where('menu_id', '=', $value)->first()->title ?? '';
            $full_title->de = MenuDe::where('menu_id', '=', $value)->first()->title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return MenuNl::where('menu_id', '=', $value)->first()->title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return MenuEn::where('menu_id', '=', $value)->first()->title ?? '';
                    break;
                case 'de':
                    return MenuDe::where('menu_id', '=', $value)->first()->title ?? '';
                    break;
            }
        }
    }

    public function sub_title($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = MenuNl::where('menu_id', '=', $value)->first()->sub_title ?? '';
            $full_title->en = MenuEn::where('menu_id', '=', $value)->first()->sub_title ?? '';
            $full_title->de = MenuDe::where('menu_id', '=', $value)->first()->sub_title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return MenuNl::where('menu_id', '=', $value)->first()->sub_title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return MenuEn::where('menu_id', '=', $value)->first()->sub_title ?? '';
                    break;
                case 'de':
                    return MenuDe::where('menu_id', '=', $value)->first()->sub_title ?? '';
                    break;
            }
        }
    }

    public function text_small($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = MenuNl::where('menu_id', '=', $value)->first()->text_small ?? '';
            $full_title->en = MenuEn::where('menu_id', '=', $value)->first()->text_small ?? '';
            $full_title->de = MenuDe::where('menu_id', '=', $value)->first()->text_small ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return MenuNl::where('menu_id', '=', $value)->first()->text_small ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return MenuEn::where('menu_id', '=', $value)->first()->text_small ?? '';
                    break;
                case 'de':
                    return MenuDe::where('menu_id', '=', $value)->first()->text_small ?? '';
                    break;
            }
        }
    }

    public function text_large($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = MenuNl::where('menu_id', '=', $value)->first()->text_large ?? '';
            $full_title->en = MenuEn::where('menu_id', '=', $value)->first()->text_large ?? '';
            $full_title->de = MenuDe::where('menu_id', '=', $value)->first()->text_large ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return MenuNl::where('menu_id', '=', $value)->first()->text_large ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return MenuEn::where('menu_id', '=', $value)->first()->text_large ?? '';
                    break;
                case 'de':
                    return MenuDe::where('menu_id', '=', $value)->first()->text_large ?? '';
                    break;
            }
        }
    }


    public function courses(): HasMany
    {
        if (Route::currentRouteName() !== 'menu_edit' && Route::currentRouteName() !== 'category_view' && Route::currentRouteName() !== 'dish_view' && Route::currentRouteName() !== 'change_dish_view') {
            if ($this->label_date() != null)
            {
                return $this->hasMany(Course::class)->whereIn('toggle', [0, 1])->orderBy('order');
            } else {
                return $this->hasMany(Course::class)->where('toggle', '=', 0)->orderBy('order');
            }
        } else {
            return $this->hasMany(Course::class);
        }
    }


    public function drinkmenu() {
        $drinkmenu = Setting::find(1)->value;

        return $drinkmenu;
    }

    public function cocktailmenu() {
        $cocktailmenu = Setting::find(5)->value;

        return $cocktailmenu;
    }

    public function label_date() {
        $now = Carbon::now();
        $label = Label::where('start', '<', $now)->where('end', '>', $now)->first();

        return $label;
    }
}
