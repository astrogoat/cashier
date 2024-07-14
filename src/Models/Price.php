<?php

namespace Astrogoat\Cashier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Price extends Model
{
    protected $casts = [
        'active' => 'boolean',
        'livemode' => 'boolean',
    ];

    protected $guarded = [];

    protected $table = 'stripe_prices';

    public function getNameAttribute(): string
    {
        return match (true) {
            filled($this->getAttribute('nickname')) => $this->getAttribute('nickname'),
            filled($this->getAttribute('lookup_key')) => $this->getAttribute('lookup_key'),
            default => $this->getAttribute('stripe_id'),
        };
    }
}
