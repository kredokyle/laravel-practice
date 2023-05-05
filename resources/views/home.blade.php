@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Welcome!</h1>
    
    <div class="text-end">
        <a href="{{ route('create') }}">New User</a>
    </div>
    
    <table class="table table-hover table-sm align-middle">
        <thead>
            <tr>
                <th></th>
                <th>NAME</th>
                <th>EMAIL</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_users as $user)
            <tr>
                <td>
                    @if ($user->avatar)
                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="{{ $user->avatar }}" class="border p-1 d-block mx-auto">
                    @else
                        <div class="text-center">
                            <i class="fa-solid fa-user fa-4x" class="text-dark"></i>
                        </div>
                    @endif
                </td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="{{ route('edit', $user->id) }}">Edit</a>
                    &middot;
                    <a href="#">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection