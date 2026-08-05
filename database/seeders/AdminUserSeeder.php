<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'ADMIN')->firstOrFail();
        
        User::updateOrCreate(
            ['email' => 'admin@clinic.test'],
            ['name' => 'Admin',
            'password' => Hash::make('12345678'),
            'role_id'=>$adminRole->id,
            'email_verified_at' =>now()]
        );
    }
}
