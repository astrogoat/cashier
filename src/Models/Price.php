<?php

namespace Astrogoat\Cashier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Price extends Model
{
    protected $casts = [
        'active' => 'boolean',
        'livemode' => 'boolean',
        'allow_promotions' => 'boolean',
    ];

    protected $guarded = [];

    protected $table = 'stripe_prices';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getNameAttribute(): string
    {
        return match (true) {
            filled($this->getAttribute('nickname')) => $this->getAttribute('nickname'),
            filled($this->getAttribute('lookup_key')) => $this->getAttribute('lookup_key'),
            default => $this->getAttribute('stripe_id'),
        };
    }

    public function isRecurring(): bool
    {
        return $this->type === 'recurring';
    }

    public function checkoutSuccessRoute(): string
    {
        if (filled($this->checkout_success_route)) {
            return $this->checkout_success_route;
        }

        return route('cashier.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
    }

    public function checkoutCancelledRoute(): string
    {
        if (filled($this->checkout_cancelled_route)) {
            return $this->checkout_cancelled_route;
        }

        return route('cashier.checkout.success').'?session_id={CHECKOUT_SESSION_ID}';
    }
}
