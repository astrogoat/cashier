<?php

namespace Astrogoat\CashierStrata;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Astrogoat\CashierStrata\CashierStrata
 */
class CashierStrataFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cashier-strata';
    }
}
