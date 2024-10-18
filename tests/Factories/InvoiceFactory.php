<?php

namespace Turahe\Ledger\Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Ledger\Tests\Models\Invoice;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition()
    {
        return [
            'code' => $this->faker->imei,
            'currency' => $this->faker->currencyCode(),
            'issue_date' => now(),
            'due_date' => now()->addDay(),
        ];
    }
}
