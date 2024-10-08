@extends('dashboard.admin.layouts.main')
@section('title', 'Edit Data Alamat')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Alamat</h5>
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
                        <form action="{{ route('alamat.update', $alamat->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Alamat lengkap:</label>
                                <input type="text" name="alamat" id="name" class="form-control" value="{{ $alamat->alamat }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="no_telp" class="form-label">No telepon(maksimal 15 angka)</label>
                                <input type="number" name="no_telp" class="form-control" id="no_telp" value="{{ $alamat->no_telp }}" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="kota" class="form-label">Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" value="{{ $alamat->kota }}" aria-describedby="emailHelp">
                            </div>
                            <button type="submit" class="btn btn-primary">Edit Alamat</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection

