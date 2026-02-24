<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_label');
    }

    public function course(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_label');
    }

    public function subcourse(): BelongsToMany
    {
        return $this->belongsToMany(SubCourse::class, 'sub_course_label');
    }

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class)->withPivot(['price']);
    }
}
