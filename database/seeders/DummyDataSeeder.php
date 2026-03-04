<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\ClassModel;
use App\Models\Batch;
use App\Models\Student;
use App\Models\FeeStructure;
use App\Models\Announcement;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // 1. Ensure Roles exist
        $roleNames = [
            'super_admin' => 'Super Admin',
            'admin'       => 'Admin',
            'teacher'     => 'Teacher',
            'student'     => 'Student',
            'accountant'  => 'Accountant',
            'reception'   => 'Reception',
        ];

        $roles = [];
        foreach ($roleNames as $name => $displayName) {
            $roles[$name] = Role::firstOrCreate(['name' => $name], ['display_name' => $displayName]);
        }

        // 2. Create Super Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'System Admin',
                'password' => bcrypt('admin@123'),
                'role_id' => $roles['super_admin']->id,
            ]
        );
        $admin->roles()->sync([$roles['super_admin']->id]);

        // 3. Create Accountant
        $accountant = User::updateOrCreate(
            ['email' => 'accountant@admin.com'],
            [
                'name' => 'Main Accountant',
                'password' => bcrypt('admin@123'),
                'role_id' => $roles['accountant']->id,
            ]
        );
        $accountant->roles()->sync([$roles['accountant']->id]);

        // 4. Create Receptionist
        $reception = User::updateOrCreate(
            ['email' => 'reception@admin.com'],
            [
                'name' => 'Main Reception',
                'password' => bcrypt('admin@123'),
                'role_id' => $roles['reception']->id,
            ]
        );
        $reception->roles()->sync([$roles['reception']->id]);

        // 5. Create Teachers
        for ($i = 1; $i <= 3; $i++) {
            $teacherUser = User::updateOrCreate(
                ['email' => "teacher{$i}@admin.com"],
                [
                    'name' => "Teacher $i",
                    'password' => bcrypt('admin@123'),
                    'role_id' => $roles['teacher']->id,
                ]
            );
            $teacherUser->roles()->sync([$roles['teacher']->id]);
        }
        $teachers = User::whereHas('roles', fn($q) => $q->where('name', 'teacher'))->get();

        // 6. Create Classes
        $classNames = ['Class 10th', 'Class 11th', 'Class 12th', 'NEET Section', 'JEE Section'];
        $classes = [];
        foreach ($classNames as $name) {
            $classes[] = ClassModel::firstOrCreate(['name' => $name], ['description' => "$name description"]);
        }

        // 7. Create Fee Structures
        foreach ($classes as $class) {
            FeeStructure::updateOrCreate(
                ['class_id' => $class->id],
                ['monthly_fee' => rand(1000, 3000), 'description' => 'Tuition fee']
            );
        }

        // 8. Create Batches
        foreach ($classes as $class) {
            $teacher = $teachers->random();
            Batch::updateOrCreate(
                ['class_id' => $class->id, 'name' => "Batch A - Morning"],
                [
                    'teacher_id' => $teacher->id,
                    'start_time' => '08:00:00',
                    'end_time' => '11:00:00',
                    'is_active' => true,
                ]
            );
        }

        // 9. Create Students and Link Users
        $batches = Batch::all();
        $studentCounter = 1;
        foreach ($batches as $batch) {
            for ($j = 1; $j <= 5; $j++) {
                $email = "student{$studentCounter}@student.com";
                $studentUser = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => "Student Name $studentCounter",
                        'password' => bcrypt('admin@123'),
                        'role_id' => $roles['student']->id,
                    ]
                );
                $studentUser->roles()->sync([$roles['student']->id]);

                Student::updateOrCreate(
                    ['user_id' => $studentUser->id],
                    [
                        'admission_no' => "ADM2026" . str_pad($studentCounter, 4, '0', STR_PAD_LEFT),
                        'first_name' => "Student",
                        'last_name' => (string)$studentCounter,
                        'gender' => ($studentCounter % 2 == 0 ? 'male' : 'female'),
                        'dob' => '2010-06-15',
                        'class_id' => $batch->class_id,
                        'batch_id' => $batch->id,
                        'status' => 'active',
                    ]
                );
                $studentCounter++;
            }
        }

        // 10. Create Announcements
        Announcement::create([
            'title' => 'Welcome Note',
            'message' => 'Welcome to Mbclasses management system!',
            'created_by' => $admin->id,
        ]);

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->command->info('Dummy data seeded successfully with student logins!');
    }
}
