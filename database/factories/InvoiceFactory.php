<?php

namespace Turahe\Ledger\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Ledger\Models\Invoice;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->imei,
            'currency' => $this->faker->currencyCode(),
            'issue_date' => now(),
            'due_date' => now()->addDay(),
        ];
    }
}
