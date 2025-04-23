<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Team;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all team
        $teams = Team::all();

        if ($teams->count() === 0) {
            // Generate some teams if none
            $teams = Team::factory(3)->create();
        }

        // Generate locations for each teams
        foreach ($teams as $team) {
            Location::factory(5)
                ->for($team)
                ->create();
        }
    }
}
