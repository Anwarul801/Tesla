<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all()
    {
        return Book::latest()->paginate();
    }

    public function create(array $data)
    {
        return Book::create($data);
    }


    public function getLastOrder()
    {
        return Book::max('order')??0;
    }
}
