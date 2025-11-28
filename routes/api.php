<?php

use App\Http\Controllers\MarketingNumberController;
use App\Http\Controllers\PaketUmrohController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getpaket', [PaketUmrohController::class, 'getPaket']);
Route::get('/marketing-numbers', [MarketingNumberController::class, 'apiIndex']);
Route::get('/marketing-numbers/{id}', [MarketingNumberController::class, 'apiShow']);
Route::get('/marketing-current', [MarketingNumberController::class, 'apiCurrent']);