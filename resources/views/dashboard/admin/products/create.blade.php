@extends('dashboard.admin.layouts.main')
@section('title', 'Tambah Produk')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Produk</h5>
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
                        <form id="barangForm" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                        <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="harga" class="form-label">Harga Produk</label>
                                        <input type="number" name="harga" class="form-control" id="harga"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok Produk</label>
                                        <input type="number" name="stok" class="form-control" id="stok"
                                               aria-describedby="emailHelp">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                                        <textarea class="form-control" name="deskripsi" id="keterangan" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="kategori_id" class="form-label">Kategori</label>
                                <select class="form-control js-example-basic-single" name="kategori_id" id="kategori_id">
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('kategori_id'))
                                    <div class="error">{{ $errors->first('kategori_id') }}</div>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Foto Barang</label>
                                <input type="file" name="gambar" class="form-control" id="photo">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>

    @if(session('success'))
        <script>
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                icon: "success",
                showCancelButton: true,
                confirmButtonText: "Tambah produk lagi!",
                cancelButtonText: "Kembali ke Tabel Barang"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Do nothing, stay on the same page
                } else {
                    window.location.href = "{{ route('products.index') }}";
                }
            });
        </script>
    @endif


    <script>
        $(document).ready(function() {
            $("#barangForm").submit(function(e) {
                var namaProduk = $("input[name='nama_produk']").val();
                var harga = $("input[name='harga']").val();
                var stok = $("select[name='stok']").val();
                var photo = $("input[name='gambar']").val();

                if (!namaProduk) {
                    alert('Nama Barang harus diisi!');
                    e.preventDefault();
                }  else if (!harga) {
                    alert('Harga harus diisi!');
                    e.preventDefault();
                } else if (!stok === 'Pilih Sumber Pengadaan') {
                    alert('Sumber Pengadaan harus diisi!');
                    e.preventDefault();
                } else if (!photo) {
                    alert('Foto Barang harus diisi!');
                    e.preventDefault();
                }
            });
        });
    </script>


@endsection
