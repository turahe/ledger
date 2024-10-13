<?php

namespace Turahe\Ledger\Tests\Unit;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Ledger\Enums\RecordEntry;
use Turahe\Ledger\Models\Invoice;
use Turahe\Ledger\Tests\Models\User;
use Turahe\Ledger\Tests\Models\Voucher;
use Turahe\Ledger\Tests\TestCase;

class InvoiceTest extends TestCase
{
    #[Test]
    public function it_can_create_the_invoice()
    {
        $user = User::factory()->create();
        $data = [
            'model_id' => $user->getKey(),
            'model_type' => $user->getMorphClass(),
            'code' => '1234567890',
            'shipping_provider_id' => 1,
            'shipping_fee' => 10,
            'insurance_provider_id' => 1,
            'insurance_fee' => 10,
            'transaction_fee' => 10,
            'currency' => 'IDR',
            'discount_voucher' => 10,
            'discount_amount' => 10,
            'tax_amount' => 1,
            'service_amount' => 1,
            'mdr_fee' => 1,
            'total_amount' => 120,
            'total_invoice' => 120,
            'total_unpaid' => 100,
            'total_payment' => 20,
            'total_change' => 100,
            'minimum_down_payment' => 100,
            'metadata' => null,
            'record_entry' => RecordEntry::In,
            'record_type' => RecordEntry::Credit,
            //            'issue_date' => now(),
            //            'due_date' => now()->addDays(30),
            'parent_id' => null,
        ];

        //        $voucher = DB::table('invoices')->insert($data);

        $voucher = Invoice::create($data);

        $this->assertDatabaseHas('invoices', $data);

        $this->assertEquals($data['code'], $voucher->code);
        //                $this->assertEquals($data['note'], $voucher->note);
        //                $this->assertEquals($data['total_unit'], $voucher->total_unit);
    }

    #[Test]
    public function it_can_delete_a_invoice()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);

        $deleted = $voucher->delete();

        $this->assertTrue($deleted);
        $this->assertSoftDeleted('users', [
            'id' => $voucher->id,
            'username' => $voucher->username,
            'email' => $voucher->email,
            'phone' => $voucher->phone,
        ]);
    }

    #[Test]
    public function it_errors_when_updating_the_invoice()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);
        $this->expectException(\Exception::class);

        $voucher->update(['username' => null]);
    }

    #[Test]
    public function it_can_update_the_invoice()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);

        $update = ['username' => 'username'];
        $updated = $voucher->update($update);

        $voucher = $voucher->getUsername($update['username']);

        $this->assertTrue($updated);
        $this->assertEquals($update['username'], $voucher->username);
    }

    #[Test]
    public function it_can_find_the_invoice()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);

        $found = User::find($voucher->id);

        $this->assertInstanceOf(User::class, $found);
        $this->assertEquals($voucher->username, $found->username);
    }

    #[Test]
    public function it_can_list_all_invoices()
    {
        $user = User::factory()->create();
        $vouchers = Voucher::factory(3)->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);

        $this->assertInstanceOf(Collection::class, $vouchers);
        $this->assertCount(3, $vouchers->all());
    }
}
