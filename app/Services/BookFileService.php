<?php

namespace App\Services;

use App\Repositories\BookFileRepository;
use App\Traits\ImageCustomizeTrait;

class BookFileService
{
    protected $repo;

    public function __construct(BookFileRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list($book_id)
    {
        return $this->repo->all($book_id);
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

    public function update($id, array $data)
    {
        $data = $this->refined($data, 'update');
        try {
            $book_file = $this->repo->find($id);
            if (!empty($data['file'])){
                if (!empty($book_file->file)){
                    ImageCustomizeTrait::deleteImage($book_file->file);
                }
            }
            return $this->repo->update($id, $data);
        }catch (\Exception $exception){
            throw new \Exception("Book update failed: " . $exception->getMessage());
        }
    }


    public function refined(array $data, $type = 'create')
    {
        if (empty($data['status'])) {
            $data['status'] = 'Active';
        }
        if (!isset($data['order']) || empty($data['order'])) {
            $lastOrder = $this->repo->getLastOrder();
            $data['order'] = $lastOrder + 1;
        }

        if (!empty($data['file'])){
            $docPath = ImageCustomizeTrait::uploadImage($data['file'], 'book_file');
            $data['file'] = $docPath;
        }else{
            unset($data['file']);
        }

        if ($type == 'create'){
            $data['slug'] = SlugService::generateUniqueSlugForBook($data['name']);
        }else{
            unset($data['slug']);
        }
        return $data;
    }




    public function delete($id)
    {
        try {
            $book_file = $this->repo->find($id);
            if (!empty($book_file->file)){
                ImageCustomizeTrait::deleteImage($book_file->file);
            }
            return $this->repo->delete($id);
        }catch (\Exception $exception){
            throw new \Exception("Book deletion failed: " . $exception->getMessage());
        }

    }
}
