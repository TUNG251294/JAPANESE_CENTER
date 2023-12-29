<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'fee' => $this->faker->numberBetween(1000000, 10000000),
            'opening_date' => $this->faker->date(),
            'ending_date' => $this->faker->date(),
            'level_id' => $this->faker->numberBetween(1, 5),
            'estimated_students' => $this->faker->numberBetween(10, 100),
            'actual_students' => $this->faker->numberBetween(10, 100),
            'status' => $this->faker->randomElement(['NEW', 'ONGOING', 'CLOSED']),
            'total_session' => $this->faker->numberBetween(20, 60),
            'schedule_dates' => $this->faker->randomElement(['monday,thursday', 'tuesday,friday']),
        ];
    }
}
