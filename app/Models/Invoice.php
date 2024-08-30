<?php

namespace Modules\Ledger\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Modules\Ledger\Models\Invoice\Item;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 *
 *
 * @property string $id
 * @property string $model_type
 * @property string $model_id
 * @property string $code
 * @property string|null $shipping_provider_id
 * @property float $shipping_fee
 * @property string|null $insurance_provider_id
 * @property float $insurance_fee
 * @property float $transaction_fee
 * @property string|null $discount_voucher
 * @property float $discount_amount
 * @property string $currency
 * @property \Illuminate\Support\Carbon|null $issue_date
 * @property \Illuminate\Support\Carbon|null $due_date
 * @property string $tax_amount amount is an decimal, it could be "dollars" or "cents"
 * @property string $service_amount amount is an decimal, it could be "dollars" or "cents"
 * @property string $mdr_fee amount is an decimal, it could be "dollars" or "cents"
 * @property string $total_amount amount is an decimal, it could be "dollars" or "cents"
 * @property string $total_invoice amount is an decimal, it could be "dollars" or "cents"
 * @property string $total_payment amount is an decimal, it could be "dollars" or "cents"
 * @property string $total_unpaid amount is an decimal, it could be "dollars" or "cents"
 * @property string $total_change amount is an decimal, it could be "dollars" or "cents"
 * @property string $minimum_down_payment amount is an decimal, it could be "dollars" or "cents"
 * @property object|null $metadata
 * @property string $record_entry
 * @property string|null $record_type type can be anything in your app, by default we use "deposit" and "withdraw"
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Item> $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Ledger\Models\Voucher> $payments
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDiscountVoucher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInsuranceFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereInsuranceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereIssueDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereMdrFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereMinimumDownPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRecordEntry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRecordLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRecordOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRecordRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereRecordType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereServiceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereShippingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalChange($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalPayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotalUnpaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTransactionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Invoice extends Model
{
    use HasUlids;
    use HasUserStamps;

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
        'metadata',
        'record_entry',
        'record_type',
        'record_status',
        'issue_date',
        'due_date',
        'parent_id',
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class, 'invoice_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payments()
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
