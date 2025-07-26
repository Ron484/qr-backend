<?php

namespace Database\Factories;
use App\Models\RegisteredUser;
use App\Models\ScanLog;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ScanLog>
 */
class ScanLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'registration_id' => RegisteredUser::factory(), 
            'is_scanned' => false,
            'scan_time' => null,
        ];
    }
}
