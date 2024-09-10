<?php

namespace Turahe\Ledger\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Turahe\Ledger\Enums\RecordEntry;
use Turahe\Ledger\Models\Voucher\Item;
use Turahe\User\Models\Organization;
use Sqits\UserStamps\Concerns\HasUserStamps;

class Voucher extends Model
{
    use HasUlids;
    use HasUserStamps;

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

    /**
     * @return BelongsTo
     */
    public function shipping_provider(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'shipping_provider_id');
    }

    /**
     * @return BelongsTo
     */
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
