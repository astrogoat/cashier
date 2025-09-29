<?php

namespace Astrogoat\Cashier\Http\Models\Prices;

use Astrogoat\Cashier\Models\Price;
use Helix\Lego\Http\Livewire\Models\Form as BaseForm;

class Form extends BaseForm
{
    protected bool $canBeViewed = false;
    protected bool $canBeDeleted = false;

    public function rules()
    {
        return [
            'model.stripe_id' => 'required',
            'model.checkout_success_route' => 'required',
//            'model.slug' => [new SlugRule($this->model)],
//            'model.meta.description' => 'nullable',
//            'model.indexable' => 'nullable',
//            'model.canonical_page_id' => 'nullable',
//            'model.layout' => 'nullable',
//            'model.footer_id' => 'nullable',
//            'model.published_at' => 'nullable',
//            'model.is_landing_page' => 'boolean',
//            'model.category' => 'nullable',
        ];
    }

    public function mount($price = null)
    {
        $this->setModel($price);
    }

    public function view(): string
    {
        return 'cashier-strata::models.prices.form';
    }

    public function model(): string
    {
        return Price::class;
    }
}
