<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agent_students', function (Blueprint $table) {
            $table->string('onboarding_token', 64)->nullable()->after('country');
            $table->timestamp('onboarding_token_expires_at')->nullable()->after('onboarding_token');
            $table->timestamp('onboarded_at')->nullable()->after('onboarding_token_expires_at');
        });
    }

    public function down(): void
    {
        Schema::table('agent_students', function (Blueprint $table) {
            $table->dropColumn(['onboarding_token', 'onboarding_token_expires_at', 'onboarded_at']);
        });
    }
};
