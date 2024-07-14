<?php

namespace Astrogoat\Cashier;

use Astrogoat\Cashier\Actions\SyncProductsAndPrices;
use Astrogoat\Cashier\Bootstrappers\CashierBootstrapper;
use Astrogoat\Cashier\Models\BillableUser;
use Astrogoat\Cashier\Models\Price;
use Astrogoat\Cashier\Models\Product;
use Astrogoat\Cashier\Providers\RouteServiceProvider;
use Astrogoat\Cashier\Settings\CashierSettings;
use Helix\Fabrick\Icon;
use Helix\Lego\Apps\App;
use Helix\Lego\Apps\AppPackageServiceProvider;
use Helix\Lego\Menus\Lego\Group;
use Helix\Lego\Menus\Lego\Link;
use Helix\Lego\Menus\Menu;
use Laravel\Cashier\Cashier;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;

class CashierServiceProvider extends AppPackageServiceProvider
{
    public function registerApp(App $app): App
    {
        return $app
            ->name('cashier-strata')
            ->settings(CashierSettings::class)
            ->models([
                Product::class,
                Price::class,
            ])
            ->menu(function (Menu $menu) {
                $menu->addToSection(
                    Menu::MAIN_SECTIONS['PRIMARY'],
                    Group::add(
                        'E-commerce',
                        [
                            Link::to(route('lego.cashier.products.index'), 'Products')->icon(Icon::SHOPPING_BAG),
                            Link::to(route('lego.cashier.prices.index'), 'Prices')->icon(Icon::RECEIPT_TAX),
                        ],
                        Icon::SHOPPING_CART,
                    )->after('Pages'),
                );
            })
            ->migrations([
                __DIR__ . '/../database/migrations',
                __DIR__ . '/../database/migrations/settings',
            ])
            ->bootstrappers([
                CashierBootstrapper::class,
            ])
            ->backendRoutes(__DIR__.'/../routes/backend.php')
            ->frontendRoutes(__DIR__.'/../routes/frontend.php');
    }

    public function configurePackage(Package $package): void
    {
        $package->name('cashier-strata')->hasConfigFile()->hasViews();
    }

    public function registeringPackage(): void
    {
        parent::registeringPackage();

        $this->app->register(RouteServiceProvider::class);
    }

    public function bootingPackage(): void
    {
        Cashier::useCustomerModel(BillableUser::class);

        Livewire::component('astrogoat.cashier.actions.sync-products-and-prices', SyncProductsAndPrices::class);
    }
}
