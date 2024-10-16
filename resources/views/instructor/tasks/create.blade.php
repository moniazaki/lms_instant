@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success')}}
            </div>
        @endif
        <h1 class="text-center fw-bold">Add Tasks to Session</h1>
        <form action="{{route('instructor.tasks.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="course_id">Select Session</label>
                <select name="session_id" class="form-control" required>
                    @foreach ($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->title }}</option> <!-- or whichever attribute is relevant -->
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is invalid @enderror" id="title" name="title">
            @error('name')
                <span class="text-danger">
                    {{$message}}
                </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text"  class="form-control @error('description') is invalid @enderror" id="description" name="description">
            @error('description')
                <span class="text-danger">
                    {{$message}}
                </span>
            @enderror
            </div>

            <div class="mb-3 text-center px-3">
                <button class="btn btn-secondary">Add Task</button>
            </div>
        </form>
    </div>




@endsection
