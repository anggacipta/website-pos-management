@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Roles</h5>
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
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Role:</label>
                                    <input type="text" name="name" class="form-control" id="name" required>
                                </div>
                                <div class="mb-3">
                                    <h3>Assign Permissions</h3>
                                    @foreach($permissions as $permission)
                                        <label class="form-label">
                                            <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    @endforeach
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection

