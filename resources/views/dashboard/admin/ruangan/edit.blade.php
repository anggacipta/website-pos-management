@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Edit Data Ruangan</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('ruangan.update', $ruangan->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Ruangan</label>
                                <input type="text" name="nama_ruang" class="form-control" id="nama" aria-describedby="emailHelp" value="{{ $ruangan->nama_ruang }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
@endsection
