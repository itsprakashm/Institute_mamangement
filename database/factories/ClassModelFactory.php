<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'name' => 'Course ' . $this->faker->unique()->numberBetween(1, 120),
            'code' => strtoupper($this->faker->bothify('CRS###')),
            'description' => $this->faker->sentence,
            'is_active' => true,
        ];
    }
}
