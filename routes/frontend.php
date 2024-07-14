<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Astrogoat\Cashier\Models\BillableUser;

Route::get('/billing-portal', function (Request $request) {
    return BillableUser::fromUser($request->user())->redirectToBillingPortal();
})->middleware(['auth'])->name('billing-portal');
