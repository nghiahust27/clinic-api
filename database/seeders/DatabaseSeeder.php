<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
        ]);

        $adminRole = Role::where('name', 'ADMIN')->firstOrFail();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $adminRole->id,
        ]);
    }
}