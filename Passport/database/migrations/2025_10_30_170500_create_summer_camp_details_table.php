<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('summer_camp_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('camp_id')->unique()->constrained('summer_camps')->cascadeOnDelete();
            $table->mediumText('overview')->nullable();
            $table->mediumText('ar_overview')->nullable();
            $table->mediumText('academics')->nullable();
            $table->mediumText('ar_academics')->nullable();
            $table->mediumText('activities')->nullable();
            $table->mediumText('ar_activities')->nullable();
            $table->mediumText('accommodation')->nullable();
            $table->mediumText('ar_accommodation')->nullable();
            $table->mediumText('safeguarding')->nullable();
            $table->mediumText('ar_safeguarding')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('summer_camp_details');
    }
};
