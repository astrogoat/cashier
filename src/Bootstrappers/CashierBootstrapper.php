<?php

namespace Astrogoat\Cashier\Bootstrappers;

use Astrogoat\Cashier\Settings\CashierSettings;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\QueryException;
use Spatie\LaravelSettings\Exceptions\MissingSettings;
use Stancl\Tenancy\Contracts\TenancyBootstrapper;
use Stancl\Tenancy\Contracts\Tenant;

class CashierBootstrapper implements TenancyBootstrapper
{
    private array $originals;

    public function __construct(private Application $app)
    {
        $this->originals = [
            'key' => $this->app['config']['cashier.key'],
            'secret' => $this->app['config']['cashier.secret'],
            'path' => $this->app['config']['cashier.path'],
            'webhook' => [
                'secret' => $this->app['config']['cashier.webhook.secret'],
                'tolerance' => $this->app['config']['cashier.webhook.tolerance'],
            ],
            'currency' => $this->app['config']['cashier.currency'],
            'currency_locale' => $this->app['config']['cashier.currency_locale'],
            'payment_notification' => $this->app['config']['cashier.payment_notification'],
            'invoices' => [
                'options' => [
                    'paper' => $this->app['config']['cashier.invoices.options.paper'],
                ],
            ],
        ];
    }

    public function bootstrap(Tenant $tenant): void
    {
        try {
            $settings = resolve(CashierSettings::class);
            $this->app['config']['cashier.key'] = $settings->stripe_key;
            $this->app['config']['cashier.secret'] = $settings->stripe_secret;
            $this->app['config']['cashier.webhook.secret'] = $settings->stripe_webhook_secret;
        } catch (MissingSettings|QueryException $exception) { // For when running initial migration where the settings have not yet been added to the database
            return;
        }
    }

    public function revert(): void
    {
        $this->app['config']['cashier.key'] = $this->originals['key'];
        $this->app['config']['cashier.secret'] = $this->originals['secret'];
        $this->app['config']['cashier.webhook.secret'] = $this->originals['webhook']['secret'];
    }
}
