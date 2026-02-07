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
        // 1. Drop the fees table as it's being merged into courses
        Schema::dropIfExists('university_course_fees');

        // 2. Add columns to university_courses
        Schema::table('university_courses', function (Blueprint $table) {
            $table->decimal('first_year_fee', 12, 2)->nullable()->after('duration_unit');
            $table->char('currency', 3)->default('USD')->after('first_year_fee');

            $table->longText('degree_requirement')->nullable()->after('awarding_body');
            $table->longText('language_requirement')->nullable()->after('degree_requirement');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('university_courses', function (Blueprint $table) {
            $table->dropColumn(['first_year_fee', 'currency', 'degree_requirement', 'language_requirement']);
        });

        // Note: We don't recreate the dropped table in down() typically unless complete restore is needed, 
        // as data would be lost anyway.
    }
};
