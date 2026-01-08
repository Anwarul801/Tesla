<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:04:22
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-08 14:14:09
 * @Description: Innova IT
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    //
    protected $fillable = [
    'title',
    'slug',
    'course_id',
    'status',
    'order',
];
    public function course()
    {
        return $this->belongsTo(Course::class);

    }
      public function videos()
    {
        return $this->hasMany(Lesson::class);
    }
      public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

}
