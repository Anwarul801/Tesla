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
        return BookQrCode::create($data);
    }
}
