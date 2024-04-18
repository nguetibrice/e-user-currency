<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Services\Contracts\ExchangeRateApiContract;
use App\Exceptions\NotImplementedException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ExchangeRateApiService implements ExchangeRateApiContract
{
    /**
     * @inheritDoc
     * @throws NotImplementedException
     */
    public function fetch(string $currency): array
    {
        // todo return static values for all currencies. keep in mind that this is a temporary solution
        Log::info("api key:".env("CURRENCY_API_KEY"). " && currency: $currency");
        $res = Http::acceptJson()
        ->withHeaders([
            "X-CoinAPI-Key" => env("CURRENCY_API_KEY"),
        ])
        ->retry(3, 100)
        ->get("https://rest.coinapi.io/v1/exchangerate/". strtoupper($currency));

        if ($res->status() != 200 && $res->status() != 201) {
            return ["error" => $res->body()];
        }

        return json_decode($res->body(), true)["rates"];
    }
}
