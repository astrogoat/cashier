<?php

namespace Astrogoat\Cashier\Jobs;

use Astrogoat\Cashier\Models\Price;
use Astrogoat\Cashier\Models\Product;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Laravel\Cashier\Cashier;
use Stripe\Price as StripePrice;

class ProcessPrice implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    public function __construct(private readonly StripePrice $price)
    {
    }

    public function handle(): void
    {
        $stripeProduct = Cashier::stripe()->products->retrieve($this->price->product);
        ProcessProduct::dispatchSync($stripeProduct);

        $product = Product::where('stripe_id', $this->price->product)->first();

        Price::query()->updateOrCreate([
            'stripe_id' => $this->price->id,
        ], [
            'product_id' => $product->id,
            'active' => $this->price->active,
            'currency' => $this->price->currency,
            'lookup_key' => $this->price->lookup_key,
            'nickname' => $this->price->nickname,
            'livemode' => $this->price->livemode,
            'type' => $this->price->type,
            'unit_amount' => $this->price->unit_amount,
            'created_at' => Carbon::parse($this->price->created),
            'updated_at' => Carbon::parse($this->price->created),
        ]);
    }
}
