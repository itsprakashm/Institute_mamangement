<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('name')->get();
        return view('classes.list', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        Course::create($request->only('name', 'code', 'description'));

        return redirect()->route('courses.index')->with('success', 'Course added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'nullable|string|max:20',
            'description' => 'nullable|string',
            'is_active' => 'nullable',
        ]);

        $course = Course::findOrFail($id);
        $course->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}
