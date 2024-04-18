<?php

namespace App\Services\Contracts;

use App\Models\ExchangeRate;

interface ExchangeRateContract
{
    /**
     * Save list of given exchange rates in database
     *
     * @param ExchangeRate[] $exchangeRates
     */
    public function saveMany(array $exchangeRates);

    /**
     * Gets list of exchange rates for a given date
     *
     * @param string|null $start_date
     * @param string|null $end_date
     * @return ExchangeRate[]
     */
    public function fetchByDate(string $start_date = null, string $end_date = null);
}
