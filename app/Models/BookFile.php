<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookFile extends Model
{
    protected $fillable = [
        'book_id',
        'name',
        'slug',
        'file',
        'order',
        'status',
    ];
}
