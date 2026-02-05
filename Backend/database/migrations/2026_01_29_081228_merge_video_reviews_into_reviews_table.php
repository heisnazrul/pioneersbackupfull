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
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('university_name')->nullable()->after('ar_name');
            $table->string('course_name')->nullable()->after('university_name');
            $table->string('country_name')->nullable()->after('course_name');
            $table->string('video_url')->nullable()->after('rating');
            $table->text('video_iframe')->nullable()->after('video_url');
            $table->string('thumbnail')->nullable()->after('video_iframe');
            $table->boolean('is_active')->default(true)->after('is_approved'); // Alias/replacement for is_approved in future
        });

        Schema::dropIfExists('video_reviews');
    }

    public function down(): void
    {
        Schema::create('video_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('course_name')->nullable();
            $table->string('university_name')->nullable();
            $table->string('country_name')->nullable();
            $table->text('review_text')->nullable();
            $table->string('video_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn([
                'university_name',
                'course_name',
                'country_name',
                'video_url',
                'video_iframe',
                'thumbnail',
                'is_active',
            ]);
        });
    }
};
