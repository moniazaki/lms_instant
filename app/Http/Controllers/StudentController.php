<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Task;
use App\Models\User;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

    public function dashboard($id = null)
    {
        $student = $id ? User::find($id) : Auth::user();
        return view('student.dashboard', compact('student'));
    }



    public function register($id = null)
    {
        $student = $id ? User::where('id', $id)->where('role', 'student')->first() : Auth::user();
        $courses = Course::all();

        return view('student.courses.register', compact('student', 'courses'));
    }
    public function registerForCourse(Request $request, $id = null)
    {

        $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = $id ? User::findOrFail($id) : Auth::user();
        $course = Course::find($request->course_id);


        if (!$student->enrolledCourses->contains($course->id)) {

            $student->enrolledCourses()->attach($course);

            return redirect()->route('student.courses.list', ['id' => $student->id])->with('success', 'Successfully registered for the course.');
        } else {
            return redirect()->route('student.courses.list', ['id' => $student->id])->with('error', 'You are already registered for this course.');
        }
    }
    public function submit($id)
    {
        $tasks = Task::find($id); // Fetch all tasks
        return view('student.solutions.submit', compact('tasks'));
    }

    public function submitSolution(Request $request)
{
    // Validate the request
    $request->validate([
        'task_id' => 'required|exists:tasks,id', // Ensure the task exists
        'solution_link' => 'required|file|mimes:pdf,docx,txt|max:10000',
    ]);

    $student = Auth::user(); // Get the authenticated user

    // Store the uploaded solution file
    $solutionFilePath = $request->file('solution_link')->store('solutions', 'public');

    // Create a new solution entry
    Solution::create([
        'student_id' => $student->id, // Make sure this is the correct field name
        'task_id' => $request->task_id, // Use task_id from request
        'solution_link' => $solutionFilePath,
    ]);

    return redirect()->route('student.solutions.list', parameters: ['id' => $student->id])
        ->with('success', 'Solution submitted successfully.');
}




    public function listCourses($id = null)
    {
        $student = $id ? User::findOrFail($id) : Auth::user();
        $courses = $student->enrolledCourses;

        return view('student.courses.index', compact('courses', 'student')); // Return view with enrolled courses
    }


    public function listTasks($id = null)
    {
        $student = $id ? User::findOrFail($id) : Auth::user();


        $sessions = $student->enrolledCourses->flatMap(function ($course) {
            return $course->sessions;
        });


        $tasks = Task::whereIn('session_id', $sessions->pluck('id'))->get();

        return view('student.tasks.index', compact('tasks', 'student'));
    }


    public function listSolutions($id = null)
{
    $student = $id ? User::find($id) : Auth::user();
    $solutions = Solution::where('student_id', $student->id)->with('task')->get(); // Eager load task relationship

    return view('student.solutions.index', compact('solutions', 'student')); // Return view with solutions
}
public function download($id)
{
    // Find the solution by ID
    $solution = Solution::findOrFail($id);

    // Get the file path
    $filePath = $solution->solution_link;

    // Return the download response
    return response()->download(storage_path('app/public/' . $filePath));
}
}



