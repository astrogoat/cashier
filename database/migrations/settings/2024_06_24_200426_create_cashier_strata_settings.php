<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('cashier.enabled', false);
        $this->migrator->add('cashier.stripe_key', '');
        $this->migrator->addEncrypted('cashier.stripe_secret', '');
        $this->migrator->addEncrypted('cashier.stripe_webhook_secret', '');
    }

    public function down()
    {
        $this->migrator->delete('cashier.enabled');
        $this->migrator->delete('cashier.stripe_key');
        $this->migrator->delete('cashier.stripe_secret');
        $this->migrator->delete('cashier.stripe_webhook_secret');
    }
};
