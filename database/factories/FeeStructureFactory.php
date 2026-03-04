<?php

namespace Database\Factories;

use App\Models\FeeStructure;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeeStructureFactory extends Factory
{
    protected $model = FeeStructure::class;

    public function definition()
    {
        return [
            'class_id' => ClassModel::factory(),
            'monthly_fee' => $this->faker->randomElement([1500, 2000, 2500, 3000, 5000]),
            'description' => $this->faker->sentence,
        ];
    }
}
