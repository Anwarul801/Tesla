<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 16:47:39
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-08 14:46:05
 * @Description: Innova IT
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);

    }
      public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }
      public function question()
    {
        return $this->hasOne(QuizQuestion::class)->orderby('order','DESC');
    }
       public function module()
    {
        return $this->belongsTo(Module::class);

    }
}
