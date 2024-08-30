<?php

namespace Modules\Ledger\Models\Invoice;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Modules\Ledger\Enums\PaymentMethods;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 *
 *
 * @property string $id
 * @property string $invoice_id
 * @property string $receipt_id
 * @property string $currency
 * @property string $amount
 * @property string|null $payment_gateway
 * @property string|null $payment_method
 * @property string|null $payment_channel
 * @property float $payment_fee
 * @property string|null $payment_status_code
 * @property string|null $payment_status_message
 * @property int|null $payment_issued_at
 * @property int|null $payment_expires_at
 * @property string|null $metadata
 * @property string|null $created_by
 * @property string|null $updated_by
 * @property string|null $deleted_by
 * @property int|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Auth\Models\User|null $author
 * @property-read \Modules\Auth\Models\User|null $destroyer
 * @property-read \Modules\Auth\Models\User|null $editor
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentGateway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentIssuedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment wherePaymentStatusMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereReceiptId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedBy($value)
 * @mixin \Eloquent
 */
class Payment extends Pivot
{
    use HasUlids;
    use HasUserStamps;

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
