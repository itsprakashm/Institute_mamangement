<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Course;
use App\Models\Batch;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('batches.course')->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classes = Course::all();
        $batches = Batch::with('course')->get();
        $admissionNo = Student::generateAdmissionNo();
        return view('students.create', compact('classes', 'batches', 'admissionNo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'gender' => 'required|in:male,female,other',
            'dob' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'guardian_name' => 'nullable|string|max:191',
            'guardian_phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
            'status' => 'required|in:active,inactive,deleted',
        ]);

        $data = $request->except(['photo', 'batches']);
        $data['admission_no'] = Student::generateAdmissionNo();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student = Student::create($data);
        $student->batches()->sync($request->input('batches', []));

        return redirect()->route('students.index')->with('success', 'Student admitted successfully!');
    }

    public function show($id)
    {
        $student = Student::with('batches.course')->findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::with('batches')->findOrFail($id);
        $classes = Course::all();
        $batches = Batch::with('course')->get();
        return view('students.edit', compact('student', 'classes', 'batches'));
    }

    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);

        $request->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'nullable|string|max:191',
            'gender' => 'required|in:male,female,other',
            'dob' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'guardian_name' => 'nullable|string|max:191',
            'guardian_phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
            'batches' => 'nullable|array',
            'batches.*' => 'exists:batches,id',
            'status' => 'required|in:active,inactive,deleted',
        ]);

        $data = $request->except(['photo', 'batches']);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        $student->update($data);
        $student->batches()->sync($request->input('batches', []));

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
