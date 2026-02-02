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
        Schema::table('universities', function (Blueprint $table) {
            $table->text('description')->nullable()->after('website');
            $table->integer('student_count')->nullable()->after('description');
            $table->decimal('employment_rate', 5, 2)->nullable()->after('student_count');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('universities', function (Blueprint $table) {
            $table->dropColumn(['description', 'student_count', 'employment_rate']);
        });
    }
};
