<?php

namespace Turahe\Ledger\Providers;

use Illuminate\Support\ServiceProvider;

class LedgerServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([__DIR__.'/../../config/config.php' => 'ledger.php'], 'config');
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'ledger');
    }
}
