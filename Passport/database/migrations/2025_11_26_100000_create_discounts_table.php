<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discounts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('ar_name')->nullable();
            $table->decimal('discount_percentage', 5, 2);
            $table->boolean('applies_to_all_branches')->default(true);
            $table->boolean('applies_to_all_countries')->default(true);
            $table->json('school_branch_ids')->nullable();
            $table->json('country_ids')->nullable();
            $table->boolean('applies_to_user_country')->default(false);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index(['is_active', 'start_date', 'end_date'], 'idx_discounts_active_dates');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
