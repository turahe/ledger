<?php

namespace Turahe\Ledger\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Turahe\Ledger\Models\Invoice\Item;
use Turahe\UserStamps\Concerns\HasUserStamps;

class Invoice extends Model
{
    use HasUlids;
    use HasUserStamps;

    /**
     * @var string
     */
    protected $table = 'invoices';

    /**
     * @var string
     */
    public $dateFormat = 'U';

    /**
     * @var string[]
     */
    protected $fillable = [
        'model_id',
        'model_type',
        'code',
        'shipping_provider_id',
        'shipping_fee',
        'insurance_provider_id',
        'insurance_fee',
        'transaction_fee',
        'currency',
        'discount_voucher',
        'discount_amount',
        'tax_amount',
        'service_amount',
        'mdr_fee',
        'total_amount',
        'total_invoice',
        'total_unpaid',
        'total_payment',
        'total_change',
        'minimum_down_payment',
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
            'shipping_fee' => 'float',
            'insurance_fee' => 'float',
            'transaction_fee' => 'float',
            'service_fee' => 'float',
            'discount_voucher' => 'float',
            'discount_amount' => 'float',
            'tax_amount' => 'float',
            'service_amount' => 'float',
            'mdr_fee' => 'float',
            'total_invoice' => 'float',
            'total_amount' => 'float',
            'total_payment' => 'float',
            'minimum_down_payment' => 'float',
        ];
    }

    public function items(): HasMany
    {
        return $this->hasMany(Item::class, 'invoice_id', 'id');

    }

    public function customer()
    {
        return $this->author();

    }

    public function payments(): BelongsToMany
    {
        return $this->belongsToMany(
            Voucher::class,
            'invoice_payments',
            'invoice_id',
            'receipt_id'
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
