@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Ruangan</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barang.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="ruang_id" value="{{ $ruangan_id }}">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" id="nama_barang" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control" id="kode_barang" value="{{ $kode_barang }}" readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>

    <script>
        window.onload = function() {
            var ruanganId = document.getElementById('ruangan_id').value.toString();
            var kodeBarang = 'BRG' + ruanganId.padStart(3, '0');
            document.getElementById('kode_barang').value = kodeBarang;
        };
    </script>
@endsection
