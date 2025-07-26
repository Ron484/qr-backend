<?php

namespace Database\Factories;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RegisteredUser>
 */
class RegisteredUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_id' => strtoupper(Str::random(4)) . rand(1000, 9999), 
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'mobile' => preg_replace('/[^0-9+]/', '', fake()->phoneNumber()),
            'job_title' => fake()->jobTitle(),
            'company' => fake()->company(),
        ];
    }

}
