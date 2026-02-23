<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Side extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
       'title',
   ];


   public function title($value)
   {
       if (Route::currentRouteName() == 'side_view') {

           $full_title = collect();
           $full_title->nl = SideNl::where('side_id', '=', $value)->first()->title ?? '';
           $full_title->en = SideEn::where('side_id', '=', $value)->first()->title ?? '';
           $full_title->de = SideDe::where('side_id', '=', $value)->first()->title ?? '';

           return $full_title;
       }

       if (!isset($_GET['lang'])) {
           return SideNl::where('side_id', '=', $value)->first()->title ?? '';
       } else {
           switch ($_GET['lang']) {
               case 'en':
                   return SideEn::where('side_id', '=', $value)->first()->title ?? '';
                   break;
               case 'de':
                   return SideDe::where('side_id', '=', $value)->first()->title ?? '';
                   break;
           }
       }
   }
}
