@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        <h1 class="text-center fw-bold">Assign Instructor to Course</h1>

        <form action="{{ route('admin.courses.assignInstructor') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="course_id">Select Course</label>
                <select name="course_id" class="form-control" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="instructor_id">Select Instructor</label>
                <select name="instructor_id" class="form-control" required>
                    @foreach ($instructors as $instructor)
                        <option value="{{ $instructor->id }}">{{ $instructor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-secondary">Assign Instructor</button>
            </div>
        </form>


    </div>
@endsection
