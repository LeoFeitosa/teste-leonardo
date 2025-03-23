<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->date(),
            'season' => $this->faker->year(),
            'status' => $this->faker->randomElement(['Final', 'In Progress']),
            'period' => $this->faker->numberBetween(1, 4),
            'home_team_score' => $this->faker->numberBetween(50, 100),
            'visitor_team_score' => $this->faker->numberBetween(50, 100),
            'time' => $this->faker->time('H:i:s'),
            'postseason' => $this->faker->boolean(),
            'datetime' => $this->faker->dateTimeThisYear(),
        ];
    }
}
