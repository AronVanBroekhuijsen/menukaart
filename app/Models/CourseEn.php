<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseEn extends Model
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
   protected $table = 'course_en';
}
