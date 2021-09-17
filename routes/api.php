<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\QuotationController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\QuotationLineController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/quotations', [\App\Http\Controllers\QuotationController::class, 'index']);
//Route::get('/quotations/{quotation}', [\App\Http\Controllers\QuotationController::class, 'show']);
//Route::post('/quotations', [\App\Http\Controllers\QuotationController::class, 'store']);
//Route::put('/quotations/{quotation}', [\App\Http\Controllers\QuotationController::class, 'update']);
//Route::delete('/quotations/{quotation}', [\App\Http\Controllers\QuotationController::class, 'delete']);


Route::apiResource('quotations', QuotationController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('quotationlines', QuotationLineController::class);

Route::get('/quotationcalculatecost/{quotation}', [QuotationController::class, 'calculatecost']);
Route::get('/quotationgetlines/{quotation}', [QuotationController::class, 'getlines']);
