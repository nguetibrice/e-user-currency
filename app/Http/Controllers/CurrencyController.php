<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use App\Services\Contracts\ICurrencyService;

class CurrencyController extends Controller
{
    protected ICurrencyService $currencyService;

    public function __construct(ICurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * Display a listing of currencies supported.
     */
    public function index()
    {
        $currencies = $this->currencyService->getCurrencies();
        return success('all currencies',200,$currencies);
    }

    /**
     * Display the specified currency.
     */
    public function show(string $id)
    {
        $currency = $this->currencyService->findOneById($id);
        return success('show currency', 200, $currency->toArray());

    }

    /**
     * Store a newly created currency in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string',
            'code' => ['required', 'string'],
        ]);

        $currency = $this->currencyService->addCurrency($data['description'], $data['code']);

        return success('store currency', 200, $currency->toArray());

    }

    /**
     * Update the specified currency in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'description' => 'sometimes|string',
            'code' => ['sometimes', 'string'],
        ]);
        $currency = $this->currencyService->updateCurrency($id, $data);
        return success('update currency', 200, $currency->toArray());
    }

    /**
     * Remove the specified currency from storage.
     */
    public function delete(string $id)
    {
       $currency = $this->currencyService->deleteCurrency($id);
        return success('delete currency', 200, $currency->toArray());
    }
}
