<?php

namespace App\Providers;

use App\Http\Resources\CommentResource;
use App\Repository\CommentRepository;
use App\Repository\CommentRepositoryInterface;
use App\Repository\PostRepository;
use App\Repository\PostRepositoryInterface;
use App\Repository\UserRepository;
use App\Repository\UserRespositoryInterface;
use Illuminate\Support\Facades\App;
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
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, CommentRepository::class);
        $this->app->bind(UserRespositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}