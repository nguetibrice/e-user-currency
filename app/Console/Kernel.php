<?php

namespace App\Console;

use App\Jobs\ExchangeRateJob;
use App\Services\Contracts\ExchangeRateApiContract;
use App\Services\Contracts\ExchangeRateContract;
use App\Services\Contracts\ICurrencyService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $apiExchangeRatesService = app(ExchangeRateApiContract::class);
        $exchangeRateService = app(ExchangeRateContract::class);
        $currencyService = app(ICurrencyService::class);
        $schedule
        ->job(new ExchangeRateJob(
            $apiExchangeRatesService,
            $exchangeRateService,
            $currencyService,
            env("DEFAULT_CURRENCY")
        ))
        ->withoutOverlapping()
        ->everySixHours()
        ;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
