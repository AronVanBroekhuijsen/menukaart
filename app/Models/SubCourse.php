<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

class SubCourse extends Model
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
        'course_id',
    ];

    public function labels(): BelongsToMany
    {
        $now = Carbon::now();
        if (Route::currentRouteName() !== 'dish_view' && Route::currentRouteName() !== 'category_view') {
            return $this->belongsToMany(Label::class, 'sub_course_label')
                ->where('start', '<=', $now)
                ->where('end', '>=', $now);
        } else {
            return $this->belongsToMany(Label::class, 'sub_course_label');
        }
    }

    protected $table = 'sub_courses';

    public function title($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = SubCourseNl::where('sub_course_id', '=', $value)->first()->title ?? '';
            $full_title->en = SubCourseEn::where('sub_course_id', '=', $value)->first()->title ?? '';
            $full_title->de = SubCourseDe::where('sub_course_id', '=', $value)->first()->title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return SubCourseNl::where('sub_course_id', '=', $value)->first()->title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return SubCourseEn::where('sub_course_id', '=', $value)->first()->title ?? '';
                    break;
                case 'de':
                    return SubCourseDe::where('sub_course_id', '=', $value)->first()->title ?? '';
                    break;
            }
        }
    }

    public function sub_title($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = SubCourseNl::where('sub_course_id', '=', $value)->first()->sub_title ?? '';
            $full_title->en = SubCourseEn::where('sub_course_id', '=', $value)->first()->sub_title ?? '';
            $full_title->de = SubCourseDe::where('sub_course_id', '=', $value)->first()->sub_title ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return SubCourseNl::where('sub_course_id', '=', $value)->first()->sub_title ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return SubCourseEn::where('sub_course_id', '=', $value)->first()->sub_title ?? '';
                    break;
                case 'de':
                    return SubCourseDe::where('sub_course_id', '=', $value)->first()->sub_title ?? '';
                    break;
            }
        }
    }

    public function text_small($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = SubCourseNl::where('sub_course_id', '=', $value)->first()->text_small ?? '';
            $full_title->en = SubCourseEn::where('sub_course_id', '=', $value)->first()->text_small ?? '';
            $full_title->de = SubCourseDe::where('sub_course_id', '=', $value)->first()->text_small ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return SubCourseNl::where('sub_course_id', '=', $value)->first()->text_small ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return SubCourseEn::where('sub_course_id', '=', $value)->first()->text_small ?? '';
                    break;
                case 'de':
                    return SubCourseDe::where('sub_course_id', '=', $value)->first()->text_small ?? '';
                    break;
            }
        }
    }

    public function text_large($value)
    {
        if (Route::currentRouteName() == 'category_view') {

            $full_title = collect();
            $full_title->nl = SubCourseNl::where('sub_course_id', '=', $value)->first()->text_large ?? '';
            $full_title->en = SubCourseEn::where('sub_course_id', '=', $value)->first()->text_large ?? '';
            $full_title->de = SubCourseDe::where('sub_course_id', '=', $value)->first()->text_large ?? '';

            return $full_title;
        }

        if (!isset($_GET['lang'])) {
            return SubCourseNl::where('sub_course_id', '=', $value)->first()->text_large ?? '';
        } else {
            switch ($_GET['lang']) {
                case 'en':
                    return SubCourseEn::where('sub_course_id', '=', $value)->first()->text_large ?? '';
                    break;
                case 'de':
                    return SubCourseDe::where('sub_course_id', '=', $value)->first()->text_large ?? '';
                    break;
            }
        }
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function dishes(): HasMany
    {
        if (Route::currentRouteName() !== 'dish_view' && Route::currentRouteName() !== 'category_view') {
            return $this->hasMany(Dish::class)->orderBy('order');
        } else {
            return $this->hasMany(Dish::class);
        }
    }

    public function label_date() {
        $now = Carbon::now();
        $label = Label::where('start', '<', $now)->where('end', '>', $now)->first();

        return $label;
    }
}
