<?php

namespace App\Providers;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use App\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Repositories\BaseRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserProjectRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserProfileRepositoryInterface::class, UserProfileRepository::class);
        $this->app->bind(UserProjectRepositoryInterface::class, UserProjectRepository::class);
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
