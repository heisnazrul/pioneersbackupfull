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
            $table->foreignId('university_id')->constrained('universities')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('address')->nullable();
            $table->string('map_coordinates')->nullable();
            $table->timestamps();
        });

        Schema::table('university_courses', function (Blueprint $table) {
            $table->foreignId('campus_id')->nullable()->after('university_id')->constrained('university_campuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('university_courses', function (Blueprint $table) {
            $table->dropForeign(['campus_id']);
            $table->dropColumn('campus_id');
        });

        Schema::dropIfExists('university_campuses');
    }
};
