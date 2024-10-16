@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success')}}
            </div>
        @endif
        <h1 class="text-center fw-bold">Add Sessions to Course</h1>
        <form action="{{route('instructor.sessions.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="course_id">Select Course</label>
                <select name="course_id" class="form-control" required>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
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
            <div class="mb-3">
                <label for="video_path" class="form-label">Upload Video</label>
                <input type="file" class="form-control @error('video_path') is-invalid @enderror" id="video_path" name="video_path" accept="video/*">
                @error('video_path')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 text-center px-3">
                <button class="btn btn-secondary">Add Session</button>
            </div>
        </form>
    </div>




@endsection

