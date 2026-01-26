<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->decimal('referral_discount', 5, 2)->default(0)->after('referral_code');
            $table->decimal('commission_percent', 5, 2)->default(0)->after('referral_discount');
            $table->timestamp('referral_joined_at')->nullable()->after('commission_percent');
        });
    }

    public function down(): void
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropColumn(['referral_discount', 'commission_percent', 'referral_joined_at']);
        });
    }
};
