<?php

namespace App\Providers;


use App\Interfaces\Dashboard\brandsInterrface;
use App\Interfaces\Dashboard\categoriesInterface;
use App\Interfaces\Dashboard\componentsInterface;
use App\Interfaces\Dashboard\flavoursInterface;
use App\Interfaces\Dashboard\liquidInterface;
use App\Repository\Dashboard\BrandsRepository;
use App\Repository\Dashboard\categoriesRepository;
use App\Repository\Dashboard\componentsRepository;
use App\Repository\Dashboard\flavoursRepository;
use App\Repository\Dashboard\liquidRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(brandsInterrface::class , BrandsRepository::class);
        $this->app->bind(categoriesInterface::class , categoriesRepository::class);
        $this->app->bind(componentsInterface::class , componentsRepository::class);
        $this->app->bind(flavoursInterface::class , flavoursRepository::class);
        $this->app->bind(liquidInterface::class , liquidRepository::class);

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
