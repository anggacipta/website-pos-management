@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <h3 class="text-center">Data Ruangan</h3>
        <form action="{{ route('barang.ruangan') }}" method="get" class="my-3">
            <input type="text" name="search" class="form-control" placeholder="Cari ruangan...">
        </form>
        <div class="row">
            @foreach ($ruangans as $ruangan)
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="width: 50%">{{ $ruangan->nama_ruang }}</h5>
                            <a href="{{ route('barang.create', $ruangan->id) }}" class="btn btn-primary">Tambah Barang</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
