<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_high_season_fees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('school_branches')->cascadeOnDelete();
            $table->date('season_start_date');
            $table->date('season_end_date');
            $table->decimal('amount_per_week', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_high_season_fees');
    }
};
