<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function all(array $filters)
    {
        $search = $this->data_filter($filters);
        return Book::where($search)->latest()->paginate();
    }


    public function data_filter($filters)
    {
        $search = [];
        if (!empty($filters['name'])) {
            $search[] = ['name', 'like', '%' . $filters['name'] . '%'];
        }
        if (!empty($filters['status'])) {
            $search[] = ['status', $filters['status']];
        }
        return $search;
    }

    public function create(array $data)
    {
        return Book::create($data);
    }


    public function getLastOrder()
    {
        return Book::max('order')??0;
    }


    public function find($id)
    {
        return Book::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);
        return $book;
    }


    public function delete($id)
    {
        return $this->find($id)->delete();
    }

}
