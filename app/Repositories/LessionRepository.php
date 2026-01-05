<?php

namespace App\Repositories;

use App\Models\Lession;

class LessionRepository
{
    protected $model;

    public function __construct(Lession $model)
    {
        $this->model = $model;
    }

    // CRUD Functions
    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->find($id);
        if ($item) {
            $item->update($data);
            return $item;
        }
        return null;
    }

    public function delete($id)
    {
        $item = $this->find($id);
        if ($item) {
            return $item->delete();
        }
        return false;
    }
}
