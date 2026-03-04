<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Batch;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition()
    {
        return [
            'admission_no' => Student::generateAdmissionNo(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'dob' => $this->faker->date('Y-m-d', '-10 years'),
            'photo' => null,
            'guardian_name' => $this->faker->name,
            'guardian_phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'class_id' => ClassModel::factory(),
            'batch_id' => Batch::factory(),
            'status' => 'active',
        ];
    }
}
