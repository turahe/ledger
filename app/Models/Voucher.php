<?php

namespace Modules\Ledger\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ledger\Enums\RecordEntry;
use Modules\Ledger\Models\Voucher\Item;
use Modules\User\Models\Organization;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 *
 *
 * @property string $id
 * @property string $model_type
 * @property string $model_id
 * @property string $code
 * @property string|null $note
 * @property string|null $total_unit
 * @property string $total_value amount is an decimal, it could be "dollars" or "cents"
 * @property \Illuminate\Support\Carbon|null $issue_date
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property string $record_entry
 * @property string|null $record_type type can be anything in your app, by default we use "deposit" and "withdraw"
 * @property object|null $metadata
 * @property int|null $record_left
 * @property int|null $record_right
 * @property int|null $record_ordering
 * @property string|null $parent_id
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property int|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Auth\Models\User|null $author
 * @property-read \Modules\Auth\Models\User|null $destroyer
 * @property-read \Modules\Auth\Models\User|null $editor
 * @property-read \Modules\User\Models\Organization|null $insurance_provider
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ledger\Models\Invoice> $payments
 * @property-read int|null $payments_count
 * @property-read \Modules\User\Models\Organization|null $shipping_provider
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereRecordEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereRecordLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereRecordOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereRecordRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereRecordType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereTotalUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereTotalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voucher whereUpdatedBy($value)
 * @mixin \Eloquent
 */
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
