<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function mark(Request $request)
    {
        $batches = Batch::with('course')->where('is_active', true)->get();

        $selectedBatch = null;
        $students = collect();
        $selectedDate = $request->date ?? Carbon::today()->format('Y-m-d');
        $existingAttendance = collect();

        if ($request->batch_id) {
            $selectedBatch = Batch::findOrFail($request->batch_id);
            $students = Student::whereHas('batches', function ($query) use ($request) {
                $query->where('batches.id', $request->batch_id);
            })->where('status', 'active')->get();

            $existingAttendance = Attendance::where('batch_id', $request->batch_id)
                ->where('date', $selectedDate)
                ->get()
                ->keyBy('student_id');
        }

        return view('attendance.mark', compact('batches', 'selectedBatch', 'students', 'selectedDate', 'existingAttendance'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'batch_id' => 'required|exists:batches,id',
            'date' => 'required|date',
        ]);

        $students = Student::whereHas('batches', function ($query) use ($request) {
            $query->where('batches.id', $request->batch_id);
        })->where('status', 'active')->get();

        foreach ($students as $student) {
            $status = $request->input("attendance.{$student->id}", 'absent');

            Attendance::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'batch_id' => $request->batch_id,
                    'date' => $request->date,
                ],
                ['status' => $status]
            );
        }

        return redirect()->route('attendance.mark', ['batch_id' => $request->batch_id, 'date' => $request->date])
            ->with('success', 'Attendance saved successfully!');
    }

    public function report(Request $request)
    {
        $batches = Batch::with('course')->where('is_active', true)->get();

        $query = Attendance::with(['student', 'batch']);
        if ($request->batch_id) {
            $query->where('batch_id', $request->batch_id);
        }
        if ($request->student_id) {
            $query->where('student_id', $request->student_id);
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
