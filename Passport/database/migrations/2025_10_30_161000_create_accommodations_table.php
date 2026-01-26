<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_branch_id')->constrained('school_branches')->cascadeOnDelete();
            $table->foreignId('language_course_tag_id')->nullable()->constrained('language_course_tags')->nullOnDelete();
            $table->unsignedTinyInteger('required_age')->nullable();
            $table->decimal('fee_per_week', 12, 2);
            $table->decimal('admin_charge', 12, 2)->nullable();
            $table->decimal('under18_supplement_per_week', 12, 2)->nullable();
            $table->foreignId('bedroom_type_id')->constrained('bedroom_types')->restrictOnDelete();
            $table->foreignId('bathroom_type_id')->constrained('bathroom_types')->restrictOnDelete();
            $table->foreignId('meal_plan_id')->constrained('meal_plans')->restrictOnDelete();
            $table->string('notes', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
