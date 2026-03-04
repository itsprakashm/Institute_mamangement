<?php

namespace Database\Factories;

use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    protected $model = ClassModel::class;

    public function definition()
    {
        return [
            'name' => 'Grade ' . $this->faker->numberBetween(1, 12) . ' ' . $this->faker->randomElement(['A', 'B', 'C', 'Science', 'Maths']),
            'description' => $this->faker->sentence,
        ];
    }
}
