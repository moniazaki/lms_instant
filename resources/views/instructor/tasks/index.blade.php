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
        <h1 class="text-center fw-bold">List of existing Tasks</h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="table table-responsive text-center">
                    <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th colspan="2">Action</th>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->title}}</td>
                                <td>{{$task->description}}</td>
                                <td><a href="{{route('instructor.tasks.edit',$task->id)}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('instructor.tasks.destroy',$task->id)}}" class="btn btn-danger">Delete</a>
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
                        <a href="{{route('instructor.tasks.create')}}" class="btn btn-secondary">Add  Task</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
