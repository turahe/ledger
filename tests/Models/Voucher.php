<?php

namespace Turahe\Ledger\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Turahe\Ledger\Tests\Factories\UserFactory;
use Turahe\Ledger\Tests\Factories\VoucherFactory;

class Voucher extends \Turahe\Ledger\Models\Voucher
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return VoucherFactory
     */
    protected static function newFactory()
    {
        return new VoucherFactory();
    }

}