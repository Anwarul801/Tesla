<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

    // Add your repository methods here
}
