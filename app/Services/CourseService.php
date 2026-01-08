<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 15:00:04
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-07 13:00:34
 * @Description: Innova IT
 */

namespace App\Services;
use Illuminate\Support\Str;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\Storage;
use App\Models\Course;

class CourseService
{
    protected $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

     // Service wrapper functions
    public function getAll($request)
    {
        return $this->repository->all($request);
    }

    public function getById($id)
    {
        return $this->repository->find($id);
    }

   public function store(array $data): Course
{
    $data['slug'] = $this->generateSlug($data['name']);
    $data = $this->handleFiles($data);

    return $this->repository->store($data);
}

public function update(Course $course, array $data): Course
{
    // name change হলে slug update হবে
    if (isset($data['name']) && $data['name'] !== $course->name) {
        $data['slug'] = $this->generateSlug($data['name'], $course->id);
    }

    $data = $this->handleFiles($data, $course);
    return $this->repository->update($course, $data);
}

    public function delete($id)
    {
        return $this->repository->delete($id);
    }


    private function generateSlug(string $name, int $ignoreId = null): string
{
    $slug = Str::slug($name);
    $original = $slug;
    $count = 1;

    while (
        Course::where('slug', $slug)
            ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
    ) {
        $slug = $original . '-' . $count++;
    }

    return $slug;
}

private function handleFiles(array $data, Course $course = null): array
    {
        foreach (['thumbnail', 'banner', 'document'] as $file) {

            if (isset($data[$file]) && $data[$file]) {

                // delete old file on update
                if ($course && $course->$file) {
                    Storage::disk('public')->delete($course->$file);
                }

                $data[$file] = $data[$file]
                    ->store('courses', 'public');
            } else {
                unset($data[$file]);
            }
        }

        return $data;
    }
}
