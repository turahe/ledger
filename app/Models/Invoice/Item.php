<?php

namespace Modules\Ledger\Models\Invoice;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Modules\Ledger\Models\Invoice;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 *
 *
 * @property string $id
 * @property string $invoice_id
 * @property string $model_type
 * @property string $model_id
 * @property string $quantity
 * @property string|null $unit
 * @property string|null $shipping_provider_id
 * @property float $shipping_fee
 * @property string|null $insurance_provider_id
 * @property float $insurance_fee
 * @property float $transaction_fee
 * @property string|null $discount_voucher
 * @property float $discount_amount
 * @property string $tax_amount amount is an decimal, it could be "dollars" or "cents"
 * @property string $service_amount amount is an decimal, it could be "dollars" or "cents"
 * @property string $mdr_fee amount is an decimal, it could be "dollars" or "cents"
 * @property string $currency
 * @property float $price_unit
 * @property float|null $price_cogs
 * @property string|null $metadata
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
 * @property-read Invoice|null $invoice
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDiscountAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDiscountVoucher($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereInsuranceFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereInsuranceProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereMdrFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePriceCogs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePriceUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereServiceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereShippingFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereShippingProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereTransactionFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasUlids;
    use HasUserStamps;

    public $dateFormat = 'U';

    protected $table = 'invoice_items';

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);

    }
}
