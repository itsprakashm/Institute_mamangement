<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\Batch;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['studentClass', 'batch'])->paginate(10);
        return view('students.index', compact('students'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $batches = Batch::all();
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
            'class_id' => 'nullable|exists:classes,id',
            'batch_id' => 'nullable|exists:batches,id',
            'status' => 'required|in:active,inactive,deleted',
        ]);

        $data = $request->except('photo');
        $data['admission_no'] = Student::generateAdmissionNo();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'student_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
            $data['photo'] = 'uploads/students/' . $filename;
        }

        Student::create($data);

        return redirect()->route('students.index')->with('success', 'Student admitted successfully!');
    }

    public function show($id)
    {
        $student = Student::with(['studentClass', 'batch'])->findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $classes = ClassModel::all();
        $batches = Batch::all();
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
            'class_id' => 'nullable|exists:classes,id',
            'batch_id' => 'nullable|exists:batches,id',
            'status' => 'required|in:active,inactive,deleted',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = 'student_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/students'), $filename);
            $data['photo'] = 'uploads/students/' . $filename;
        }

        $student->update($data);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
