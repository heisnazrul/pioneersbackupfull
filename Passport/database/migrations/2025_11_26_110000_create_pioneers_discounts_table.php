<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pioneers_discounts', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('ar_name')->nullable();
            $table->unsignedInteger('weeks');
            $table->decimal('discount_amount', 10, 2)->nullable();
            $table->string('discount_full_for')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['name', 'weeks'], 'pioneers_name_weeks_unique');
        });

        Schema::table('pioneers_discounts', function (Blueprint $table): void {
            $table->index('is_active', 'pioneers_active_index');
            $table->index('weeks', 'pioneers_weeks_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pioneers_discounts');
    }
};
