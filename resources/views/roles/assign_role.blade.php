@extends('dashboard.admin.layouts.main')
@section('content')
    <div class="container">
        <h2>Assign Role to User</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('role-assignment.assign') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="user_id">Select User:</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role">Select Role:</label>
                <select name="role" id="role" class="form-control">
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Assign Role</button>
        </form>
    </div>
@endsection
