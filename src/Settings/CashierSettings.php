<?php

namespace Astrogoat\Cashier\Settings;

use Helix\Lego\Settings\AppSettings;
use Illuminate\Validation\Rule;
use Astrogoat\Cashier\Actions\SyncProductsAndPrices;

class CashierSettings extends AppSettings
{
     public string $stripe_key;
     public string $stripe_secret;
     public string $stripe_webhook_secret;

     protected static array $actions = [
         SyncProductsAndPrices::class,
     ];

    public static function encrypted(): array
    {
        return ['stripe_secret', 'stripe_webhook_secret'];
    }

    public function rules(): array
    {
        return [
            'stripe_key' => Rule::requiredIf($this->enabled === true),
            'stripe_secret' => Rule::requiredIf($this->enabled === true),
            'stripe_webhook_secret' => Rule::requiredIf($this->enabled === true),
        ];
    }

    public function description(): string
    {
        return 'Interact with Cashier.';
    }

    public static function group(): string
    {
        return 'cashier';
    }
}
