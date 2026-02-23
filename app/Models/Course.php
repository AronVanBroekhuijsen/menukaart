<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Route;

class Course extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'menu_id',
    ];

    public function title($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = CourseNl::where('course_id', '=', $value)->first()->title ?? '';
            $full_title->en = CourseEn::where('course_id', '=', $value)->first()->title ?? '';
            $full_title->de = CourseDe::where('course_id', '=', $value)->first()->title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return CourseNl::where('course_id', '=', $value)->first()->title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return CourseEn::where('course_id', '=', $value)->first()->title ?? '';
                    break;
                case 'de':
                    return CourseDe::where('course_id', '=', $value)->first()->title ?? '';
                    break;
            }
        }
    }

    public function sub_title($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = CourseNl::where('course_id', '=', $value)->first()->sub_title ?? '';
            $full_title->en = CourseEn::where('course_id', '=', $value)->first()->sub_title ?? '';
            $full_title->de = CourseDe::where('course_id', '=', $value)->first()->sub_title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return CourseNl::where('course_id', '=', $value)->first()->sub_title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return CourseEn::where('course_id', '=', $value)->first()->sub_title ?? '';
                    break;
                case 'de':
                    return CourseDe::where('course_id', '=', $value)->first()->sub_title ?? '';
                    break;
            }
        }
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function sub_courses(): HasMany
    {
        if (Route::currentRouteName() !== 'menu_edit' && Route::currentRouteName() !== 'category_view' && Route::currentRouteName() !== 'dish_view') {
            return $this->hasMany(SubCourse::class)->where('toggle', '=', 0)->orderBy('order');
        } else {
            return $this->hasMany(SubCourse::class);
        }
    }
}
