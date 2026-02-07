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
        Schema::create('university_course_fees', function (Blueprint $table) {
            $table->id();

            // Renamed column to course_id to match user request (or university_course_id for consistency?)
            // User requested course_id FK -> university_courses
            $table->foreignId('course_id')->constrained('university_courses')->onDelete('cascade');
            $table->foreignId('campus_id')->constrained('university_campuses')->onDelete('cascade');

            $table->decimal('first_year_fee', 12, 2)->nullable();
            $table->char('currency', 3)->default('USD');
            $table->string('note', 255)->nullable();

            $table->boolean('is_active')->default(1);
            $table->timestamps();

            $table->unique(['course_id', 'campus_id']);
            $table->index(['course_id', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_course_fees');
    }
};
