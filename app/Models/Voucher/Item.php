<?php

namespace Modules\Ledger\Models\Voucher;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Modules\Ledger\Models\Voucher;
use Sqits\UserStamps\Concerns\HasUserStamps;

/**
 *
 *
 * @property string $id
 * @property string $voucher_id
 * @property string $model_type
 * @property string $model_id
 * @property string $quantity
 * @property string|null $unit
 * @property string $value
 * @property string|null $record_type type can be anything in your app, by default we use "deposit" and "withdraw"
 * @property string|null $metadata
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
 * @property-read Voucher|null $voucher
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereMetadata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordRight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereRecordType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereVoucherId($value)
 * @mixin \Eloquent
 */
class Item extends Model
{
    use HasUlids;
    use HasUserStamps;

    public $dateFormat = 'U';

    protected $table = 'voucher_items';

    public function voucher()
    {
        return $this->belongsTo(Voucher::class);

    }
}
