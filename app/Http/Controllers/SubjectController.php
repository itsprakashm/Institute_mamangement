<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::orderBy('name')->get();
        return view('classes.subject', compact('subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'nullable|string|max:20',
        ]);

        Subject::create($request->only('name', 'code'));

        return redirect()->route('subjects.index')->with('success', 'Subject added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'nullable|string|max:20',
            'is_active' => 'nullable',
        ]);

        $subject = Subject::findOrFail($id);
        $subject->update([
            'name' => $request->name,
            'code' => $request->code,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('subjects.index')->with('success', 'Subject updated successfully!');
    }

    public function destroy($id)
    {
        Subject::findOrFail($id)->delete();
        return redirect()->route('subjects.index')->with('success', 'Subject deleted successfully!');
    }
}
