@extends('layouts.app')

@section('content')
    <div class="container col-11 ms-4 py-4">
        @if(Session::has('success'))
            <div class="alert alert-success text-center">
                {{ Session::get('success') }}
            </div>
        @endif
        <h1 class="text-center fw-bold">Update Student's Info</h1>
        <form action="{{ route('admin.students.update', $students->id) }}" method="POST">
            @csrf
        
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text"
                       value="{{ old('name', $students->name) }}"
                       class="form-control @error('name') is-invalid @enderror"
                       id="name" name="name">
                @error('name')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                       value="{{ old('email', $students->email) }}"
                       class="form-control @error('email') is-invalid @enderror"
                       id="email" name="email">
                @error('email')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="mb-3 text-center px-3">
                <button type="submit" class="btn btn-warning">Update Student's Info</button>
            </div>
        </form>
    </div>
@endsection
