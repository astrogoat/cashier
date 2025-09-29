<?php

use Illuminate\Support\Facades\Route;
use Astrogoat\Cashier\Http\Models;

Route::get('/cashier/products/', function () {
    return 'products';
})->name('cashier.products.index');

Route::group([
    'prefix' => 'cashier',
    'as' => 'cashier.'
], function () {
    Route::get('prices', Models\Prices\Index::class)->name('prices.index');
    Route::get('prices/{price}', Models\Prices\Form::class)->name('prices.form');
});
