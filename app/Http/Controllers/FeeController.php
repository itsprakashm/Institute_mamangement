<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeeStructure;
use App\Models\StudentFee;
use App\Models\Student;
use App\Models\ClassModel;
use Carbon\Carbon;

class FeeController extends Controller
{
    /**
     * Fee Structures index.
     */
    public function index()
    {
        $structures = FeeStructure::with('studentClass')->paginate(15);
        return view('fees.index', compact('structures'));
    }

    public function createStructure()
    {
        $classes = ClassModel::all();
        return view('fees.create_structure', compact('classes'));
    }

    public function storeStructure(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'monthly_fee'=> 'required|numeric|min:0',
            'description'=> 'nullable|string',
        ]);

        FeeStructure::updateOrCreate(
            ['class_id' => $request->class_id],
            ['monthly_fee' => $request->monthly_fee, 'description' => $request->description]
        );

        return redirect()->route('fees.index')->with('success', 'Fee structure saved!');
    }

    /**
     * Fee collection — list pending fees for a student.
     */
    public function collect(Request $request)
    {
        $students = Student::where('status', 'active')->get();
        $selectedStudent = null;
        $fees = collect();

        if ($request->student_id) {
            $selectedStudent = Student::with('studentClass')->findOrFail($request->student_id);
            $fees = StudentFee::where('student_id', $request->student_id)
                              ->orderBy('month', 'desc')
                              ->paginate(12);
        }

        return view('fees.collect', compact('students', 'selectedStudent', 'fees'));
    }

    /**
     * Generate monthly fee for a student.
     */
    public function generateFee(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'month'      => 'required',
            'amount'     => 'required|numeric|min:0',
        ]);

        StudentFee::firstOrCreate(
            ['student_id' => $request->student_id, 'month' => $request->month],
            ['amount' => $request->amount, 'status' => 'pending']
        );

        return redirect()->route('fees.collect', ['student_id' => $request->student_id])
                         ->with('success', 'Fee entry created!');
    }

    /**
     * Mark a fee as paid.
     */
    public function markPaid(Request $request, $id)
    {
        $fee = StudentFee::findOrFail($id);
        $fee->update(['status' => 'paid', 'paid_date' => now()->toDateString()]);

        return back()->with('success', 'Fee marked as paid!');
    }

    /**
     * Fee report.
     */
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
