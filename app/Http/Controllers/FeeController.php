<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\FeeStructure;
use App\Models\Student;
use App\Models\StudentFee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    public function index()
    {
        $structures = FeeStructure::with('course')->paginate(15);
        return view('fees.index', compact('structures'));
    }

    public function createStructure()
    {
        $classes = Course::all();
        return view('fees.create_structure', compact('classes'));
    }

    public function storeStructure(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'fee_type'    => 'required|in:admission,monthly,exam,other',
            'amount'      => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        FeeStructure::updateOrCreate(
            ['course_id' => $request->course_id, 'fee_type' => $request->fee_type],
            ['amount' => $request->amount, 'description' => $request->description]
        );

        return redirect()->route('fees.index')->with('success', 'Fee structure saved!');
    }

    public function collect(Request $request)
    {
        $students = Student::where('status', 'active')->get();
        $selectedStudent = null;
        $fees = collect();

        if ($request->student_id) {
            $selectedStudent = Student::findOrFail($request->student_id);
            $fees = StudentFee::where('student_id', $request->student_id)->orderBy('month', 'desc')->paginate(12);
        }

        return view('fees.collect', compact('students', 'selectedStudent', 'fees'));
    }

    public function generateFee(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month'      => 'required',
            'amount'     => 'required|numeric|min:0',
            'due_date'   => 'nullable|date',
        ]);

        StudentFee::firstOrCreate(
            ['student_id' => $request->student_id, 'month' => $request->month],
            [
                'amount' => $request->amount,
                'status' => 'pending',
                'due_date' => $request->due_date ?: Carbon::parse($request->month . '-01')->endOfMonth()->toDateString(),
            ]
        );

        return redirect()->route('fees.collect', ['student_id' => $request->student_id])->with('success', 'Fee entry created!');
    }

    public function markPaid(Request $request, $id)
    {
        $fee = StudentFee::findOrFail($id);
        $fee->update(['status' => 'paid', 'paid_date' => now()->toDateString()]);

        return back()->with('success', 'Fee marked as paid!');
    }

    public function report(Request $request)
    {
        $students = Student::where('status', 'active')->get();

        $query = StudentFee::with('student');
        if ($request->student_id) {
            $query->where('student_id', $request->student_id);
        }
        if ($request->status) {
            $query->where('status', $request->status);
        }
        if ($request->month) {
            $query->where('month', $request->month);
        }

        $records = $query->orderBy('month', 'desc')->paginate(20);

        return view('fees.report', compact('students', 'records'));
    }
}
