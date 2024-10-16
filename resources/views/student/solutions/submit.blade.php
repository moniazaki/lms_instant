@extends('layouts.app')

@section('content')
    <div class="container col-12 py-3">
        <h1 class="text-center fw-bold">Submit Solution for {{ $tasks->title }}</h1>
        <form action="{{ route('student.solutions.submitSolution') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="task_id" value="{{ $tasks->id }}"> <!-- Hidden input for task ID -->
            <div class="mb-3">
                <label for="solution_link" class="form-label">Upload Solution</label>
                <input type="file" name="solution_link" class="form-control" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-secondary">Submit Solution</button>
            </div>
        </form>
    </div>
@endsection
