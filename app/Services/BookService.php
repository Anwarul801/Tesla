<?php

namespace App\Services;

use App\Repositories\BookRepository;
use App\Traits\ImageCustomizeTrait;

class BookService
{
    protected $repo;

    public function __construct(BookRepository $repo)
    {
        $this->repo = $repo;
    }

    public function list(array $filters)
    {
        return $this->repo->all($filters);
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
            $book = $this->repo->find($id);
            if (!empty($data['image'])){
                if (!empty($book->image)){
                    ImageCustomizeTrait::deleteImage($book->image);
                }
            }
            if (!empty($data['document'])){
                if (!empty($book->document)){
                    ImageCustomizeTrait::deleteImage($book->document);
                }
            }
            return $this->repo->update($id, $data);
        }catch (\Exception $exception){
            throw new \Exception("Book update failed: " . $exception->getMessage());
        }
    }

    public function refined(array $data, $type = 'create')
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

        if (!empty($data['image'])){
            $imgPath = ImageCustomizeTrait::uploadImage($data['image'], 'book_image');
            $data['image'] = $imgPath;
        }else{
            unset($data['image']);
        }

        if (!empty($data['document'])){
            $docPath = ImageCustomizeTrait::uploadImage($data['document'], 'book_document');
            $data['document'] = $docPath;
        }else{
            unset($data['document']);
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
            $book = $this->repo->find($id);
            if (!empty($book->image)){
                ImageCustomizeTrait::deleteImage($book->image);
            }
            if (!empty($book->document)){
                ImageCustomizeTrait::deleteImage($book->document);
            }
            return $this->repo->delete($id);
        }catch (\Exception $exception){
            throw new \Exception("Book deletion failed: " . $exception->getMessage());
        }

    }
}
