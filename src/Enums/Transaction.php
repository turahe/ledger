<?php

namespace Turahe\Ledger\Enums;

enum Transaction: string
{
    const Deposit = 'DEPOSIT';

    const Withdraw = 'WITHDRAW';
}
