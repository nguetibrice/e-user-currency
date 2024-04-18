<?php

namespace App\Http\Controllers;

use App\Services\Contracts\ExchangeRateContract;
use Illuminate\Http\Request;

class ExchangeRateController extends Controller
{
    protected ExchangeRateContract $exchangeRateContract;

    public function __construct(ExchangeRateContract $exchangeRateContract)
    {
        $this->exchangeRateContract = $exchangeRateContract;
    }
    public function index(Request $request)
    {
        $rate_history = $this->exchangeRateContract->fetchByDate($request->start_date, $request->end_date);

        return response([
            "status" => "success",
            "data" => $rate_history,
        ]);
    }
}
