<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
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

    public function labels(): BelongsToMany
    {
        $now = Carbon::now();
        if (Route::currentRouteName() !== 'dish_view' && Route::currentRouteName() !== 'category_view') {
            return $this->belongsToMany(Label::class, 'course_label')
                ->where('start', '<=', $now)
                ->where('end', '>=', $now);
        } else {
            return $this->belongsToMany(Label::class, 'course_label');
        }
    }

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

    public function label_date() {
        $now = Carbon::now();
        $label = Label::where('start', '<', $now)->where('end', '>', $now)->first();

        return $label;
    }
}
