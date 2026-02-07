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
        Schema::create('university_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            $table->foreignId('level_id')->constrained('levels'); // Assuming levels table
            $table->foreignId('subject_area_id')->nullable()->constrained('subject_areas'); // Assuming subject_areas table

            $table->string('name', 255);
            $table->string('slug', 255);

            $table->smallInteger('duration_value')->unsigned()->nullable();
            $table->string('duration_unit', 10)->default('month'); // or enum

            $table->longText('overview')->nullable();
            $table->string('awarding_body', 255)->nullable();

            $table->boolean('is_active')->default(1);
            $table->timestamps();

            // Unique & Indexes
            $table->unique(['university_id', 'slug']);
            $table->index(['university_id', 'is_active']);
            $table->index(['level_id']);
            $table->index(['subject_area_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_courses');
    }
};
