<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Team;
use App\Models\User;
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
            $team->users()->attach(User::factory()->withPersonalTeam()->create(), ['role' => 'admin']);
            $team->users()->attach(User::factory()->withPersonalTeam()->create(), ['role' => 'member']);
            Location::factory(5)
                ->for($team)
                ->create();
        }
    }
}
