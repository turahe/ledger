<?php

namespace Turahe\Ledger\Tests\Unit;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
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
            'model_id' => $user->id,
            'model_type' => User::class,
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
        dd($voucher);

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
    public function it_errors_when_updating_the_voucher()
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
    public function it_can_update_the_voucher()
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
    public function it_can_find_the_voucher()
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
