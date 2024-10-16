@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center fw-bold">Submitted Solutions</h1>
        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if ($solutions->isEmpty())
            <p class="text-center">You have not submitted any solutions.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Task ID</th>

                        <th>File Path</th>
                        <th>Submission date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($solutions as $solution)
                        <tr>
                            <td>{{ $solution->task_id }}</td>

                            <td>
                                <a href="{{ route('student.solutions.download', $solution->id) }}" >Download</a>
                            </td>

                            <td>{{ $solution->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
