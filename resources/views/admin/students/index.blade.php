@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('delete'))
            <div class="alert alert-danger text-center">
                {{ Session::get('delete') }}
            </div>
        @endif
        <h1 class="text-center fw-bold">List of existing Students</h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="table table-responsive text-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <td>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->role }}</td>
                                <td><a href="{{ route('admin.students.edit', $student->id) }}"
                                        class="btn btn-warning">Edit</a>

                                    <a href="{{ route('admin.students.destroy', $student->id) }}"
                                        class="btn btn-danger">Delete</a>
                                </td>
                                </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">
                                        No Data was found <a href="{{ route('admin.instructors.create') }}"
                                            class="text-decoration-none fw-bold text-dark ">Click here to add instructor</a>

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
