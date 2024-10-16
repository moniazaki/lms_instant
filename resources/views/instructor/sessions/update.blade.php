@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success')}}
            </div>
        @endif
        <h1 class="text-center fw-bold">Update Session's Info</h1>
        <form action="{{route('instructor.sessions.update',$sessions->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="course_id" value="{{ $sessions->course_id }}">

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{old('title',$sessions->title)}}" class="form-control @error('title') is invalid @enderror" id="title" name="title">
            @error('title')
                <span class="text-danger">
                    {{$message}}
                </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" value="{{old('description',$sessions->description)}}" class="form-control @error('description') is invalid @enderror" id="description" name="description">
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
                <button class="btn btn-warning">Update Session's info</button>
            </div>
        </form>
    </div>
@endsection
