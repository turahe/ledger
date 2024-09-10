<?php

namespace Turahe\Ledger\Models\Invoice;

use ALajusticia\Expirable\Traits\Expirable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Turahe\Ledger\Enums\PaymentMethods;
use Turahe\UserStamps\Concerns\HasUserStamps;

class Payment extends Pivot
{
    use Expirable;
    use HasUlids;
    use HasUserStamps;

    const EXPIRES_AT = 'payment_expires_at';

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
