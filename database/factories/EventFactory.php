<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['Practice', 'Game', 'Scrimmage']),
            'team_id' => Team::factory(),
            'eventDate' => $this->faker->dateTimeBetween('-1 month', '+1 month')
        ];
    }
}
