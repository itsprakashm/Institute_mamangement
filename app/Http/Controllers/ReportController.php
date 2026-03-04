<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\StudentFee;
use App\Models\ClassModel;
use App\Models\Batch;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Student report — list all students with filters.
     */
    public function students(Request $request)
    {
        $classes = ClassModel::all();
        $batches = Batch::where('is_active', true)->get();

        $query = Student::with(['studentClass', 'batch']);

        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }
        if ($request->batch_id) {
            $query->where('batch_id', $request->batch_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $students = $query->orderBy('first_name')->paginate(20);

        return view('reports.students', compact('classes', 'batches', 'students'));
    }

    /**
     * Attendance report — summary per student for a date range.
     */
    public function attendance(Request $request)
    {
        $batches = Batch::with('studentClass')->where('is_active', true)->get();

        $records = collect();
        $fromDate = $request->from_date ?: Carbon::now()->startOfMonth()->toDateString();
        $toDate   = $request->to_date   ?: Carbon::now()->toDateString();

        if ($request->batch_id) {
            $studentIds = Student::where('batch_id', $request->batch_id)->pluck('id');

            $records = Student::whereIn('id', $studentIds)->get()->map(function ($student) use ($fromDate, $toDate) {
                $attendance = Attendance::where('student_id', $student->id)
                    ->whereBetween('date', [$fromDate, $toDate]);

                return (object)[
                    'student'  => $student,
                    'present'  => (clone $attendance)->where('status', 'present')->count(),
                    'absent'   => (clone $attendance)->where('status', 'absent')->count(),
                    'late'     => (clone $attendance)->where('status', 'late')->count(),
                    'total'    => $attendance->count(),
                ];
            });
        }

        return view('reports.attendance', compact('batches', 'records', 'fromDate', 'toDate'));
    }

    /**
     * Fee report — summary per student.
     */
    public function fees(Request $request)
    {
        $classes = ClassModel::all();

        $query = Student::with('studentClass')->where('status', 'active');

        if ($request->class_id) {
            $query->where('class_id', $request->class_id);
        }

        $students = $query->get()->map(function ($student) {
            $fees = StudentFee::where('student_id', $student->id);
            return (object)[
                'student'      => $student,
                'total_fees'   => (clone $fees)->sum('amount'),
                'total_paid'   => (clone $fees)->where('status', 'paid')->sum('amount'),
                'total_pending'=> (clone $fees)->where('status', 'pending')->sum('amount'),
            ];
        });

        return view('reports.fees', compact('classes', 'students'));
    }
}
