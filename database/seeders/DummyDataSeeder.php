<?php

namespace Database\Seeders;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Role;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        $roleNames = [
            'super_admin' => 'Super Admin',
            'admin' => 'Admin',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'accountant' => 'Accountant',
            'reception' => 'Reception',
        ];

        $roles = [];
        foreach ($roleNames as $name => $displayName) {
            $roles[$name] = Role::firstOrCreate(['name' => $name], ['display_name' => $displayName]);
        }

        $teacherUsers = collect();
        for ($i = 1; $i <= 2; $i++) {
            $teacherUser = User::updateOrCreate(
                ['email' => "teacher{$i}@admin.com"],
                [
                    'name' => "Teacher {$i}",
                    'password' => bcrypt('admin@123'),
                    'role_id' => $roles['teacher']->id,
                    'status' => 'active',
                ]
            );
            $teacherUser->roles()->sync([$roles['teacher']->id]);

            Teacher::updateOrCreate(
                ['user_id' => $teacherUser->id],
                ['qualification' => 'M.Com', 'experience' => 3 + $i]
            );

            $teacherUsers->push($teacherUser);
        }

        $courses = collect(['JAC+1', 'JAC+2', 'B.COM PART1'])->map(function ($name) {
            return Course::firstOrCreate(['name' => $name], ['is_active' => true]);
        });

        $batches = collect();
        foreach ($courses as $index => $course) {
            $teacherProfile = Teacher::where('user_id', $teacherUsers[$index % $teacherUsers->count()]->id)->first();
            $batches->push(Batch::firstOrCreate(
                ['course_id' => $course->id, 'name' => 'Batch A'],
                ['teacher_id' => optional($teacherProfile)->id, 'start_time' => '08:00', 'end_time' => '10:00', 'is_active' => true]
            ));
        }

        for ($i = 1; $i <= 5; $i++) {
            $studentUser = User::updateOrCreate(
                ['email' => "student{$i}@student.com"],
                [
                    'name' => "Student {$i}",
                    'password' => bcrypt('admin@123'),
                    'role_id' => $roles['student']->id,
                    'status' => 'active',
                ]
            );
            $studentUser->roles()->sync([$roles['student']->id]);

            $student = Student::updateOrCreate(
                ['user_id' => $studentUser->id],
                [
                    'admission_no' => 'ADM' . date('Y') . str_pad((string) $i, 4, '0', STR_PAD_LEFT),
                    'first_name' => 'Student',
                    'last_name' => (string) $i,
                    'gender' => $i % 2 === 0 ? 'male' : 'female',
                    'status' => 'active',
                ]
            );

            $student->batches()->syncWithoutDetaching([$batches->random()->id]);
        }

        $this->command->info('Dummy data seeded successfully with RBAC mappings.');
    }
}
