<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RegisteredUser;
use App\Models\ScanLog;

class ScanLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       RegisteredUser::all()->each(function ($user) {
        ScanLog::factory()->create([
            'registration_id' => $user->registration_id, 
        ]);
    });
    }
}
