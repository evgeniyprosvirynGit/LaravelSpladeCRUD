<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

Route::get('/products/create', [ProductsController::class, 'create'])
    ->name('products.create');

Route::post('/products/store', [ProductsController::class, 'store'])
    ->name('products.store');

Route::get('/products/{product}/edit', [ProductsController::class, 'edit'])
    ->name('products.edit');

Route::post('/products/{product}/update', [ProductsController::class, 'update'])
    ->name('products.update');

Route::get('/products', [ProductsController::class, 'index'])
    ->name('products.index');

Route::get('/products/{product}', [ProductsController::class, 'show'])
    ->name('products.show');

Route::post('/products/{product}/delete', [ProductsController::class, 'destroy'])
    ->name('products.destroy');