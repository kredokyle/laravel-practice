@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-3">
            @if ($user->avatar)
                <img src="#" alt="{{ $user->avatar }}" class="img-thumbnail d-block mx-auto">
            @else
                <div class="text-center">
                    <i class="fa-solid fa-user fa-4x" class="text-dark"></i>
                </div>
            @endif

            <input type="file" name="avatar" class="form-control mt-2">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}">
            @error('name')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail Address</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email' ,$user->email) }}">
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
        <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
@endsection