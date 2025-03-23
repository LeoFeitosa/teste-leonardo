<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Player>
 */
class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'position' => strtoupper(substr($this->faker->word(), 0, 5)),
            'height' => $this->faker->numberBetween(180, 220),
            'weight' => $this->faker->numberBetween(70, 120),
            'jersey_number' => $this->faker->numberBetween(1, 99),
            'college' => $this->faker->company(),
            'country' => $this->faker->country(),
            'draft_year' => $this->faker->year(),
            'draft_round' => $this->faker->randomDigit(),
            'draft_number' => $this->faker->randomDigit(),
            'team_id' => Team::inRandomOrder()->first()->id,
        ];
    }
}
