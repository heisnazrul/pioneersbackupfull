<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table): void {
            $table->id();
            $table->string('code', 100)->unique();
            $table->string('name');
            $table->enum('discount_type', ['percent', 'flat']);
            $table->decimal('discount_value', 10, 2);
            $table->unsignedInteger('usage_limit')->default(1);
            $table->unsignedInteger('used_count')->default(0);
            $table->date('expiration_date')->nullable();
            $table->decimal('minimum_purchase_amount', 10, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
