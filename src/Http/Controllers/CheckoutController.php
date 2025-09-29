<?php

namespace Astrogoat\Cashier\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Checkout;
use Astrogoat\Cashier\Models\Price;
use Astrogoat\Cashier\Models\BillableUser;
use Astrogoat\Monologues\Settings\MonologuesSettings;

class CheckoutController
{
    public function checkout(Request $request, Price $price)
    {
        return Checkout::guest()
            ->create($price->stripe_id, [
                'success_url' => $price->checkoutSuccessRoute(),
                'cancel_url' => $price->checkoutCancelledRoute(),
                'allow_promotion_codes' => $price->allow_promotions,
            ]);
    }

    public function success(Request $request)
    {
        dd($request->all());
    }

    public function cancelled(Request $request)
    {
        dd($request->all());
    }
}
