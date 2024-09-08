<!-- resources/views/dashboard/admin/pemasukan/index.blade.php -->
@extends('dashboard.admin.layouts.main')
@section('title', 'Data Pemasukan')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 col-md-12">
                    <div class="card bg-outline-info border border-3 border-info shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-coin-monero text-info" style="font-size: 5em; text-shadow: 2px 2px 2px grey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-info">Total Pemasukan Bulan Ini</h5>
                                    <h2 class="text-info">{{ 'Rp' . number_format($totalCurrentMonth, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="card bg-outline-primary border border-3 border-primary shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-moneybag text-primary" style="font-size: 5em; text-shadow: 2px 2px 2px lightgrey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-primary">Total Pemasukan Hari Ini</h5>
                                    <h2 class="text-primary">{{ 'Rp' . number_format($totalToday, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--     Filter Tanggal       --}}
            <form method="GET" action="{{ route('pemasukan.index') }}" class="mb-2">
                <div class="row">
                    <div class="col-md-5">
                        <label for="date">Dari Tanggal</label>
                        <input type="text" name="tanggal1" class="form-control" id="date"
                               aria-describedby="emailHelp" value="{{ request('tanggal1') }}">
                    </div>
                    <div class="col-md-5">
                        <label for="date2">Sampai Tanggal</label>
                        <input type="text" name="tanggal2" class="form-control" id="date2"
                               aria-describedby="emailHelp" value="{{ request('tanggal2') }}">
                    </div>
                    <div class="col-md-2" style="margin-top: 18px">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            {{--      Table      --}}
            <table id="" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Id Invoice</th>
                    <th>Total Harga</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Tanggal Transaksi</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Detail Transaksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pembayarans as $pembayaran)
                    <tr>
                        <th scope="row">{{ $pembayaran->id }}</th>
                        <td>{{ 'Rp' . number_format($pembayaran->total_harga, 2, ',', '.') }}</td>
                        <td>{{ 'Rp' . number_format($pembayaran->uang_diterima, 2, ',', '.') }}</td>
                        @if($pembayaran->updated_at == '')
                            <td>{{ Carbon\Carbon::parse($pembayaran->updated_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td>
                        @else
                            <td>{{ Carbon\Carbon::parse($pembayaran->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td>
                        @endif
                        <td>{{ $pembayaran->metode_pembayaran }}</td>
                        <td>{{ $pembayaran->status }}</td>
                        <td>
                            <a href="{{ route('pemasukan.show', $pembayaran->id) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pembayarans->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
