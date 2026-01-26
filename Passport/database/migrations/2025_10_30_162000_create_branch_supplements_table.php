<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_supplements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ar_name')->nullable();
            $table->foreignId('school_branch_id')->constrained('school_branches')->cascadeOnDelete();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->decimal('fee', 12, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_supplements');
    }
};
