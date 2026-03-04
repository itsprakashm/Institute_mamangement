<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentFee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function students(Request $request)
    {
        $classes = Course::all();
        $batches = Batch::where('is_active', true)->get();

        $query = Student::with('batches.course');

        if ($request->batch_id) {
            $query->whereHas('batches', fn ($q) => $q->where('batches.id', $request->batch_id));
        }
        if ($request->class_id) {
            $query->whereHas('batches', fn ($q) => $q->where('course_id', $request->class_id));
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $students = $query->orderBy('first_name')->paginate(20);

        return view('reports.students', compact('classes', 'batches', 'students'));
    }

    public function attendance(Request $request)
    {
        $classes = Course::all();
        $batches = Batch::with('course')->where('is_active', true)->get();

        $records = collect();
        $fromDate = $request->from_date ?: Carbon::now()->startOfMonth()->toDateString();
        $toDate = $request->to_date ?: Carbon::now()->toDateString();

        if ($request->batch_id) {
            $studentIds = Student::whereHas('batches', fn ($q) => $q->where('batches.id', $request->batch_id))->pluck('id');

            $records = Student::whereIn('id', $studentIds)->get()->map(function ($student) use ($fromDate, $toDate) {
                $attendance = Attendance::where('student_id', $student->id)->whereBetween('date', [$fromDate, $toDate]);

                return (object) [
                    'student' => $student,
                    'present' => (clone $attendance)->where('status', 'present')->count(),
                    'absent' => (clone $attendance)->where('status', 'absent')->count(),
                    'late' => (clone $attendance)->where('status', 'late')->count(),
                    'total' => $attendance->count(),
                ];
            });
        }

        return view('reports.attendance', compact('classes', 'batches', 'records', 'fromDate', 'toDate'));
    }

    public function fees(Request $request)
    {
        $classes = Course::all();
        $batches = Batch::where('is_active', true)->get();
        $studentsFilter = Student::where('status', 'active')->get();

        $query = StudentFee::with('student.batches.course');

        if ($request->student_id) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->batch_id) {
            $query->whereHas('student.batches', fn ($q) => $q->where('batches.id', $request->batch_id));
        }
        if ($request->class_id) {
            $query->whereHas('student.batches', fn ($q) => $q->where('course_id', $request->class_id));
        }
        if ($request->from_date) {
            $query->whereDate('due_date', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->whereDate('due_date', '<=', $request->to_date);
        }

        $students = $query->get();

        return view('reports.fees', compact('classes', 'batches', 'studentsFilter', 'students'));
    }
}
