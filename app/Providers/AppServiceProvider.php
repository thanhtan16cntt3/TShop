<?php

namespace App\Providers;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\Admin\IAdminRepository;
use App\Repositories\Banner\BannerRepository;
use App\Repositories\Banner\IBannerRepository;
use App\Repositories\Post\IPostRepository;
use App\Repositories\Post\PostRepository;
use App\Repositories\PostCategory\IPostCategoryRepository;
use App\Repositories\PostCategory\PostCategoryRepository;
use App\Repositories\PostComment\IPostCommentRepository;
use App\Repositories\PostComment\PostCommentRepository;
use App\Repositories\Tag\ITagRepository;
use App\Repositories\Tag\TagRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IAdminRepository::class, AdminRepository::class);
        $this->app->singleton(IPostCommentRepository::class, PostCommentRepository::class);
        $this->app->singleton(IPostCategoryRepository::class, PostCategoryRepository::class);
        $this->app->singleton(IPostRepository::class, PostRepository::class);
        $this->app->singleton(ITagRepository::class, TagRepository::class);
        $this->app->singleton(IBannerRepository::class, BannerRepository::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator){
            return Hash::check($value, current($parameters));
        });
    }
}
