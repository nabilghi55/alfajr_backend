<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\MarketingNumberController;
use App\Http\Controllers\PaketUmrohController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/paket', [PaketUmrohController::class, 'index'])->name('paket.index');
    Route::resource('marketing', MarketingNumberController::class);
    Route::resource('paket', PaketUmrohController::class)->except(['show']);
    Route::resource('testimoni', TestimoniController::class)->only([
        'index',
        'create',
        'store',
        'destroy'
    ]);
    Route::resource('faq', FaqController::class)->only([
        'index',
        'create',
        'store',
        'destroy'
    ]);
    Route::resource('banner', BannerController::class)->middleware('auth');


    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
