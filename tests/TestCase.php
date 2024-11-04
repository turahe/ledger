<?php

namespace Turahe\Ledger\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Turahe\Ledger\Tests\Models\Organization;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->setUpDatabase($this->app);

    }

    protected function getPackageProviders($app)
    {
        return [
            \Turahe\Ledger\Providers\LedgerServiceProvider::class,
            \Turahe\UserStamps\UserStampsServiceProvider::class,
        ];
    }

    /**
     * @param  \Illuminate\Foundation\Application  $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('users_table_column_type', 'ulid');
        $app['config']->set('ledger.shipping_provider', Organization::class);
        $app['config']->set('ledger.insurance_provider', Organization::class);
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
        $app['config']->set('app.key', 'base64:MFOsOH9RomiI2LRdgP4hIeoQJ5nyBhdABdH77UY2zi8=');
    }

    protected function setUpDatabase($app)
    {
        $app['db.schema']->create('users', function ($table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone')->unique()->nullable();

            $table->timestamps();
        });

        $app['db.schema']->create('organizations', function ($table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        $app['db.schema']->create('products', function ($table) {
            $table->increments('id');
            $table->timestamps();
        });
    }
}
