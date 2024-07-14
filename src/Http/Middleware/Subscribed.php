<?php

namespace Astrogoat\Cashier\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Astrogoat\Cashier\Models\BillableUser;
use Symfony\Component\HttpFoundation\Response;

class Subscribed
{
    public static string $notSubscribedRoute = 'billing-portal';
    public static string $notCustomerRoute = 'home';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ?string $plan = null): Response
    {
        if (! BillableUser::fromUser($request->user())?->stripeId()) {
            return redirect()->route(static::$notCustomerRoute);
        }

        if (! BillableUser::fromUser($request->user())?->subscribed()) {
            // Redirect user to billing page and ask them to subscribe...
            return redirect()->route(static::$notSubscribedRoute);
        }

        return $next($request);
    }
}
