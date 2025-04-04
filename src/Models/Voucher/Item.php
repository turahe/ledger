<?php

namespace Turahe\Ledger\Models\Voucher;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Turahe\Ledger\Models\Voucher;
use Turahe\UserStamps\Concerns\HasUserStamps;

class Item extends Model
{
    use HasUlids;
    use HasUserStamps;

    public $dateFormat = 'U';

    protected $table = 'voucher_items';

    public function voucher(): BelongsTo
    {
        return $this->belongsTo(Voucher::class);

    }
}
