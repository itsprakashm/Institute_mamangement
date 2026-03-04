<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\StudentFee;
use App\Models\Announcement;
use Carbon\Carbon;

class StudentPortalController extends Controller
{
    /**
     * Student dashboard — overview of attendance, fees, and announcements.
     */
    public function dashboard(Request $request)
    {
        $studentId = $request->student_id;
        $student   = Student::with(['studentClass', 'batch'])->findOrFail($studentId);

        // Attendance summary (last 30 days)
        $thirtyDaysAgo = Carbon::now()->subDays(30)->toDateString();
        $attendanceSummary = Attendance::where('student_id', $studentId)
            ->where('date', '>=', $thirtyDaysAgo)
            ->selectRaw("status, COUNT(*) as count")
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Pending fees count
        $pendingFees = StudentFee::where('student_id', $studentId)
            ->where('status', 'pending')
            ->count();

        // Latest announcements
        $announcements = Announcement::orderBy('created_at', 'desc')->take(5)->get();

        $students = Student::where('status', 'active')->get();

        return view('student.dashboard', compact(
            'student', 'attendanceSummary', 'pendingFees', 'announcements', 'students'
        ));
    }

    /**
     * Student profile.
     */
    public function profile(Request $request)
    {
        $studentId = $request->student_id;
        $student   = Student::with(['studentClass', 'batch'])->findOrFail($studentId);
        $students  = Student::where('status', 'active')->get();

        return view('student.profile', compact('student', 'students'));
    }

    /**
     * Student attendance history.
     */
    public function attendance(Request $request)
    {
        $studentId = $request->student_id;
        $student   = Student::findOrFail($studentId);
        $students  = Student::where('status', 'active')->get();

        $query = Attendance::where('student_id', $studentId);

        if ($request->from_date) {
            $query->where('date', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->where('date', '<=', $request->to_date);
        }

        $records = $query->orderBy('date', 'desc')->paginate(20);

        // Summary
        $totalPresent = Attendance::where('student_id', $studentId)->where('status', 'present')->count();
        $totalAbsent  = Attendance::where('student_id', $studentId)->where('status', 'absent')->count();
        $totalLate    = Attendance::where('student_id', $studentId)->where('status', 'late')->count();

        return view('student.attendance', compact(
            'student', 'students', 'records', 'totalPresent', 'totalAbsent', 'totalLate'
        ));
    }

    /**
     * Student fee history.
     */
    public function fees(Request $request)
    {
        $studentId = $request->student_id;
        $student   = Student::with('studentClass')->findOrFail($studentId);
        $students  = Student::where('status', 'active')->get();

        $fees = StudentFee::where('student_id', $studentId)
            ->orderBy('month', 'desc')
            ->paginate(12);

        $totalPaid    = StudentFee::where('student_id', $studentId)->where('status', 'paid')->sum('amount');
        $totalPending = StudentFee::where('student_id', $studentId)->where('status', 'pending')->sum('amount');

        return view('student.fees', compact(
            'student', 'students', 'fees', 'totalPaid', 'totalPending'
        ));
    }
}
