<?php

namespace Turahe\Ledger\Models;

use ALajusticia\Expirable\Traits\Expirable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Turahe\Ledger\Enums\RecordEntry;
use Turahe\Ledger\Models\Voucher\Item;
use Turahe\UserStamps\Concerns\HasUserStamps;

class Voucher extends Model implements Sortable
{
    use Expirable;
    use HasUlids;
    use HasUserStamps;
    use \Kalnoy\Nestedset\NodeTrait;
    use SoftDeletes;
    use SortableTrait;

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
        'record_entry',
        'record_type',
    ];

    /**
     * @return string
     */
    public function getLftName()
    {
        return 'record_left';
    }

    /**
     * @return string
     */
    public function getRgtName()
    {
        return 'record_right';
    }

    /**
     * @return string
     */
    public function getParentIdName()
    {
        return 'parent_id';
    }

    /**
     * Specify parent id attribute mutator
     *
     * @return void
     *
     * @throws \Exception
     */
    public function setParentAttribute($value)
    {
        $this->setParentIdAttribute($value);
    }

    public $sortable = [
        'order_column_name' => 'record_ordering',
        'sort_when_creating' => true,
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
            'record_entry' => RecordEntry::class,
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
