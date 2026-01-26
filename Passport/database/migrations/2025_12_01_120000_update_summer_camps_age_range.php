<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('summer_camps', function (Blueprint $table): void {
            $table->string('age_range', 50)->nullable()->after('lessons_per_week');
            $table->dropColumn('min_age');
        });
    }

    public function down(): void
    {
        Schema::table('summer_camps', function (Blueprint $table): void {
            $table->tinyInteger('min_age')->nullable()->after('lessons_per_week');
            $table->dropColumn('age_range');
        });
    }
};
