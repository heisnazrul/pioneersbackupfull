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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique(); // 8-digit unique ID
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable for guest applications

            // Personal Details
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('citizenship')->nullable();
            $table->string('nationality')->nullable();
            $table->string('nationality_other')->nullable();

            // Academic Profile
            $table->string('highest_education')->nullable();
            $table->string('grade_average')->nullable();
            $table->boolean('has_english_test')->default(false);
            $table->string('english_test_type')->nullable();
            $table->string('english_test_score')->nullable();

            // Preferences
            $table->json('destination_interest')->nullable();
            $table->string('destinations_other')->nullable();
            $table->string('preferred_intake')->nullable();
            $table->string('budget_range')->nullable();

            // Backend Management
            $table->enum('status', ['pending', 'submitted', 'reviewing', 'contacted', 'accepted', 'rejected', 'invalid'])->default('pending');
            $table->unsignedBigInteger('assigned_to')->nullable(); // User ID of admin/councillor
            $table->string('assigned_role')->nullable(); // admin, councillor, team
            $table->text('status_notes')->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
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
