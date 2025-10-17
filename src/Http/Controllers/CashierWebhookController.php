<?php

namespace Astrogoat\Cashier\Http\Controllers;

use Laravel\Cashier\Http\Controllers\WebhookController;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;

class CashierWebhookController extends WebhookController
{
    public function __construct()
    {
        $this->middleware(InitializeTenancyByDomain::class);

        parent::__construct();
    }
}
