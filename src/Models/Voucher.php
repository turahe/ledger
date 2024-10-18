<?php

namespace Turahe\Ledger\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Turahe\Ledger\Models\Voucher\Item;

class Voucher extends Model
{
    use HasUlids;

    const EXPIRES_AT = 'due_date';

    /**
     * @var string
     */
    public $dateFormat = 'U';

    protected $fillable = [
        'model_id',
        'model_type',
        'code',
        'note',
        'total_unit',
        'total_value',
        'issue_date',
        'due_date',
    ];

    /**
     * @return string[]
     */
    protected function casts(): array
    {
        return [
            'metadata' => 'object',
            'due_date' => 'datetime',
            'issue_date' => 'datetime',
        ];
    }

    public function shipping_provider(): BelongsTo
    {
        return $this->belongsTo(config('ledger.shipping_provider'), 'shipping_provider_id');
    }

    public function insurance_provider(): BelongsTo
    {
        return $this->belongsTo(config('ledger.insurance_provider'), 'insurance_provider_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'voucher_id');
    }

    public function payments(): BelongsToMany
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
