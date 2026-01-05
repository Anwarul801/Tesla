<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all()
    {
        return Book::latest()->get();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }
}