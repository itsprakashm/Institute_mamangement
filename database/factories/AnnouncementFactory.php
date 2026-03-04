<?php

namespace Database\Factories;

use App\Models\Announcement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnouncementFactory extends Factory
{
    protected $model = Announcement::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'message' => $this->faker->paragraph,
            'created_by' => User::factory(),
        ];
    }
}
