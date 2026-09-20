<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code'  => strtoupper(fake()->unique()->bothify('??###')), // CS101
            'title' => fake()->sentence(3),
            'units' => fake()->randomElement([2, 3]),
        ];
    }
}
