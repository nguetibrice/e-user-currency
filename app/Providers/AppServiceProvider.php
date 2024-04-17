<?php

namespace App\Providers;

use App\Services\Contracts\ExchangeRateContract;
use App\Services\ExchangeRateService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->app->singleton(ExchangeRateContract::class, ExchangeRateService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
