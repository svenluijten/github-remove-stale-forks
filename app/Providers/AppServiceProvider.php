<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Sven\FileConfig\File;
use Sven\FileConfig\Stores\Json;
use Sven\FileConfig\Stores\Store;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Store::class, function () {
            $home = Str::is('WIN*', PHP_OS) ? $_SERVER['USERPROFILE'] : $_SERVER['HOME'];

            $fileName = $home.DIRECTORY_SEPARATOR.'github-remove-stale-forks.json';

            if (!file_exists($fileName)) {
                file_put_contents($fileName, '');
            }

            return new Json(new File($fileName));
        });
    }
}
