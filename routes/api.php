<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MarketingNumberController;
use App\Http\Controllers\PaketUmrohController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getpaket', [PaketUmrohController::class, 'getPaket']);
Route::get('/marketing-numbers', [MarketingNumberController::class, 'apiIndex']);
Route::get('/marketing-numbers/{id}', [MarketingNumberController::class, 'apiShow']);
Route::get('/marketing-current', [MarketingNumberController::class, 'apiCurrent']);
Route::get('/banner', [BannerController::class, 'getBanner']);
Route::get('/faq', [FaqController::class, 'getFaq']);
Route::get('/testimoni', [TestimoniController::class, 'getTestimoni']);




