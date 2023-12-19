<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/products', [ProductController::class, 'products']);
Route::get('/add', [ProductController::class, 'add']);
Route::patch('/products/{id}/update-price', [ProductController::class, 'updatePrice'])
    ->name('updatePrice');
Route::post('sell', [ProductController::class, 'sell']);
Route::get('/transactions', [TransactionController::class, 'index']);

