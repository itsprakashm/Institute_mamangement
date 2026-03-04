<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\ClassModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = Batch::class;

    public function definition()
    {
        return [
            'class_id' => ClassModel::factory(),
            'name' => $this->faker->randomElement(['Morning', 'Afternoon', 'Evening']) . ' Batch',
            'teacher_id' => User::factory(),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'is_active' => true,
        ];
    }
}
