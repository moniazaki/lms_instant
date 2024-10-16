@extends('layouts.app')

@section('content')
    <div class="container col-12 ms-4 py-4">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{Session::get('success')}}
            </div>
        @endif
        @if(Session::has('delete'))
            <div class="alert alert-danger text-center">
                {{Session::get('delete')}}
            </div>
        @endif
        <h1 class="text-center fw-bold">List of existing Instructors</h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="table table-responsive text-center">
                    <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        @forelse ($instructors as $instructor)
                            <tr>
                                <td>{{$instructor->id}}</td>
                                <td>{{$instructor->name}}</td>
                                <td>{{$instructor->email}}</td>
                                <td><a href="{{route('admin.instructors.edit',$instructor->id)}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('admin.instructors.destroy',$instructor->id)}}" class="btn btn-danger">Delete</a>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    No Data was found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                    <div class="text-center px-3">
                        <a href="{{route('admin.instructors.create')}}" class="btn btn-secondary">Add  Instructor</a></td>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
