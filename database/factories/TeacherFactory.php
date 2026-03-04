<?php

namespace Database\Factories;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'qualification' => $this->faker->randomElement(['B.Ed', 'M.Sc', 'M.A', 'Ph.D']),
            'experience' => $this->faker->numberBetween(1, 15),
        ];
    }
}
