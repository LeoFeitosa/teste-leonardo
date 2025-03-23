<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameTeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::all()->each(function ($game) {
            $teams = Team::inRandomOrder()->take(2)->get();

            foreach ($teams as $index => $team) {
                $game->teams()->attach($team->id, [
                    'is_home_team' => $index === 0,
                ]);
            }
        });
    }
}
