<?php

namespace Modules\Ledger\Enums;

enum RecordEntry: string
{
    case Credit = 'CREDIT';

    case Debit = 'DEBIT';

    case In = 'IN';

    case Out = 'OUT';
}
