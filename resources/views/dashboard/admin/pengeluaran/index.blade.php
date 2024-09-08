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
                                    <h5 class="text-success">Total Pengeluaran Hari Ini</h5>
                                    <h2 class="text-success">{{ 'Rp' . number_format($totalToday, 2, ',', '.') }}</h2>
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
                                    <h5 class="text-danger">Total Pengeluaran Bulanan</h5>
                                    <h2 class="text-danger">{{ 'Rp' . number_format($totalCurrentMonth, 2, ',', '.') }}</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--     Filter Tanggal       --}}
            <form method="GET" action="{{ route('pengeluaran.index') }}" class="mb-4">
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
            <div class="table-responsive">
                <table id="" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang atau Tagihan</th>
                        <th>Harga barang atau tagihan</th>
                        <th>Jumlah barang</th>
                        <th>Satuan</th>
                        <th>Potongan</th>
                        <th>Harga setelah potongan</th>
                        <th>Harga per satuan</th>
                        <th>Tanggal Pengeluaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pengeluarans as $pengeluaran)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $pengeluaran->nama_barang }}</td>
                            <td>{{ 'Rp' . number_format($pengeluaran->harga_barang, 2, ',', '.') }}</td>
                            <td>{{ $pengeluaran->jumlah_barang }}</td>
                            <td>{{ $pengeluaran->satuan }}</td>
                            <td>{{ 'Rp' . number_format($pengeluaran->potongan) }}</td>
                            <td>{{ 'Rp' . number_format($pengeluaran->harga_barang - $pengeluaran->potongan) }}</td>
                            <td>{{ 'Rp' . number_format(($pengeluaran->harga_barang - $pengeluaran->potongan) / $pengeluaran->jumlah_barang) }}</td>
                            <td>{{ Carbon\Carbon::parse($pengeluaran->created_at)->timezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $pengeluarans->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
