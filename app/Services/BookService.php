<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $repo;

    public function __construct(BookRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list()
    {
        return $this->repo->all();
    }

    public function create(array $data)
    {
        return $this->repo->create($data);
    }
}