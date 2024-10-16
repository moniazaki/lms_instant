@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center fw-bold">Tasks</h1>

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

        <div class="card">
            <div class="card-body text-center">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tasks as $task) <!-- Use $task instead of $tasks -->
                                <tr>
                                    <td>{{ $task->id }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>
                                       <a href="{{ route('student.solutions.submit', $task->id) }}" class="btn btn-secondary">Submit Solution</a> <!-- Corrected here -->
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center"> <!-- Corrected colspan to match the number of columns -->
                                        No tasks found for your enrolled courses.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

