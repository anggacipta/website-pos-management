@extends('dashboard.admin.layouts.main')
@section('title', 'Tambah Pengeluaran')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Pengeluaran</h5>
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
                        <form action="{{ route('pengeluaran.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="nama_barang" class="form-label">Nama Barang atau Nama Tagihan</label>
                                        <input type="text" name="nama_barang" class="form-control" id="nama_barang">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori Pengeluaran:</label>
                                        <select name="kategori_id" class="form-select" id="kategori" required>
                                            <option value="">Pilih Kategori</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                        @error('kategori_id')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga Barang atau Tagihan</label>
                                        <input type="number" name="harga_barang" class="form-control" id="harga">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="potongan" class="form-label">Potongan(dapat dikosongkan)</label>
                                        <input type="number" name="potongan" class="form-control" id="potongan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan</label>
                                        <select name="satuan" id="satuan" class="form-select" required>
                                            <option value="">Pilih Satuan</option>
                                            <option value="pcs">Pcs</option>
                                            <option value="kg">Kg</option>
                                            <option value="liter">Liter</option>
                                            <option value="meter">Meter</option>
                                            <option value="tagihan">Tagihan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_toko" class="form-label">Nama Toko atau Distributor</label>
                                        <input type="text" id="nama_toko" name="nama_toko" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Jumlah Barang(dapat dikosongkan apabila membayar tagihan)</label>
                                        <input type="number" name="jumlah_barang" class="form-control" id="jumlah">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
