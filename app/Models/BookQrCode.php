<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookQrCode extends Model
{
    protected $fillable = [
        'book_id',
        'name',
        'code_id',
        'status',
        'created_at',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
