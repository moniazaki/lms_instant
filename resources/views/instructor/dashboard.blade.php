@extends('layouts.app')

@section('content')

<div class="container col-11 ms-3 py-3">
    <h1 class="text-center fw-bold">Assigned Courses</h1>
    <div class="card text-center">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->description }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">No Courses assigned yet</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
