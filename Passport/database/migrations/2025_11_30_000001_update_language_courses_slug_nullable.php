<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('language_courses', function (Blueprint $table): void {
            // Remove unique constraint and allow nulls on slug
            $table->dropUnique('language_courses_slug_unique');
            $table->string('slug', 160)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('language_courses', function (Blueprint $table): void {
            // Revert to required unique slug
            $table->string('slug', 160)->nullable(false)->change();
            $table->unique('slug', 'language_courses_slug_unique');
        });
    }
};
