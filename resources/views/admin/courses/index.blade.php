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
        <h1 class="text-center fw-bold">List of existing courses</h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="table table-responsive text-center">
                    <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        @forelse ($courses as $course)
                            <tr>
                                <td>{{$course->id}}</td>
                                <td>{{$course->name}}</td>
                                <td>{{$course->description}}</td>
                                <td><a href="{{route('admin.courses.edit',$course->id)}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('admin.courses.destroy',$course->id)}}" class="btn btn-danger">Delete</a>
                            </td>
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
                        <a href="{{route('admin.courses.create')}}" class="btn btn-secondary">Add  course</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
