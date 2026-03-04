<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::orderBy('name')->get();
        return view('classes.section', compact('sections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:191',
        ]);

        Section::create($request->only('name'));

        return redirect()->route('sections.index')->with('success', 'Section added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'is_active' => 'nullable',
        ]);

        $section = Section::findOrFail($id);
        $section->update([
            'name' => $request->name,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('sections.index')->with('success', 'Section updated successfully!');
    }

    public function destroy($id)
    {
        Section::findOrFail($id)->delete();
        return redirect()->route('sections.index')->with('success', 'Section deleted successfully!');
    }
}
