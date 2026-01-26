<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('branch_insurances', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->foreignId('school_branch_id')->constrained('school_branches')->cascadeOnDelete();
            $table->decimal('fee', 12, 2);
            $table->decimal('admin_charge', 12, 2)->nullable();
            $table->enum('billing_unit', ['week', 'month', 'course']);
            $table->unsignedSmallInteger('billing_count')->default(1);
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('branch_insurances');
    }
};
