<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Astrogoat\Cashier\Models\BillableUser;
use Laravel\Cashier\Exceptions\InvalidCustomer;
use Astrogoat\Cashier\Http\Controllers\CheckoutController;

Route::get('/billing-portal', function (Request $request) {
    try {
        return BillableUser::fromUser($request->user())->redirectToBillingPortal();
    } catch (InvalidCustomer $exception) {
        return redirect()->route('home')->with('error', 'No billing information found. Please contact support.');
    }
})->middleware(['auth'])->name('billing-portal');

Route::group([
    'prefix' => 'checkout',
    'as' => 'cashier.'
], function () {
    Route::get('success', [CheckoutController::class, 'success'])
        ->name('checkout.success');

    Route::get('cancelled', [CheckoutController::class, 'cancelled'])
        ->name('checkout.cancelled');

    Route::get('{price}', [CheckoutController::class, 'checkout'])
        ->name('checkout');
});
