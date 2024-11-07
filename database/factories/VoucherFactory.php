<?php

namespace Turahe\Ledger\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Ledger\Models\Voucher;

class VoucherFactory extends Factory
{
    protected $model = Voucher::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->ean8(),
            'note' => $this->faker->sentence,
            'total_unit' => $this->faker->randomFloat(2, 10),
            'total_value' => $this->faker->randomFloat(2, 10),
        ];
    }
}
