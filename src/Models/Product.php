<?php

namespace Astrogoat\Cashier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $casts = [
        'active' => 'boolean',
        'livemode' => 'boolean',
    ];

    protected $guarded = [];

    protected $table = 'stripe_products';

    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
