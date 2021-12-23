<?php

namespace App\Providers;

use App\Cotizaciones\Plazos\PlazoRepository;
use App\Cotizaciones\Plazos\PlazoRepositoryInterface;
use App\Cotizaciones\Productos\ProductoRepository;
use App\Cotizaciones\Productos\ProductoRepositoryInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);

        $this->app->bind(ProductoRepositoryInterface::class, ProductoRepository::class);
        $this->app->bind(PlazoRepositoryInterface::class, PlazoRepository::class);
    }
}
