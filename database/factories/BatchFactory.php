<?php

namespace Database\Factories;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    protected $model = Batch::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'name' => $this->faker->randomElement(['Morning', 'Afternoon', 'Evening']) . ' Batch',
            'teacher_id' => Teacher::factory(),
            'start_time' => $this->faker->time('H:i'),
            'end_time' => $this->faker->time('H:i'),
            'is_active' => true,
        ];
    }
}
