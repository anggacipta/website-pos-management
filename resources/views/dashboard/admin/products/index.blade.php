@extends('dashboard.admin.layouts.main')
@section('title', 'Data Produk')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Gambar Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td><img src="{{ asset($product->gambar) }}" width="100" height="100" alt=""></td>
                        <td>{{ $product->nama_produk }}</td>
                        <td>{{ $product->category->nama_kategori }}</td>
                        <td>{{ 'Rp' . number_format($product->harga, 2, ',', '.') }}</td>
                        <td>{{ $product->stok }} pcs</td>
                        <td>{{ $product->catatan }}</td>
                        <td>
                            <a href="{{ route('products.tambah-stok', $product->id) }}" class=""><i class="ti ti-browser-plus h2 text-info"></i></a>
                            <a href="{{ route('products.edit', $product->id) }}" class=""><i class="ti ti-edit h2 text-warning"></i></a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline delete-form">
                                @csrf
                                @method('delete')
                                <button type="submit" class="" style="border: none">
                                    <i class="ti ti-trash text-danger h2"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu tidak akan bisa mengembalikan data ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
