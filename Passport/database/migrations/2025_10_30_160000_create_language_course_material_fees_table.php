<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('language_course_material_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('language_course_id')->constrained('language_courses')->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->enum('billing_unit', ['week', 'month', 'course']);
            $table->unsignedSmallInteger('billing_count')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('language_course_material_fees');
    }
};
