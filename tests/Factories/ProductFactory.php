<?php

namespace Turahe\Ledger\Tests\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Ledger\Tests\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [];
    }
}
