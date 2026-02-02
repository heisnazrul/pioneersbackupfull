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
        Schema::dropIfExists('applications');
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique()->nullable(); // For generated ID like "82930042"
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('citizenship')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nationality_other')->nullable();
            $table->string('highest_education')->nullable();
            $table->string('grade_average')->nullable();
            $table->boolean('has_english_test')->default(false);
            $table->string('english_test_type')->nullable();
            $table->string('english_test_score')->nullable();
            $table->json('destination_interest')->nullable(); // Store array as JSON
            $table->string('destinations_other')->nullable();
            $table->string('preferred_intake')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
