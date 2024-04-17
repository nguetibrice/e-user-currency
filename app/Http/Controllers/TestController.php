<?php

namespace App\Http\Controllers;

use App\Jobs\ExchangeRateJob;
use App\Services\Contracts\ExchangeRateApiContract;
use App\Services\Contracts\ExchangeRateContract;
use App\Services\Contracts\ICurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        $apiExchangeRatesService = app(ExchangeRateApiContract::class);
        $exchangeRateService = app(ExchangeRateContract::class);
        $currencyService = app(ICurrencyService::class);

        ExchangeRateJob::dispatch($apiExchangeRatesService, $exchangeRateService, $currencyService, "CAD");

        return response("OK");
    }
}
