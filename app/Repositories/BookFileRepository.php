<?php

namespace App\Repositories;

use App\Models\BookFile;

class BookFileRepository
{
    public function all($book_id)
    {
        return BookFile::where('book_id', $book_id)->latest()->get();
    }

    public function create(array $data)
    {
        return BookFile::create($data);
    }


    public function getLastOrder()
    {
        return BookFile::max('order')??0;
    }

    public function find($id)
    {
        return BookFile::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $book_file = $this->find($id);
        $book_file->update($data);
        return $book_file;
    }
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
