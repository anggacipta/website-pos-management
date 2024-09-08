@extends('dashboard.admin.layouts.main')
@section('title', 'Data Pengurangan Stok Produk')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="clearfix"></div> <!-- for spacing -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga Produk</th>
                    <th>Jumlah Pengurangan</th>
                    <th>Total Kerugian</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($stoks as $stok)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $stok->product->nama_produk }}</td>
                        <td>{{ 'Rp' . number_format($stok->product->harga, 2, ',', '.') }}</td>
                        <td>{{ $stok->stok }} porsi</td>
                        <td>{{ 'Rp' . number_format($stok->product->harga * $stok->stok, 2, ',', '.') }}</td>
                        <td>{{ $stok->keterangan }}</td>
                        <td>{{ $stok->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
