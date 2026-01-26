<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('username')->nullable()->unique()->after('email');
            $table->enum('role', [
                'admin',
                'team',
                'counsellor',
                'uni_agent',
                'agent',
                'lg_agent',
                'school',
                'lg_student',
                'uni_student',
            ])->default('lg_student')->after('username');
            $table->string('phone')->nullable()->after('role');
            $table->string('avatar')->nullable()->after('phone');
            $table->enum('status', ['active', 'inactive', 'banned'])->default('active')->after('avatar')->index();
            $table->timestamp('last_login_at')->nullable()->after('status')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropUnique('users_username_unique');
            $table->dropIndex('users_status_index');
            $table->dropIndex('users_last_login_at_index');

            $table->dropColumn([
                'username',
                'role',
                'phone',
                'avatar',
                'status',
                'last_login_at',
            ]);
        });
    }
};

