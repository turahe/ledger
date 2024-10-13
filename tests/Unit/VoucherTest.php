<?php

namespace Turahe\Ledger\Tests\Unit;

use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Turahe\Ledger\Enums\RecordEntry;
use Turahe\Ledger\Tests\Models\User;
use Turahe\Ledger\Tests\Models\Voucher;
use Turahe\Ledger\Tests\TestCase;

class VoucherTest extends TestCase
{
    #[Test]
    public function it_can_create_the_voucher()
    {
        $user = User::factory()->create();
        $data = [
            'model_id' => $user->getKey(),
            'model_type' => $user->getMorphClass(),
            'code' => '1212323212',
            'note' => $this->faker->sentence,
            'total_unit' => $this->faker->randomDigitNotNull,
            'total_value' => $this->faker->randomDigitNotNull,
            //            'issue_date' => $this->faker->date(),
            //            'due_date' => now(),
            'record_entry' => RecordEntry::In,
            'record_type' => RecordEntry::Credit,
        ];

        $voucher = Voucher::create($data);

        $this->assertDatabaseHas('vouchers', $data);

        $this->assertEquals($data['code'], $voucher->code);
        $this->assertEquals($data['note'], $voucher->note);
        $this->assertEquals($data['total_unit'], $voucher->total_unit);
    }

    #[Test]
    public function it_can_delete_a_voucher()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->getKey(),
            'model_type' => $user->getMorphClass(),
        ]);

        $deleted = $voucher->delete();

        $this->assertTrue($deleted);
        $this->assertSoftDeleted('vouchers', [
            'id' => $voucher->id,
            'code' => $voucher->code,
            'note' => $voucher->note,
            'total_unit' => $voucher->total_unit,
        ]);
    }

    #[Test]
    public function it_errors_when_updating_the_voucher()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);
        $this->expectException(\Exception::class);

        $voucher->update(['code' => null]);
    }

    #[Test]
    public function it_can_update_the_voucher()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);

        $update = ['code' => 'code'];
        $updated = $voucher->update($update);

        $voucher = $voucher->where('code', ($update['code']))->first();

        $this->assertTrue($updated);
        $this->assertEquals($update['code'], $voucher->code);
    }

    #[Test]
    public function it_can_find_the_voucher()
    {
        $user = User::factory()->create();
        $voucher = Voucher::factory()->create([
            'model_id' => $user->id,
            'model_type' => User::class,
        ]);

        $found = Voucher::find($voucher->id);

        $this->assertInstanceOf(Voucher::class, $found);
        $this->assertEquals($voucher->code, $found->code);
    }

    #[Test]
    public function it_can_list_all_vouchers()
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
