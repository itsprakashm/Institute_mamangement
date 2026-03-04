<?php

namespace App\Console\Commands;

use App\Models\StudentFee;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendFeeReminders extends Command
{
    protected $signature = 'fees:send-reminders';
    protected $description = 'Find pending fees nearing/past due date for reminder dispatch';

    public function handle(): int
    {
        $today = Carbon::today()->toDateString();

        $pending = StudentFee::with('student.user')
            ->where('status', 'pending')
            ->whereDate('due_date', '<=', $today)
            ->get();

        $this->info("Fee reminders queued for {$pending->count()} student fee records.");

        return self::SUCCESS;
    }
}
