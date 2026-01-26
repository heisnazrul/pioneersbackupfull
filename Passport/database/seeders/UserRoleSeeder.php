<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = User::ROLES;

        foreach ($roles as $role) {
            User::updateOrCreate(
                ['email' => "{$role}@example.com"],
                [
                    'name' => Str::headline($role) . ' User',
                    'username' => "{$role}_user",
                    'role' => $role,
                    'email_verified_at' => now(),
                    'phone' => null,
                    'avatar' => null,
                    'status' => 'active',
                    'last_login_at' => null,
                    'password' => Hash::make('1234'),
                ],
            );
        }
    }
}
