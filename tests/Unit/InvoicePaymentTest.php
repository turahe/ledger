<?php

namespace Turahe\Ledger\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Turahe\Ledger\Models\Invoice;
use Turahe\Ledger\Models\Invoice\Payment as InvoicePayment;
use Turahe\Ledger\Models\Voucher;
use Turahe\Ledger\Tests\Models\User;
use Turahe\Ledger\Tests\TestCase;

class InvoicePaymentTest extends TestCase
{
    #[Test]
    public function it_can_create_the_invoice()
    {
        $user = User::factory()->create();
        $invoice = Invoice::factory()->create([
            'model_id' => $user->getKey(),
            'model_type' => $user->getMorphClass(),
        ]);
        $voucher = Voucher::factory()->create([
            'model_id' => $user->getKey(),
            'model_type' => $user->getMorphClass(),
        ]);

        InvoicePayment::create($data = [
            'invoice_id' => $invoice->getKey(),
            'receipt_id' => $voucher->getKey(),
            'currency' => 'USD',
            'amount' => 100,

        ]);

        $this->assertDatabaseHas('invoice_payments', $data);
    }
}
