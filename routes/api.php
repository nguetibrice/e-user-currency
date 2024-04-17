<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("/app-version",function (Request $request) {
    $version = json_decode(file_get_contents(base_path("composer.json")), true)["version"];
    return response(["version" => $version]);
});

Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
Route::get('/currency/show/{id}', [CurrencyController::class, 'show'])->name('currency.show');
Route::post('/currency/store', [CurrencyController::class, 'store'])->name('currency.store');
Route::delete('/currency/delete/{id}', [CurrencyController::class, 'delete'])->name('currency.delete');
