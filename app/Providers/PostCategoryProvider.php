<?php

namespace App\Providers;

use App\Repositories\PostCategory\IPostCategoryRepository;
use App\Repositories\PostCategory\PostCategoryRepository;
use Illuminate\Support\ServiceProvider;

class PostCategoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(IPostCategoryRepository::class, PostCategoryRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
