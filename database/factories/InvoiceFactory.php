<?php

namespace Turahe\Ledger\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Ledger\Models\Invoice;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition(): array
    {
        $total = $this->faker->randomFloat(2, 10, 100);

        return [
            'code' => $this->faker->imei,
            'currency' => $this->faker->currencyCode(),
            'issue_date' => now(),
            'due_date' => now()->addDay(),
            'total_amount' => $total,
            'total_invoice' => $total,
            'total_unpaid' => $total,
            'total_payment' => $total,
        ];
    }
}
