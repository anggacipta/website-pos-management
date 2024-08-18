<!-- resources/views/dashboard/admin/pengeluaran/index.blade.php -->
@extends('dashboard.admin.layouts.main')
@section('title', 'Data Pengeluaran')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-6 col-md-12">
                    <div class="card bg-outline-success border border-3 border-success shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-coin-monero text-success" style="font-size: 5em; text-shadow: 2px 2px 2px grey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-success">Total Dana</h5>
                                    <h2 class="text-success">{{ 'Rp' . number_format($totalIncome, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-md-12">
                    <div class="card bg-outline-primary border border-3 border-danger shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-4">
                                <span>
                                    <i class="ti ti-moneybag text-danger" style="font-size: 5em; text-shadow: 2px 2px 2px lightgrey;"></i>
                                </span>
                                </div>
                                <div class="col-8">
                                    <h5 class="text-danger">Total Pengeluaran</h5>
                                    <h2 class="text-danger">{{ 'Rp' . number_format($totalPengeluaran, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 col-md-12">
                    <div class="card bg-outline-warning border border-3 border-warning shadow-none mb-4">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-2">
                                <span>
                                    <i class="ti ti-moneybag text-warning" style="font-size: 5em; text-shadow: 2px 2px 2px lightgrey;"></i>
                                </span>
                                </div>
                                <div class="col-10">
                                    <h5 class="text-warning">Sisa Dana</h5>
                                    <h2 class="text-warning">
                                        @if ($totalSisa < 0)
                                            {{ '-Rp' . number_format(abs($totalSisa), 2, ',', '.') }}
                                        @else
                                            {{ 'Rp' . number_format($totalSisa, 2, ',', '.') }}
                                        @endif
                                    </h2>
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
                    <th>Keterangan</th>
                    <th>Jumlah Pengeluaran</th>
                    <th>Tanggal Pengeluaran</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($pengeluarans as $pengeluaran)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $pengeluaran->keterangan }}</td>
                        <td>{{ 'Rp' . number_format($pengeluaran->jumlah, 2, ',', '.') }}</td>
                        <td>{{ $pengeluaran->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $pengeluarans->links('pagination::bootstrap-4') }}
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
