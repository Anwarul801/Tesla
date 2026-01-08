<?php

namespace App\Services;

use App\Repositories\BookQrCodeRepository;
use Illuminate\Support\Str;

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
        $data = $this->refined($data);
        $newData = [];
        $generatedCodes = [];
        $now = now();
        for ($i = 0; $i < $data['amount']; $i++) {
            do {
                $code = Str::random(20);
            } while (
                in_array($code, $generatedCodes) ||
                $this->repo->existsByCodeId($code)
            );

            $generatedCodes[] = $code;

            $newData[] = [
                'book_id'    => $data['book_id'],
                'name'       => $data['name'],
                'code_id'    => $code,
                'status'     => $data['status'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        return $this->repo->create($newData);
    }



    public function refined(array $data, $type = 'create')
    {
        if (empty($data['status'])) {
            $data['status'] = 'Active';
        }
        return $data;
    }

    private function generateUniqueCodeId()
    {
        do {
            $code = Str::random(16);
        } while (
            $this->repo->where('code_id', $code)->exists()
        );
        return $code;
    }

    public function delete($id)
    {
        try {
            $this->repo->delete($id);
        }catch (\Exception $exception){
            throw new \Exception("Book QR Code deletion failed: " . $exception->getMessage());
        }
    }

}
