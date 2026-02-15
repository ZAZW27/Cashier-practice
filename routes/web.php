<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdukController; 
use App\Http\Controllers\CheckoutController; 

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/produks', [ProdukController::class, 'index'])->name('produk.index'); 
Route::get('/produks/{produk}', [ProdukController::class, 'show'])->name('produk.show'); 
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); 
require __DIR__.'/settings.php';
