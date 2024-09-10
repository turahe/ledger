<?php

namespace Turahe\Ledger\Models;

use ALajusticia\Expirable\Traits\Expirable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Turahe\Ledger\Enums\RecordEntry;
use Turahe\Ledger\Models\Voucher\Item;
use Turahe\User\Models\Organization;
use Turahe\UserStamps\Concerns\HasUserStamps;

class Voucher extends Model
{
    use Expirable;
    use HasUlids;
    use HasUserStamps;

    const EXPIRES_AT = 'due_date';

    /**
     * @var string
     */
    public $dateFormat = 'U';

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'metadata' => 'object',
            'due_date' => 'datetime',
            'issue_date' => 'datetime',
            'record_entry' => RecordEntry::class,
        ];
    }

    public function shipping_provider(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'shipping_provider_id');
    }

    public function insurance_provider(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'insurance_provider_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'voucher_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payments()
    {
        return $this->belongsToMany(
            Invoice::class,
            'invoice_payments',
            'receipt_id',
            'invoice_id',
        )->withPivot([
            'currency',
            'amount',
            'payment_gateway',
            'payment_method',
            'payment_channel',
            'payment_fee',
            'payment_status_code',
            'payment_status_message',
            'payment_issued_at',
            'payment_expires_at',
            'metadata',
        ]);

    }
}
