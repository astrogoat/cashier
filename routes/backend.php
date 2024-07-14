<?php

use Illuminate\Support\Facades\Route;

Route::get('/cashier/products/', function () {
    return 'products';
})->name('cashier.products.index');

Route::get('/cashier/prices/', function () {
    return 'prices';
})->name('cashier.prices.index');
