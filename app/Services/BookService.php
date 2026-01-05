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
        $data = $this->refined($data);
        try {
        return $this->repo->create($data);
        }catch (\Exception $exception){
            throw new \Exception("Book creation failed: " . $exception->getMessage());
        }
    }

    public function refined(array $data)
    {
        if (!isset($data['discount']) || $data['discount'] <= 0) {
            unset($data['discount']);
        }
        if (!isset($data['type']) || empty($data['type'])) {
            $data['type'] = 'Hard Copy';
        }
        if (empty($data['status'])) {
            $data['status'] = 'Active';
        }
        if (empty($data['description'])) {
            unset($data['description']);
        }
        if (!isset($data['order']) || empty($data['order'])) {
            $lastOrder = $this->repo->getLastOrder();
            $data['order'] = $lastOrder + 1;
        }
        return $data;
    }
}
