@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center fw-bold">Enrolled Courses</h1>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session('delete'))
            <div class="alert alert-danger text-center">
                {{ session('delete') }}
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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->description }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        No Data was found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($courses->isEmpty())
                        <div>
                            <a href="{{ route('student.courses.register', $student->id) }}" class="text-dark text-decoration-none fw-bold">Click here to enroll in courses</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

