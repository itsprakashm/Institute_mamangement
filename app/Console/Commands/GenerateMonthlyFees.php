<?php

namespace App\Console\Commands;

use App\Models\FeeStructure;
use App\Models\Student;
use App\Models\StudentFee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateMonthlyFees extends Command
{
    protected $signature = 'fees:generate-monthly';
    protected $description = 'Generate monthly fee entries for active students';

    public function handle(): int
    {
        $month = Carbon::now()->format('Y-m');
        $dueDate = Carbon::now()->endOfMonth()->toDateString();

        $students = Student::where('status', 'active')->with('batches.course')->get();
        $created = 0;

        foreach ($students as $student) {
            $courseId = optional($student->batches->first())->course_id;
            if (!$courseId) {
                continue;
            }

            $monthlyAmount = FeeStructure::where('course_id', $courseId)
                ->where('fee_type', 'monthly')
                ->value('amount');

            if (!$monthlyAmount) {
                continue;
            }

            $fee = StudentFee::firstOrCreate(
                ['student_id' => $student->id, 'month' => $month],
                ['amount' => $monthlyAmount, 'status' => 'pending', 'due_date' => $dueDate]
            );

            if ($fee->wasRecentlyCreated) {
                $created++;
            }
        }

        $this->info("Monthly fee generation completed. Created: {$created}");
        return self::SUCCESS;
    }
}
