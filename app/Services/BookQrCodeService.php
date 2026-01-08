<?php

namespace App\Services;

use App\Repositories\BookQrCodeRepository;

class BookQrCodeService
{
    protected $repo;

    public function __construct(BookQrCodeRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list(array $filters)
    {
        return $this->repo->all($filters);
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }
}
