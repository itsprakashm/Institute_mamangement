<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses = [
            'JAC+1', 'JAC+2', 'ISC+1', 'ISC+2', 'CBSE+1', 'CBSE+2', 
            'B.COM PART1', 'B.COM PART2', 'B.COM PART3',
            'B.COM SEM 1', 'B.COM SEM 2', 'B.COM SEM 3', 'B.COM SEM 4', 'B.COM SEM 5', 'B.COM SEM 6', 'B.COM SEM 7', 'B.COM SEM 8',
            'M.COM SEM 1', 'M.COM SEM 2', 'M.COM SEM 3', 'M.COM SEM 4',
            'BBA SEM 1', 'BBA SEM 2', 'BBA SEM 3', 'BBA SEM 4', 'BBA SEM 5', 'BBA SEM 6', 'BBA SEM 7', 'BBA SEM 8',
            'CA', 'CS', 'CMA', 'NIOS', 'OTHERS'
        ];

        foreach ($courses as $course) {
            \App\Models\Course::firstOrCreate(['name' => $course]);
        }

        $sections = ['A', 'B', 'Morning', 'Evening'];
        foreach ($sections as $section) {
            \App\Models\Section::firstOrCreate(['name' => $section]);
        }

        $subjects = [
            ['name' => 'Accounts', 'code' => 'ACC101'],
            ['name' => 'Economics', 'code' => 'ECO101'],
            ['name' => 'Business Studies', 'code' => 'BST101'],
            ['name' => 'English', 'code' => 'ENG101'],
            ['name' => 'Mathematics', 'code' => 'MAT101'],
        ];

        foreach ($subjects as $subject) {
            \App\Models\Subject::firstOrCreate(['name' => $subject['name']], ['code' => $subject['code']]);
        }
    }
}
