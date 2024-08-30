<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulidMorphs('model');
            $table->string('code');
            $table->text('note')->nullable();
            $table->string('total_unit')->nullable();
            $table->decimal('total_value', 64, 4)->comment('amount is an decimal, it could be "dollars" or "cents"');
            $table->integer('issue_date')->nullable();
            $table->integer('due_date')->nullable();
            $table->enum('record_entry', ['IN', 'OUT']);
            $table->string('record_type')->nullable()->comment('type can be anything in your app, by default we use "deposit" and "withdraw"');
            $table->json('metadata')->nullable();

            $table->unsignedBigInteger('record_left')->index()->nullable();
            $table->unsignedBigInteger('record_right')->index()->nullable();
            $table->unsignedBigInteger('record_ordering')->index()->nullable();
            $table->foreignUlid('parent_id')->index()->nullable();

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

            $table->integer('deleted_at')->index()->nullable();
            $table->integer('created_at')->index()->nullable();
            $table->integer('updated_at')->index()->nullable();

            $table->index('id', 'vouchers_id_idx', 'hash');
        });

        Schema::create('voucher_items', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignIdFor(\Modules\Ledger\Models\Voucher::class, 'voucher_id')->index();

            $table->ulidMorphs('model');
            $table->decimal('quantity', 64)->default(1);
            $table->string('unit')->nullable();
            $table->decimal('value', 64, 4);
            $table->string('record_type')->nullable()->comment('type can be anything in your app, by default we use "deposit" and "withdraw"');
            $table->json('metadata')->nullable();

            $table->unsignedBigInteger('record_left')->index()->nullable();
            $table->unsignedBigInteger('record_right')->index()->nullable();
            $table->unsignedBigInteger('record_ordering')->index()->nullable();
            $table->foreignUlid('parent_id')->index()->nullable();

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

            $table->integer('deleted_at')->index()->nullable();
            $table->integer('created_at')->index()->nullable();
            $table->integer('updated_at')->index()->nullable();

            $table->index('id', 'voucher_items_id_idx', 'hash');
            $table->index('model_id', 'voucher_items_model_id_idx', 'hash');
            $table->index('model_type', 'voucher_items_model_type_idx', 'hash');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher_items');
        Schema::dropIfExists('vouchers');
    }
};
