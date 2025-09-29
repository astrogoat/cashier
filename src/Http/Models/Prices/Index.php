<?php

namespace Astrogoat\Cashier\Http\Models\Prices;

use Helix\Lego\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Astrogoat\Cashier\Models\Price;
use Helix\Lego\Http\Livewire\Models\Index as BaseIndex;

class Index extends BaseIndex
{
    public array $casts = ['roles' => 'array'];

    public function model(): string
    {
        return Price::class;
    }

    public function columns(): array
    {
        return [
            'stripe_id' => 'Name',
            'updated_at' => 'Last updated',
        ];
    }

    public function mainSearchColumn(): string|false
    {
        return 'stripe_id';
    }

//    public function scopeRoles($query, $value)
//    {
//        return $query->whereHas('roles', function ($query) use ($value) {
//            $query->where('name', 'LIKE', '%' . $value . '%');
//        });
//    }

    public function render()
    {
        return view('cashier-strata::models.prices.index', [
            'models' => $this->getModels(),
        ])->extends('lego::layouts.lego')->section('content');
    }
}
