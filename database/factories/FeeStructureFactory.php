<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\FeeStructure;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeStructureFactory extends Factory
{
    protected $model = FeeStructure::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'fee_type' => $this->faker->randomElement(['admission', 'monthly', 'exam']),
            'amount' => $this->faker->randomElement([1500, 2000, 2500, 3000, 5000]),
            'description' => $this->faker->sentence,
        ];
    }
}
