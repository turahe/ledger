<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Turahe\Ledger\Enums\PaymentMethods;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(\Turahe\Ledger\Models\Invoice::class, 'invoice_id')->index();
            $table->foreignIdFor(\Turahe\Ledger\Models\Voucher::class, 'receipt_id')->index();

            $table->string('currency')->default('IDR')->index();

            $table->decimal('amount');
            $table->string('payment_gateway')->nullable()->index();

            $table->enum('payment_method', array_column(PaymentMethods::cases(), 'value'))->default('CASH')->index();
            $table->string('payment_channel')->nullable();
            $table->float('payment_fee')->default(0);
            $table->string('payment_status_code')->nullable();
            $table->string('payment_status_message')->nullable();
            $table->integer('payment_issued_at')->nullable();
            $table->integer('payment_expires_at')->nullable();

            $table->foreignUlid('created_by')
                ->index()
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignUlid('updated_by')
                ->index()
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignUlid('deleted_by')
                ->index()
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            if (config('core.table.use_timestamps')) {
                $table->timestamps();
                $table->softDeletes();
            } else {
                $table->integer('created_at')->index()->nullable();
                $table->integer('updated_at')->index()->nullable();
                $table->integer('deleted_at')->index()->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_payments');
    }
};
