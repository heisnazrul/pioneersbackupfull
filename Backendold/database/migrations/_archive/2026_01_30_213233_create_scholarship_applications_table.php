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
        Schema::create('scholarship_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id')->unique(); // 8-digit unique ID
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable for guest applications

            // specific to scholarship
            $table->unsignedBigInteger('scholarship_id')->nullable();
            $table->string('scholarship_title')->nullable();
            $table->string('scholarship_slug')->nullable();

            // Personal Details
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country')->nullable();
            $table->string('city')->nullable();

            // Academic Profile
            $table->string('education_level')->nullable();
            $table->string('grade_average')->nullable();
            $table->string('english_proficiency')->nullable(); // IELTS, TOEFL, etc.

            // Status
            $table->enum('status', ['pending', 'reviewing', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            // We assume scholarships table exists, if not we skip strict FK or make it nullable
            // $table->foreign('scholarship_id')->references('id')->on('scholarships')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scholarship_applications');
    }
};
