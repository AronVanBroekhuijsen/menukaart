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

    public function dishes(): BelongsToMany
    {
        return $this->belongsToMany(Dish::class)->withPivot(['price']);
    }
}
