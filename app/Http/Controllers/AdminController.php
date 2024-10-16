<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function dashboard(){
        return view('admin.dashboard');
    }



    //----------------------------------- Students-------------------------------------------------

    public function indexStudents(){
        $students = User::where('role','student')->get();
        return view('admin.students.index',compact('students'));
    }
    public function createStudents(){
        return view('admin.students.create');
    }
    public function editStudents($id){

        $students = User::find($id);
        return view('admin.students.update',compact('students'));
    }
    public function updateStudents(Request $request,$id){
        $students = User::find($id);
        $request ->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,'.$students->id,
            ]
            );
            $students->name = $request->input('name');
            $students->email = $request->input('email');
            $students->save();
            return redirect()->route('admin.students.index')->with('success','Student updated successfully.');
    }
    public function destroyStudents($id){
        $students = User::find($id);
        $students->delete();
        return redirect()->route('admin.students.index')->with('delete','Student deleted successfully.');
    }

    //---------------------------------- Instructors----------------------------------------------
    public function indexInstructors(){
        $instructors = User::where('role','instructor')->get();
        return view('admin.instructors.index',compact('instructors'));
    }
    public function createInstructor(){
        return view('admin.instructors.create');
    }

    public function storeInstructor(Request $request){

        $request->validate([
            'name' =>'required|string|max:255',
            "email"=> 'required|email|string|max:255|unique:users',
        ]);

        $password = Str::random(8);

        $instructors = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 'instructor',
        ]);
        return redirect ()->route('admin.instructors.index')->with('success', 'Instructor created successfully. Credentials: Email: '.$instructors->email.' Password: '.$password);
    }
    public function editInstructor($id){
        $instructors = User::find($id);
        return view('admin.instructors.update',compact('instructors'));
    }
    public function updateInstructor(Request $request,$id){
        $instructors = User::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$instructors->id,
        ]);
        $instructors->name = $request->input('name');
        $instructors->email = $request->input('email');

        $instructors->save();

        return redirect()->route('admin.instructors.index')->with('success', 'Instructor updated successfully.');
    }

    public function destroyInstructor($id)
    {
        $instructor = User::findOrFail($id);
        $instructor->delete();

        return redirect()->route('admin.instructors.index')->with('delete', value: 'Instructor deleted successfully.');
    }
    //---------------------------------- Courses ----------------------------------------------
    public function indexCourses()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    public function createCourse()
    {
        return view('admin.courses.create');
    }

    public function storeCourse(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $courses = Course::create($request->only('name', 'description'));

        return redirect()->route('admin.courses.index')->with('success', 'Course created successfully.');
    }

    public function editCourse($id)
    {
        $courses = Course::find($id);
        return view('admin.courses.update', compact('courses'));
    }

    public function updateCourse(Request $request, $id)
    {
        $courses = Course::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $courses->name = $request->input('name');
        $courses->description = $request->input('description');

        $courses->save();

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroyCourse($id)
    {
        $courses = Course::find($id);
        $courses->delete();

        return redirect()->route('admin.courses.index')->with('delete', 'Course deleted successfully.');
    }

    //---------------------- Instructor Assign to Course ----------------
    public function assign()
{
    $courses = Course::all();
    $instructors = User::where('role', 'instructor')->get();

    return view('admin.courses.assign', compact('courses', 'instructors'));
}
public function assignInstructor(Request $request)
{


    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'instructor_id' => 'required|exists:users,id',
    ]);

    $course = Course::findOrFail($request->course_id);

    $course->instructor_id = $request->instructor_id;
    $course->save();
    

    return redirect()->route('admin.courses.index')->with('success', 'Instructor assigned to course successfully.');
}


}
