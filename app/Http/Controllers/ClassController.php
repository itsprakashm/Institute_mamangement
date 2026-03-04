<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Course::paginate(10);
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191|unique:courses,name',
            'description' => 'nullable|string',
        ]);

        Course::create($request->only('name', 'description'));

        return redirect()->route('classes.index')->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        $class = Course::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $class = Course::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:191|unique:courses,name,' . $class->id,
            'description' => 'nullable|string',
        ]);

        $class->update($request->only('name', 'description'));

        return redirect()->route('classes.index')->with('success', 'Course updated successfully!');
    }

    public function destroy($id)
    {
        $class = Course::findOrFail($id);
        $class->delete();
        return redirect()->route('classes.index')->with('success', 'Course deleted successfully!');
    }
}
