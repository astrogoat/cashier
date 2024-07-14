<?php

namespace Astrogoat\Cashier\Actions;

use Helix\Lego\Http\Livewire\BatchJobs\Contracts\HasBatchableSteps;

enum SyncProductsSteps: string implements HasBatchableSteps
{
    case FETCHING = 'Fetching';
    case IMPORTING_PRICES = 'Importing Prices';
    case IMPORTING_PRODUCTS = 'Importing Products';
    case SYNCING = 'Syncing';
    case FINISHED = 'Finished';

    public static function order(): array
    {
        return [
            SyncProductsSteps::FETCHING,
            SyncProductsSteps::IMPORTING_PRICES,
            SyncProductsSteps::IMPORTING_PRODUCTS,
            SyncProductsSteps::SYNCING,
            SyncProductsSteps::FINISHED,
        ];
    }

    public function description(): string
    {
        return match ($this) {
            self::FETCHING => 'Fetching all products from Stripe...',
            self::IMPORTING_PRICES => 'Importing prices from Stripe...',
            self::IMPORTING_PRODUCTS => 'Importing products from Stripe...',
            self::SYNCING => 'Removing old products and variants that no longer exists...',
            self::FINISHED => 'All done!',
        };
    }
}
