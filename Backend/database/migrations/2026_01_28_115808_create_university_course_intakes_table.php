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
        // Drop old pivot if exists
        Schema::dropIfExists('university_course_intake_term');

        Schema::create('university_course_intakes', function (Blueprint $table) {
            $table->id();

            // Renamed column to course_id as requested, but keep semantic link clear
            $table->foreignId('university_course_id')->constrained('university_courses')->onDelete('cascade');
            $table->foreignId('intake_term_id')->constrained('intake_terms')->onDelete('cascade');

            $table->date('deadline_date')->nullable();
            $table->date('start_date')->nullable();

            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->unique(['university_course_id', 'intake_term_id'], 'course_intake_unique');
            $table->index(['university_course_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_course_intakes');
    }
};
