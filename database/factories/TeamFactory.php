<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conference' => $this->faker->randomElement(['East', 'West']),
            'division' => $this->faker->word(),
            'city' => $this->faker->city(),
            'name' => $this->faker->company(),
            'full_name' => $this->faker->company() . ' ' . $this->faker->word(),
            'abbreviation' => strtoupper(substr($this->faker->word(), 0, 5)),
        ];
    }
}
