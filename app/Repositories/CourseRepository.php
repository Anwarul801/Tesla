<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:00:04
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-07 12:59:52
 * @Description: Innova IT
 */

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    protected $model;

    public function __construct(Course $model)
    {
        $this->model = $model;
    }

     // CRUD Functions
    public function all($request)
    {
        return $this->model->paginate(10);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function store(array $data): Course
    {
        return Course::create($data);
    }

    public function update(Course $course, array $data): Course
    {
        $course->update($data);
        return $course;
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
