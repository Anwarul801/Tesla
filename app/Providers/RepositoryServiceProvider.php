<?php
/**
 * @Author: Anwarul
 * @Date: 2026-01-05 14:47:39
 * @LastEditors: Anwarul
 * @LastEditTime: 2026-01-05 14:47:57
 * @Description: Innova IT
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use File;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $repositoriesPath = app_path('Repositories');
        $files = File::allFiles($repositoriesPath);

        foreach ($files as $file) {
            $class = 'App\\Repositories\\' . pathinfo($file, PATHINFO_FILENAME);

            if (class_exists($class)) {
                // Auto-bind repository with itself
                $this->app->singleton($class, function($app) use ($class) {
                    return new $class($app);
                });
            }
        }
    }

    public function boot()
    {
        //
    }
}
