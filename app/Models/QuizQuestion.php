<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-08 10:41:30
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-08 14:48:48
 * @Description: Innova IT
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
      public function course()
    {
        return $this->belongsTo(Course::class);

    }
      public function lesson()
    {
        return $this->belongsTo(Lesson::class);

    }
      public function module()
    {
        return $this->belongsTo(Module::class);

    }

}
