@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Roles</h5>
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            <form action="{{ route('roles.permissions.update', $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Role Name:</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{ $role->name }}" required>
                                </div>

                                <div class="mb-3">
                                    <h3>Assign Permissions</h3>
                                    @foreach($permissions as $permission)
                                        <label class="form-label">
                                            <input type="checkbox" name="permissions[]" class="form-checkbox-input" value="{{ $permission->name }}" {{ $role->permissions->contains($permission) ? 'checked' : '' }}>
                                            {{ $permission->name }}
                                        </label>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary">Update Role and Permissions</button>
                            </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection


