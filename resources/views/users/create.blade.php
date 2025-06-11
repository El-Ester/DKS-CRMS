@extends('layouts.app')

@section('content')
<h3>Add New User</h3>

<form action="{{ route('users.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="user_name" class="form-control">
    </div>
    <div class="form-group">
        <label>Full Name</label>
        <input type="text" name="user_full_name" class="form-control">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="user_email" class="form-control">
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="user_password" class="form-control">
    </div>
    <div class="form-group">
        <label>Role</label>
        <select name="user_role" class="form-control">
            @foreach($roles as $role)
                <option value="{{ $role->role_id }}">{{ $role->role_title }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success mt-2">Create</button>
</form>
@endsection
