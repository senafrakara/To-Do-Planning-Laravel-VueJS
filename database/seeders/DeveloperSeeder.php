<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Developer;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $developers = [
            ['name' => 'DEV1', 'capacityPerHour' => 1],
            ['name' => 'DEV2', 'capacityPerHour' => 2],
            ['name' => 'DEV3', 'capacityPerHour' => 3],
            ['name' => 'DEV4', 'capacityPerHour' => 4],
            ['name' => 'DEV5', 'capacityPerHour' => 5],
        ];

        foreach ($developers as $developer) {
            Developer::create($developer);
        }
    }
}
