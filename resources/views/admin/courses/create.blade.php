@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success')}}
            </div>
        @endif
        <h1 class="text-center fw-bold">Add Course</h1>
        <form action="{{route('admin.courses.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Title</label>
                <input type="text" value="{{old('name')}}" class="form-control @error('name') is invalid @enderror" id="name" name="name">
            @error('name')
                <span class="text-danger">
                    {{$message}}
                </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" value="{{old('description')}}" class="form-control @error('description') is invalid @enderror" id="description" name="description">
            @error('description')
                <span class="text-danger">
                    {{$message}}
                </span>
            @enderror
            </div>
            <div class="mb-3 text-center px-3">
                <button class="btn btn-secondary">Add Course</button>
            </div>
        </form>
    </div>




@endsection
