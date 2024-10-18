<?php

namespace Turahe\Ledger\Models\Invoice;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Turahe\Ledger\Enums\PaymentMethods;

class Payment extends Pivot
{
    use HasUlids;

    public $dateFormat = 'U';

    protected $table = 'invoice_payments';

    protected function casts(): array
    {
        return [
            'payment_method' => PaymentMethods::class,
            'payment_expires_at' => 'datetime',
            'payment_issued_at' => 'datetime',
        ];
    }
}
