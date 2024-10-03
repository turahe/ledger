<?php

namespace Turahe\Ledger\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Turahe\Ledger\Tests\Factories\InvoiceFactory;
use Turahe\Ledger\Tests\Factories\OrganizationFactory;

class Invoice extends \Turahe\Ledger\Models\Invoice
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return InvoiceFactory
     */
    protected static function newFactory()
    {
        return new InvoiceFactory();
    }

}