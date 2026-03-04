<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::with('author')->orderBy('created_at', 'desc')->paginate(10);
        return view('announcements.index', compact('announcements'));
    }

    public function create()
    {
        return view('announcements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Announcement::create([
            'title'      => $request->title,
            'message'    => $request->message,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement published successfully!');
    }

    public function destroy($id)
    {
        Announcement::findOrFail($id)->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement deleted!');
    }
}
