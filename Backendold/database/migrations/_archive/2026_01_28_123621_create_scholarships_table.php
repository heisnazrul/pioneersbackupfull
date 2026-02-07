<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();

            $table->foreignId('university_id')->nullable()->constrained('universities')->onDelete('cascade');
            // Adding provider_name if not university specific or just third party
            $table->string('provider_name')->nullable();

            $table->string('name');
            $table->string('slug');
            $table->string('summary')->nullable(); // Short text for cards
            $table->longText('description')->nullable(); // Full details

            $table->enum('amount_type', ['fixed', 'percentage', 'variable'])->default('variable');
            $table->decimal('amount_value', 12, 2)->nullable(); // For fixed or percentage
            $table->char('currency', 3)->nullable(); // needed for fixed
            $table->decimal('min_amount', 12, 2)->nullable(); // for variable
            $table->decimal('max_amount', 12, 2)->nullable(); // for variable

            $table->date('deadline_date')->nullable();
            $table->json('eligible_nationalities')->nullable();
            $table->longText('eligibility_text')->nullable();
            $table->string('apply_link', 500)->nullable();

            $table->boolean('is_active')->default(1);
            $table->timestamps();

            // Unique slug per university? 
            // If university_id is null, slug must be unique globally? 
            // Or maybe just generic unique constraints on (university_id, slug). 
            // Let's add unique constraint but handle nulls via logic or just rely on global uniqueness?
            // "UNIQUE (university_id, slug)" implies we can have same slug for different unis.
            // If university_id is NULL, SQL treats them as distinct so duplicate NULL-slug pairs are allowed unless we use a partial index.
            // For simplicity, we just won't enforce DB constraint on NULLs specially, but will enforce (university_id, slug).
            $table->unique(['university_id', 'slug']);

            $table->index(['university_id', 'is_active']);
            $table->index('deadline_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
