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
        // 1. Destinations (Main Table)
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->nullable()->constrained('countries')->onDelete('set null'); // Optional link to countries table
            $table->string('slug')->unique();
            $table->string('name'); // e.g., United Kingdom
            $table->string('region')->nullable(); // e.g., Europe
            $table->longText('description')->nullable();
            $table->string('image_url')->nullable();
            $table->text('short_pitch')->nullable();
            $table->string('tuition_range')->nullable();
            $table->string('visa_timeline')->nullable();
            $table->string('work_rights')->nullable();
            $table->string('scholarships_summary')->nullable();
            $table->integer('university_count')->default(0); // Cache value for display
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // 2. Destination Features (List of strings)
        Schema::create('destination_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('feature');
            $table->timestamps();
        });

        // 3. Destination Stats (Label-Value pairs)
        Schema::create('destination_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('label');
            $table->string('value');
            $table->timestamps();
        });

        // 4. Destination Intake Timeline
        Schema::create('destination_intakes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('month'); // e.g., Jan
            $table->string('event'); // e.g., Winter Intake
            $table->timestamps();
        });

        // 5. Destination FAQs
        Schema::create('destination_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->text('question');
            $table->text('answer');
            $table->timestamps();
        });

        // 6. Destination Requirements
        Schema::create('destination_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('requirement');
            $table->timestamps();
        });

        // 7. Destination Popular Disciplines
        Schema::create('destination_disciplines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->string('discipline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_disciplines');
        Schema::dropIfExists('destination_requirements');
        Schema::dropIfExists('destination_faqs');
        Schema::dropIfExists('destination_intakes');
        Schema::dropIfExists('destination_stats');
        Schema::dropIfExists('destination_features');
        Schema::dropIfExists('destinations');
    }
};
