<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{
    protected $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    // Add your service methods here
}
