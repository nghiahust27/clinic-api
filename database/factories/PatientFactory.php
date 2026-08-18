<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code'=>'BN'.fake()->unique()->numberBetween(0,999999),
            'full_name'=>fake()->name(),

            'gender'=>fake()->randomElement(['male','female','other']),
            'date_of_birth'=>fake()->date(),
            'phone'=>fake()->unique()->numerify('09########'),
            'email'=>fake()->safeEmail(),
            'address'=>fake()->address(),

        ];
    }
}
