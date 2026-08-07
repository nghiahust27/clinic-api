<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class DoctorFactory extends Factory
{
    public function definition(): array
    {
        $role = Role::firstOrCreate(
            ['name' => 'DOCTOR'],
            ['display_name' => 'Doctor']
        );

        return [
            'user_id' => User::factory()->state([
                'role_id' => $role->id
            ]),

            'specialty_id' => Specialty::factory(),

            'license_number' =>
                'LIC'.fake()->unique()->numberBetween(10000,99999),

            'bio' => fake()->sentence(),
        ];
    }
}