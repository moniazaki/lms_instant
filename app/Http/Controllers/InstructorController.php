<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{
    public function dashboard()
    {
        $instructor = auth()->user();
        $courses = $instructor->courses;
        return view('instructor.dashboard', compact('courses'));
    }


    // ------------------------------------- Tasks ----------------------------------------------
    public function indexTasks()
    {

        $tasks = Task::all();
        return view('instructor.tasks.index', compact('tasks'));
    }
    public function createTasks()
    {
        $sessions = Session::all();

        return view('instructor.tasks.create',compact('sessions'));
    }
    public function storeTasks(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:sessions,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $tasks = Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'session_id' => $request->input('session_id'),
            'instructor_id' => auth()->id(), 
        ]);
        return redirect()->route('instructor.tasks.index')->with('success', 'Task created successfully.');
    }
    public function editTasks($id)
    {
        $tasks = Task::find($id);
        return view('instructor.tasks.update', compact('tasks'));
    }
    public function updateTasks(Request $request, $id)
    {
        $tasks = Task::find($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        $tasks->title = $request->input('title');
        $tasks->description = $request->input('description');
        $tasks->save();

        return redirect()->route('instructor.tasks.index')->with('success', 'Task updated successfully.');
    }
    public function destroyTasks($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
        return redirect()->route(route: 'instructor.tasks.index')->with('success', 'Task deleted successfully.');
    }

    // ------------------------------ Sessions ------------------------------------------------
    public function indexSessions()
    {
        $sessions = Session::all();
        return view('instructor.sessions.index', compact('sessions'));
    }
    public function createSessions()
    {
        $instructor = auth()->user();
        $courses = $instructor->courses;
        return view('instructor.sessions.create', compact('courses'));
    }
    public function storeSessions(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,flv|max:20000',
        ]);

        if ($request->hasFile('video_path')) {
            $videoPath = $request->file('video_path')->store('videos', 'public');
        } else {
            $videoPath = null;
        }

        Session::create([
            'course_id' => $request->course_id,
            'title' => $request->title,
            'description' => $request->description,
            'video_path' => $videoPath,
        ]);

        return redirect()->route('instructor.sessions.index')->with('success', 'Session created successfully.');
    }
    public function editSessions($id)
    {
        $sessions = Session::find($id);
        return view('instructor.sessions.update', data: compact('sessions'));
    }
    public function updateSessions(Request $request, $id)
    {
        $sessions = Session::find($id);
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video_path' => 'nullable|file|mimes:mp4,mov,avi,flv|max:20000',
        ]);
        if ($request->hasFile('video_path')) {
            if ($sessions->video_path) {
                Storage::disk('public')->delete($sessions->video_path);
            }
            $videoPath = $request->file('video_path')->store('videos', 'public');
        } else {
            $videoPath = $sessions->video_path;
        }

        $sessions->course_id = $request->input('course_id');
        $sessions->title = $request->input('title');
        $sessions->description = $request->input('description');
        $sessions->video_path = $videoPath;

        $sessions->save();

        return redirect()->route('instructor.sessions.index')->with('success', 'Session updated successfully.');
    }
    public function destroySessions($id)
    {
        $sessions = Session::find($id);
        if ($sessions->video_path) {
            Storage::disk('public')->delete($sessions->video_path);
        }
        $sessions->delete();

        return redirect()->route('instructor.sessions.index')->with('success', 'Session deleted successfully.');
    }
}
