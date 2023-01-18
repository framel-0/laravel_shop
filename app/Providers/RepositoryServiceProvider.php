<?php

namespace App\Providers;

use App\Repository\Eloquent\BaseRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\UnitOfMeasureRepository;
use App\Repository\Eloquent\LocationRepository;
use App\Repository\Eloquent\ItemRepository;
use App\Repository\IEloquentRepository;
use App\Repository\IUserRepository;
use App\Repository\ICategoryRepository;
use App\Repository\IUnitOfMeasureRepository;
use App\Repository\ILocationRepository;
use App\Repository\IItemRepository;
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
        $this->app->bind(IEloquentRepository::class, BaseRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IUnitOfMeasureRepository::class, UnitOfMeasureRepository::class);
        $this->app->bind(ILocationRepository::class, LocationRepository::class);
        $this->app->bind(IItemRepository::class, ItemRepository::class);
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
