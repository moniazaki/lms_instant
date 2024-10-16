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
        <h1 class="text-center fw-bold">List of existing Sessions</h1>
        <div class="card text-center">
            <div class="card-body">
                <div class="table table-responsive text-center">
                    <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Video</th>
                        <th colspan="3">Action</th>
                    </thead>
                    <tbody>
                        @forelse ($sessions as $session)
                            <tr>
                                <td>{{$session->id}}</td>
                                <td>{{$session->title}}</td>
                                <td>{{$session->description}}</td>
                                <td>{{$session->video_path}}</td>
                                <td><a href="{{route('instructor.sessions.edit',$session->id)}}" class="btn btn-warning">Edit</a>
                                <a href="{{route('instructor.sessions.destroy',$session->id)}}" class="btn btn-danger">Delete</a>
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
                        <a href="{{route('instructor.sessions.create')}}" class="btn btn-secondary">Add  session</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
