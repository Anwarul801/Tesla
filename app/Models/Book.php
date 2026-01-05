<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'price',
        'discount',
        'image',
        'description',
        'document',
        'promo_video',
        'type',
        'order',
        'status',
    ];

}
