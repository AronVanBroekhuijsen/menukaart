<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Sauce extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'price',
    ];


    public function title($value)
    {
        if (Route::currentRouteName() == 'sauce_view') {

            $full_title = collect();
            $full_title->nl = SauceNl::where('sauce_id', '=', $value)->first()->title ?? '';
            $full_title->en = SauceEn::where('sauce_id', '=', $value)->first()->title ?? '';
            $full_title->de = SauceDe::where('sauce_id', '=', $value)->first()->title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return SauceNl::where('sauce_id', '=', $value)->first()->title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return SauceEn::where('sauce_id', '=', $value)->first()->title ?? '';
                    break;
                case 'de':
                    return SauceDe::where('sauce_id', '=', $value)->first()->title ?? '';
                    break;
            }
        }
    }

    public function getPriceAttribute($value)
    {
        return str_replace('.', ',', $value);
    }
}
