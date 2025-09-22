<?php

namespace App\Providers;

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
        $this->app->bind(
            \App\Repositories\ProductRepository::class,
            \App\Repositories\ProductRepository::class
        );

        $this->app->bind(
            \App\Services\ProductService::class,
            \App\Services\ProductService::class
        );

        $this->app->bind(
            \App\Repositories\OrderRepository::class,
            \App\Repositories\OrderRepository::class
        );

        $this->app->bind(
            \App\Services\OrderService::class,
            \App\Services\OrderService::class
        );

        $this->app->bind(
            \App\Repositories\ExpenseRepository::class,
            \App\Repositories\ExpenseRepository::class
        );

        $this->app->bind(
            \App\Services\ExpenseService::class,
            \App\Services\ExpenseService::class
        );

        $this->app->bind(
            \App\Repositories\SalesReportRepository::class,
            \App\Repositories\SalesReportRepository::class
        );

        $this->app->bind(
            \App\Services\SalesReportService::class,
            \App\Services\SalesReportService::class
        );
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
