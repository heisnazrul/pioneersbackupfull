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
        Schema::create('university_campuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('university_id')->constrained()->onDelete('cascade');
            // city_id nullable because online campuses might not have a physical city
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');

            $table->string('name', 150);
            $table->string('slug', 180);
            $table->text('address')->nullable();

            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();

            $table->boolean('is_online')->default(0);
            $table->boolean('is_active')->default(1);

            $table->timestamps();

            // Constraints
            $table->unique(['university_id', 'slug']);
            $table->index(['is_online', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('university_campuses');
    }
};
