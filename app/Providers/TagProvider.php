<?php

namespace App\Providers;

use App\Repositories\Tag\ITagRepository;
use App\Repositories\Tag\TagRepository;
use Illuminate\Support\ServiceProvider;

class TagProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ITagRepository::class, TagRepository::class);
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
