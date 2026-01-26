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
        // 1. Universities
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('logo')->nullable();
            $table->string('cover_image')->nullable();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('type')->default('public'); // public, private
            $table->year('established_year')->nullable();
            $table->string('website')->nullable();
            $table->integer('rank')->nullable(); // Global Rank
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. University Details
        Schema::create('university_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained('universities')->onDelete('cascade');
            $table->longText('description')->nullable();
            $table->text('history')->nullable();
            $table->text('facilities')->nullable();
            $table->text('accommodation_info')->nullable();
            $table->text('address')->nullable();
            $table->string('map_coordinates')->nullable();
            $table->integer('rank_national')->nullable();
            $table->timestamps();
        });

        // 3. Course Levels
        Schema::create('university_course_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bachelor, Master, PhD
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // 4. Courses
        Schema::create('university_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained('universities')->onDelete('cascade');
            $table->foreignId('level_id')->constrained('university_course_levels')->onDelete('cascade');
            $table->string('faculty_name')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->integer('duration_months')->nullable();
            $table->decimal('tuition_fee', 10, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->timestamps();
        });

        // 5. Course Details
        Schema::create('university_course_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('university_courses')->onDelete('cascade');
            $table->longText('overview')->nullable();
            $table->longText('curriculum')->nullable();
            $table->longText('career_opportunities')->nullable();
            $table->timestamps();
        });

        // 6. Entry Requirements
        Schema::create('university_course_entry_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('university_courses')->onDelete('cascade');
            $table->string('min_gpa')->nullable();
            $table->string('min_ielts')->nullable();
            $table->string('min_toefl')->nullable();
            $table->text('academic_requirements_text')->nullable();
            $table->text('english_requirements_text')->nullable();
            $table->timestamps();
        });

        // 7. Intakes
        Schema::create('university_intakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('university_courses')->onDelete('cascade');
            $table->string('month'); // e.g. "January", "September"
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->timestamps();
        });

        // 8. Scholarships
        Schema::create('university_scholarships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->nullable()->constrained('universities')->onDelete('cascade'); // Nullable for government/global scholarships. BUT if strictly university-bound, make required. Based on plan, attached to uni.
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->default('USD');
            $table->date('deadline')->nullable();
            $table->timestamps();
        });

        // 9. Scholarship Details
        Schema::create('university_scholarship_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('scholarship_id')->constrained('university_scholarships')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->text('eligibility_criteria')->nullable();
            $table->text('application_process')->nullable();
            $table->timestamps();
        });

        // 10. Galleries
        Schema::create('university_galleries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained('universities')->onDelete('cascade');
            $table->string('image_url');
            $table->string('caption')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_galleries');
        Schema::dropIfExists('university_scholarship_details');
        Schema::dropIfExists('university_scholarships');
        Schema::dropIfExists('university_intakes');
        Schema::dropIfExists('university_course_entry_requirements');
        Schema::dropIfExists('university_course_details');
        Schema::dropIfExists('university_courses');
        Schema::dropIfExists('university_course_levels');
        Schema::dropIfExists('university_details');
        Schema::dropIfExists('universities');
    }
};
