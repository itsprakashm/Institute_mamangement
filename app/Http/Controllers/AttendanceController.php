<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Show the form to mark attendance for a batch on a given date.
     */
    public function mark(Request $request)
    {
        $batches = Batch::with('studentClass')->where('is_active', true)->get();

        $selectedBatch = null;
        $students = collect();
        $selectedDate = $request->date ?? Carbon::today()->format('Y-m-d');
        $existingAttendance = collect();

        if ($request->batch_id) {
            $selectedBatch = Batch::findOrFail($request->batch_id);
            $students = Student::where('batch_id', $request->batch_id)
                               ->where('status', 'active')
                               ->get();

            $existingAttendance = Attendance::where('batch_id', $request->batch_id)
                                            ->where('date', $selectedDate)
                                            ->get()
                                            ->keyBy('student_id');
        }

        return view('attendance.mark', compact('batches', 'selectedBatch', 'students', 'selectedDate', 'existingAttendance'));
    }

    /**
     * Save/update attendance records for the batch on the date.
     */
    public function save(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'date'     => 'required|date',
        ]);

        $students = Student::where('batch_id', $request->batch_id)
                           ->where('status', 'active')
                           ->get();

        foreach ($students as $student) {
            $status = $request->input("attendance.{$student->id}", 'absent');

            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'batch_id'   => $request->batch_id,
                    'date'       => $request->date,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('attendance.mark', [
            'batch_id' => $request->batch_id,
            'date'     => $request->date,
        ])->with('success', 'Attendance saved successfully!');
    }

    /**
     * Show attendance report — filterable by batch and date range.
     */
    public function report(Request $request)
    {
        $batches = Batch::with('studentClass')->where('is_active', true)->get();

        $query = Attendance::with(['student', 'batch']);

        if ($request->batch_id) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->from_date) {
            $query->where('date', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->where('date', '<=', $request->to_date);
        }

        $records = $query->orderBy('date', 'desc')->paginate(20);

        return view('attendance.report', compact('batches', 'records'));
    }
}
