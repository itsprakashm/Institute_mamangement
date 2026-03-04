<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;
use App\Models\ClassModel;
use App\Models\User;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with(['studentClass', 'teacher'])->paginate(10);
        return view('batches.index', compact('batches'));
    }

    public function create()
    {
        $classes = ClassModel::all();
        $teachers = User::all();
        return view('batches.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'name'       => 'required|string|max:191',
            'teacher_id' => 'nullable|exists:users,id',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'   => 'nullable|date_format:H:i|after:start_time',
            'is_active'  => 'boolean',
        ]);

        Batch::create([
            'class_id'   => $request->class_id,
            'name'       => $request->name,
            'teacher_id' => $request->teacher_id,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'is_active'  => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch created successfully!');
    }

    public function edit($id)
    {
        $batch    = Batch::findOrFail($id);
        $classes  = ClassModel::all();
        $teachers = User::all();
        return view('batches.edit', compact('batch', 'classes', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $batch = Batch::findOrFail($id);

        $request->validate([
            'class_id'   => 'required|exists:classes,id',
            'name'       => 'required|string|max:191',
            'teacher_id' => 'nullable|exists:users,id',
            'start_time' => 'nullable|date_format:H:i',
            'end_time'   => 'nullable|date_format:H:i|after:start_time',
        ]);

        $batch->update([
            'class_id'   => $request->class_id,
            'name'       => $request->name,
            'teacher_id' => $request->teacher_id,
            'start_time' => $request->start_time,
            'end_time'   => $request->end_time,
            'is_active'  => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('batches.index')->with('success', 'Batch updated successfully!');
    }

    public function destroy($id)
    {
        Batch::findOrFail($id)->delete();
        return redirect()->route('batches.index')->with('success', 'Batch deleted successfully!');
    }
}
