<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('register');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin Routes
Route::middleware(['checkAdmin'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/students', [AdminController::class, 'indexStudents'])->name('students.index');
        Route::get('/students/create', [AdminController::class, 'createStudents'])->name('students.create');
        Route::post('/students/store', [AdminController::class, 'storeStudents'])->name('students.store');
        Route::get('/students/edit/{id}', [AdminController::class, 'editStudents'])->name('students.edit');
        Route::post('/students/update/{id}', [AdminController::class, 'updateStudents'])->name('students.update');
        Route::get('/students/destroy/{id}', [AdminController::class, 'destroyStudents'])->name('students.destroy');
        Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');

        Route::get('/courses', [AdminController::class, 'indexCourses'])->name('courses.index');
        Route::get('/courses/create', [AdminController::class, 'createCourse'])->name('courses.create');
        Route::post('/courses/store', [AdminController::class, 'storeCourse'])->name('courses.store');
        Route::get('/courses/edit/{id}', [AdminController::class, 'editCourse'])->name('courses.edit');
        Route::post('/courses/update/{id}', [AdminController::class, 'updateCourse'])->name('courses.update');
        Route::get('/courses/destroy/{id}', [AdminController::class, 'destroyCourse'])->name('courses.destroy');
        Route::get('/courses/assign', [AdminController::class, 'assign'])->name('courses.assign');
        Route::post('/courses/assignInstructor', [AdminController::class, 'assignInstructor'])->name('courses.assignInstructor');

        Route::get('/instructors', [AdminController::class, 'indexInstructors'])->name('instructors.index');
        Route::get('/instructors/create', [AdminController::class, 'createInstructor'])->name('instructors.create');
        Route::post('/instructors/store', [AdminController::class, 'storeInstructor'])->name('instructors.store');
        Route::get('/instructors/edit/{id}', [AdminController::class, 'editInstructor'])->name('instructors.edit');
        Route::post('/instructors/update/{id}', [AdminController::class, 'updateInstructor'])->name('instructors.update');
        Route::get('/instructors/destroy/{id}', [AdminController::class, 'destroyInstructor'])->name('instructors.destroy');
    });
});

// Instructor Routes
Route::middleware(['checkInstructor'])->group(function () {
    Route::prefix('instructor')->name('instructor.')->group(function () {
        Route::get('/tasks', [InstructorController::class, 'indexTasks'])->name('tasks.index');
        Route::get('/tasks/create', [InstructorController::class, 'createTasks'])->name('tasks.create');
        Route::post('/tasks/store', [InstructorController::class, 'storeTasks'])->name('tasks.store');
        Route::get('/tasks/edit/{id}', [InstructorController::class, 'editTasks'])->name('tasks.edit');
        Route::post('/tasks/update/{id}', [InstructorController::class, 'updateTasks'])->name('tasks.update');
        Route::get('/tasks/destroy/{id}', [InstructorController::class, 'destroyTasks'])->name('tasks.destroy');

        Route::get('/sessions', [InstructorController::class, 'indexSessions'])->name('sessions.index');
        Route::get('/sessions/create', [InstructorController::class, 'createSessions'])->name('sessions.create');
        Route::post('/sessions/store', [InstructorController::class, 'storeSessions'])->name('sessions.store');
        Route::get('/sessions/edit/{id}', [InstructorController::class, 'editSessions'])->name('sessions.edit');
        Route::post('/sessions/update/{id}', [InstructorController::class, 'updateSessions'])->name('sessions.update');
        Route::get('/sessions/destroy/{id}', action: [InstructorController::class, 'destroySessions'])->name('sessions.destroy');

        Route::get('/dashboard',[InstructorController::class,'dashboard'])->name('dashboard');

    });
});

// Student Routes
Route::middleware(['checkStudent'])->group(function () {
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/courses/register/{id}', [StudentController::class, 'register'])->name('courses.register');
        Route::post('/courses/registerForm/{id}', [StudentController::class, 'registerForCourse'])->name('courses.registerForm');

        Route::get('/solutions/submit/{id}', [StudentController::class, 'submit'])->name('solutions.submit');

        Route::post('/solutions/submitSolution', [StudentController::class, 'submitSolution'])->name('solutions.submitSolution');

        Route::get('/courses', [StudentController::class, 'listCourses'])->name('courses.list');
        Route::get('/tasks', [StudentController::class, 'listTasks'])->name('tasks.list');
        Route::get('/solutions', [StudentController::class, 'listSolutions'])->name('solutions.list');
        Route::get('/solutions/download/{id}', [StudentController::class, 'download'])->name('solutions.download');
    });
});




