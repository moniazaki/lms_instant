@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center fw-bold">Register for a Course</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger text-center">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('student.courses.registerForm',  $student->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="course_id">Select Course</label>
            <select name="course_id" id="course_id" class="form-control" required>
                <option value="">Choose a course...</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>
<div class="text-center px-3">

    <button type="submit" class="btn btn-secondary  mt-3">Register</button>
</div>
    </form>
</div>
@endsection
