<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:00:04
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-07 13:05:13
 * @Description: Innova IT
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
    'name',
    'slug',
    'book_id',
    'thumbnail',
    'banner',
    'document',
    'price',
    'discount',
    'short_description',
    'description',
    'promo_video',
    'status',
    'order',
];

 public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
