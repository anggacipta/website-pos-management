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
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-primary shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-coin-monero" style="font-size: 5em; color: #faf7f7; text-shadow: 2px 2px 2px grey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-white">Total Pemasukan Bulan Ini</h5>
                                    <h2 class="text-white">{{ 'Rp' . number_format($totalCurrentMonth, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-outline-primary border border-3 border-primary shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-moneybag text-primary" style="font-size: 5em; text-shadow: 2px 2px 2px lightgrey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-primary">Total Pemasukan Bulan Lalu</h5>
                                    <h2 class="text-primary">{{ 'Rp' . number_format($totalLastMonth, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-4">
                    <div class="card bg-outline-warning border border-3 border-warning shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-moneybag text-warning" style="font-size: 5em; text-shadow: 2px 2px 2px lightgrey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-warning">Total Pemasukan</h5>
                                    <h2 class="text-warning">{{ 'Rp' . number_format($totalIncome, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--      Table      --}}
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Warga</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Tanggal Pembayaran</th>
                    <th>Bulan</th>
                    <th>Tahun</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pemasukans as $pemasukan)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $pemasukan->pembayaran->warga->nama }}</td>
                        <td>{{ 'Rp' . number_format($pemasukan->pembayaran->jumlah, 2, ',', '.') }}</td>
                        @if($pemasukan->pembayaran->updated_at == '')
                            <td>{{ $pemasukan->pembayaran->updated_at }}</td>
                        @else
                            <td>{{ $pemasukan->pembayaran->created_at }}</td>
                        @endif
                        <td>{{ \App\Helpers\MonthHelper::getMonthName($pemasukan->pembayaran->bulan) }}</td>
                        <td>{{ $pemasukan->pembayaran->tahun }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pemasukans->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
