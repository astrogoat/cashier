<?php

namespace Astrogoat\Cashier\Actions;

use Illuminate\Bus\PendingBatch;
use Astrogoat\Cashier\Jobs\SyncProducts;
use Helix\Lego\Apps\Actions\CustomAction;
use Helix\Lego\Http\Livewire\Traits\InteractsWithBatchJobs;

class SyncProductsAndPrices extends CustomAction
{
    use InteractsWithBatchJobs;

    public function actionName(): string
    {
        return $this->batchTitle();
    }

    public function batchTitle() : string
    {
        return 'Sync Products and Product Variants';
    }

    public function batchJobBroadcastChannel() : string
    {
        return 'astrogoat.shopify';
    }

    public function batchJobListeners() : array
    {
        return [
            '.job.cancelled',
            '.job.failed',
            '.job.completed',
        ];
    }

    public function batchJobs() : array
    {
        return [new SyncProducts];
    }

    public function batchJobSteps() : string
    {
        return SyncProductsSteps::class;
    }

    public function configureBatchJobs(PendingBatch $batch) : PendingBatch
    {
        return $batch->allowFailures();
    }
}
