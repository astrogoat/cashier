<?php

namespace Astrogoat\Cashier\Providers;

use Astrogoat\Cashier\Http\Middleware\Subscribed;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as BaseRouteServiceProvider;

class RouteServiceProvider extends BaseRouteServiceProvider
{
    public function register(): void
    {
        $this->aliasMiddleware('subscribed', Subscribed::class);
    }
}
