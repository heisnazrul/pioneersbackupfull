<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('language_course_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_course_id')->constrained('language_courses')->cascadeOnDelete();
            $table->unsignedInteger('week_number');
            $table->decimal('fee', 10, 2);
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->enum('price_split', ['yes', 'no'])->default('yes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('language_course_fees');
    }
};
