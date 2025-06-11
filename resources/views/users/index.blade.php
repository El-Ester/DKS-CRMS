@extends('layouts.app')

@section('content')
<h3>System Users</h3>
<a href="{{ route('users.create') }}" class="btn btn-primary mb-2">Add User</a>

<table class="table">
    <thead>
        <tr>
            <th>Name</th><th>Email</th><th>Role</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->user_full_name }}</td>
            <td>{{ $user->user_email }}</td>
            <td>{{ $user->role->role_title }}</td>
            <td>
                <!-- Add Edit/Delete links -->
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
