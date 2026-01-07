<?php

namespace App\Services;

use Illuminate\Support\Str;
use App\Models\Book;

class SlugService
{
    public static function generateUniqueSlugForBook(string $title): string
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        while (Book::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
