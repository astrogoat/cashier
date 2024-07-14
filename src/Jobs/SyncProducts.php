<?php

namespace Astrogoat\Cashier\Jobs;

//use Astrogoat\Shopify\Jobs\DeleteProduct;
//use Astrogoat\Shopify\Jobs\ProcessProduct;
//use Astrogoat\Shopify\Jobs\DeleteProductVariant;
//use Astrogoat\Shopify\Events\ShopifyJobCancelled;
//use Astrogoat\Shopify\Events\ShopifyJobFailed;
//use Astrogoat\Cashier\Cashier;
use Laravel\Cashier\Cashier;
use Astrogoat\Cashier\Actions\SyncProductsAndPrices as SyncProductsAction;
use Astrogoat\Cashier\Actions\SyncProductsSteps;
//use Astrogoat\Shopify\Models\Product;
//use Astrogoat\Shopify\Models\ProductVariant;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Throwable;

class SyncProducts implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function handle()
    {
        if ($this->batch()?->cancelled()) {
            return;
        }


        $this->batch()->add(SyncProductsAction::batchJobStep(SyncProductsSteps::IMPORTING_PRICES, $this->batch()->id));
        $this->batch()->add(collect(Cashier::stripe()->prices->all()->data)->mapInto(ProcessPrice::class));
        $this->batch()->add(SyncProductsAction::batchJobStep(SyncProductsSteps::IMPORTING_PRODUCTS, $this->batch()->id));
        $this->batch()->add(collect(Cashier::stripe()->products->all()->data)->mapInto(ProcessProduct::class));
        $this->batch()->add(SyncProductsAction::batchJobStep(SyncProductsSteps::SYNCING, $this->batch()->id));
    }

    public function tags()
    {
        return [
            'tenant:' . tenant('id'),
        ];
    }
}
