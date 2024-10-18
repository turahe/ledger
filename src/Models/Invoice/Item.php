<?php

namespace Turahe\Ledger\Models\Invoice;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Turahe\Ledger\Models\Invoice;

class Item extends Model
{
    use HasUlids;

    public $dateFormat = 'U';

    protected $table = 'invoice_items';

    protected $fillable = [
        'model_id',
        'model_type',
        'quantity',
        'shipping_provider_id',
        'shipping_fee',
        'insurance_provider_id',
        'insurance_fee',
        'transaction_fee',
        'discount_voucher',
        'discount_amount',
        'tax_amount',
        'service_amount',
        'mdr_fee',
        'currency',
        'price_unit',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');

    }
}
