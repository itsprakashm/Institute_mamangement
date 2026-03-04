<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with(['course', 'teacher.user'])->paginate(10);
        return view('batches.index', compact('batches'));
    }

    public function create()
    {
        $classes = Course::all();
        $teachers = Teacher::with('user')->get();
        return view('batches.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'name'        => 'required|string|max:191',
            'teacher_id'  => 'nullable|exists:teachers,id',
            'start_time'  => 'nullable|date_format:H:i',
            'end_time'    => 'nullable|date_format:H:i|after:start_time',
            'is_active'   => 'boolean',
        ]);

        Batch::create([
            'course_id'   => $request->course_id,
            'name'        => $request->name,
            'teacher_id'  => $request->teacher_id,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch created successfully!');
    }

    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        $classes = Course::all();
        $teachers = Teacher::with('user')->get();
        return view('batches.edit', compact('batch', 'classes', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'name'        => 'required|string|max:191',
            'teacher_id'  => 'nullable|exists:teachers,id',
            'start_time'  => 'nullable|date_format:H:i',
            'end_time'    => 'nullable|date_format:H:i|after:start_time',
        ]);

        $batch->update([
            'course_id'   => $request->course_id,
            'name'        => $request->name,
            'teacher_id'  => $request->teacher_id,
            'start_time'  => $request->start_time,
            'end_time'    => $request->end_time,
            'is_active'   => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch updated successfully!');
    }

    public function destroy($id)
    {
        Batch::findOrFail($id)->delete();
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully!');
    }
}
