<?php

namespace App\Providers;

use App\Interfaces\MachineInterface;
use App\Interfaces\ProductInterface;
use App\Interfaces\ReadingInterface;
use App\Interfaces\ShiftInterface;
use App\Repositories\MachineRepository;
use App\Interfaces\UserInterface;
use App\Repositories\ReadingRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ShiftRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MachineRepository::class, MachineInterface::class);
        $this->app->bind(UserRepository::class, UserInterface::class);
        $this->app->bind(MachineInterface::class,MachineRepository::class);
        $this->app->bind(ShiftInterface::class,ShiftRepository::class);
        $this->app->bind(ProductInterface::class,ProductRepository::class);
        $this->app->bind(ReadingInterface::class,ReadingRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
