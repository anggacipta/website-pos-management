<!-- resources/views/dashboard/admin/pemasukan/detail_invoice.blade.php -->
@extends('dashboard.admin.layouts.main')
@section('title', 'Detail Transaksi')
@section('content')
    @include('dashboard.admin.layouts.navbar')
    <div class="container-fluid">
        <div class="card-body">
            <h2>Detail Transaksi</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Id Invoice</th>
                    <td>{{ $pembayaran->id }}</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>{{ 'Rp' . number_format($pembayaran->total_harga, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td>{{ 'Rp' . number_format($pembayaran->uang_diterima, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Kembalian</th>
                    <td>{{ 'Rp' . number_format($pembayaran->kembalian, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Transaksi</th>
                    <td>{{ Carbon\Carbon::parse($pembayaran->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $pembayaran->metode_pembayaran }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>{{ $pembayaran->status }}</td>
                </tr>
            </table>
            <h3>Produk yang terjual</h3>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pembayaran->items as $item)
                    <tr>
                        <td>{{ $item->product->nama_produk }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ 'Rp' . number_format($item->harga, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
