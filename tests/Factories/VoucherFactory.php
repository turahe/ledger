<?php

namespace Turahe\Ledger\Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Ledger\Tests\Models\Voucher;

class VoucherFactory extends Factory
{

    protected $model = Voucher::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->ean8(),
            'note' => $this->faker->sentence,
            'total_unit' => $this->faker->randomFloat(2, 10),
            'total_value' => $this->faker->randomFloat(2, 10),
            'record_entry' => $this->faker->randomElement(['IN', 'OUT']),
            'record_type' => $this->faker->randomElement(['CREDIT', 'DEBIT']),
        ];
    }
}