<?php

namespace App\Services;

use App\Models\ExchangeRate;
use App\Services\Contracts\ExchangeRateContract;
use App\Exceptions\NotImplementedException;
use Illuminate\Support\Facades\Cache;

class ExchangeRateService implements ExchangeRateContract
{
    /**
     * @inheritDoc
     */
    public function saveMany(array $exchangeRates)
    {
        foreach ($exchangeRates as $rate) {
            $rate->save();
        }
    }

    /**
     * @inheritDoc
     */
    public function fetchByDate(string $start_date = null, string $end_date = null)
    {
        if ($start_date == null && $end_date == null) {
            return ExchangeRate::orderBy("created_at", "desc")->get();
        } elseif ($end_date == null) {
            return ExchangeRate::where("created_at", ">=" , $start_date." 00:00")->orderBy("created_at", "desc")->get();
        } else {
            return ExchangeRate::whereBetween("created_at", [$start_date." 00:00" , $end_date." 23:59"])->orderBy("created_at", "desc")->get();
        }
    }
}
