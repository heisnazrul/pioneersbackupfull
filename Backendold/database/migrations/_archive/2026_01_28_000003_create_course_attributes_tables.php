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
        // 1. Levels (study level)
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->string('key', 50)->unique(); // bachelor, master, phd, diploma
            $table->string('name', 80); // Bachelor’s
            $table->smallInteger('sort_order')->default(0)->index();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        // 2. Subject Areas
        Schema::create('subject_areas', function (Blueprint $table) {
            $table->id();
            $table->string('key', 80)->unique();
            $table->string('name', 120);
            $table->string('slug', 140)->unique();
            $table->smallInteger('sort_order')->default(0)->index();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        // 3. Intake Terms
        Schema::create('intake_terms', function (Blueprint $table) {
            $table->id();
            $table->string('key', 30)->unique();
            $table->string('name', 50);
            $table->tinyInteger('month_num')->nullable()->index(); // 1..12
            $table->smallInteger('sort_order')->default(0)->index();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        // 4. Language Tests
        Schema::create('language_tests', function (Blueprint $table) {
            $table->id();
            $table->string('key', 30)->unique();
            $table->string('name', 60);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });

        // 5. University Course Tags
        Schema::create('university_course_tags', function (Blueprint $table) {
            $table->id();
            $table->string('key', 60)->unique();
            $table->string('name', 80);
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_course_tags');
        Schema::dropIfExists('language_tests');
        Schema::dropIfExists('intake_terms');
        Schema::dropIfExists('subject_areas');
        Schema::dropIfExists('levels');
    }
};
