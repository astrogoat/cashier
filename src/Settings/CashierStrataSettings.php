<?php

namespace Astrogoat\CashierStrata\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;

class CashierStrataSettings extends AppSettings
{
    // public string $url; // Example, modify to fit your need.

    public function rules(): array
    {
        //        'url' => Rule::requiredIf($this->enabled === true), // Example, modify to fit your need.
    }

    public function description(): string
    {
        return 'Interact with CashierStrata.';
    }

    public static function group(): string
    {
        return 'cashier-strata';
    }
}
