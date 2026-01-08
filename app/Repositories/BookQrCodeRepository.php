<?php

namespace App\Repositories;

use App\Models\BookQrCode;

class BookQrCodeRepository
{
    public function all(array $filters)
    {
        $search = $this->data_filter($filters);
        return BookQrCode::where($search)->latest()->paginate(100);
    }

    public function data_filter($filters)
    {
        $search = [];
        if (!empty($filters['book_id'])) {
            $search[] = ['book_id', $filters['book_id']];
        }
        if (!empty($filters['name'])) {
            $search[] = ['name', 'like', '%' . $filters['name'] . '%'];
        }
        if (!empty($filters['status'])) {
            $search[] = ['status', $filters['status']];
        }
        if (!empty($filters['id'])) {
            $search[] = ['id', $filters['id']];
        }
        return $search;
    }

    public function create(array $data)
    {
        return BookQrCode::insert($data);
    }

    public function where($query)
    {
        return BookQrCode::where($query);
    }

    public function existsByCodeId(string $code): bool
    {
        return BookQrCode::where('code_id', $code)->exists();
    }


    public function find($id)
    {
        return BookQrCode::findOrFail($id);
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
