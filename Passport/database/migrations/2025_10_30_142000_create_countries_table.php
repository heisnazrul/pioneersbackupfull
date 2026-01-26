<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('countries', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('ar_name');
            $table->string('flag');
            $table->string('country_code')->unique();
            $table->string('currency_code');
            $table->string('phone_code', 10)->nullable();
            $table->text('description')->nullable();
            $table->text('ar_description')->nullable();
            $table->string('capital')->nullable();
            $table->string('continent')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};

