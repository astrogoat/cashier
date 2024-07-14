<?php

namespace Astrogoat\Cashier\Jobs;

use Astrogoat\Cashier\Models\Product;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Stripe\Product as StripeProduct;

class ProcessProduct implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    use Batchable;

    public function __construct(private readonly StripeProduct $product)
    {
    }

    public function handle(): void
    {
        Product::query()->updateOrCreate([
            'stripe_id' => $this->product->id,
        ], [
            'name' => $this->product->name,
            'description' => $this->product->description,
            'active' => $this->product->active,
            'default_price' => $this->product->default_price,
            'livemode' => $this->product->livemode,
            'type' => $this->product->type,
            'created_at' => Carbon::parse($this->product->created),
            'updated_at' => Carbon::parse($this->product->updated),
        ]);
    }
}
