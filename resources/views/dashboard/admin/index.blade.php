<!-- resources/views/dashboard/admin/index.blade.php -->

@extends('dashboard.admin.layouts.main')
@section('title', 'Dashboard')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Dashboard</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="javascript:void(0)">Home</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="{{ asset('assets/images/backgrounds/rocket.png') }}" alt="modernize-img"
                                 class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5>
                                    <span><i class="ti ti-home-check"></i></span>
                                    Laporan Bulanan
                                </h5>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-6 text-center">
                                <h5>
                                    <span><i class="ti ti-transfer-out"></i></span>
                                    Total Pengeluaran
                                </h5>
                                <p class="card-text">Rp{{ number_format($totalPengeluaranBulanan) }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                <h5>
                                    <span><i class="ti ti-transfer-in"></i></span>
                                    Total Pemasukan
                                </h5>
                                <p class="card-text">Rp{{ number_format($totalPemasukanBulanan) }}</p>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12 text-center">
                                <h5>
                                    <span><i class="ti ti-code-minus"></i></span>
                                    Selisih
                                </h5>
                                @if($totalPemasukanBulanan - $totalPengeluaranBulanan > 0)
                                    <p class="card-text">Rp{{ number_format($totalPemasukanBulanan - $totalPengeluaranBulanan) }}</p>
                                @else
                                    <p class="card-text">-Rp{{ number_format($totalPemasukanBulanan - $totalPengeluaranBulanan) }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Penjualan Harian</h5>
                        <div id="chart-penjualan-hari-ini" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Penjualan Bulanan</h5>
                        <div id="chart-penjualan-bulan-ini" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Pengeluaran Harian</h5>
                        <div id="chart-pengeluaran-hari-ini" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Total Pengeluaran Bulanan</h5>
                        <div id="chart-pengeluaran-bulan-ini" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div id="chart-pengeluaran-kategori" style="width: 100%; height: 400px;"></div>
                        <h5>Total Pengeluaran Hari Ini: {{ $totalPengeluaranHariIni }}</h5>
                        <p>Berikut adalah total pengeluaran berdasarkan kategori untuk hari ini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Perbandingan Pemasukan dan Pengeluaran</h5>
                        <div id="chart-pembayaran-pengeluaran" style="width: 100%; height: 400px;"></div>
                        <h5>Total Perbandingan</h5>
                        <p class="card-text">Total pemasukan bulan ini: Rp{{ number_format($totalPemasukanBulanan) }}</p>
                        <p class="card-text">Total pengeluaran bulan ini: Rp{{ number_format($totalPengeluaranBulanan) }}</p>
                    </div>
                </div>
            </div>
        </div>

        @include('dashboard.admin.layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var optionsPengeluaran = {
                chart: {
                    type: 'donut',
                    height: 400
                },
                series: @json($pengeluaranData->pluck('count')),
                labels: @json($pengeluaranData->pluck('kategori')),
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 400,
                            width: 400
                        },
                    }
                }]
            };

            var chartPengeluaran = new ApexCharts(document.querySelector("#chart-pengeluaran-kategori"), optionsPengeluaran);
            chartPengeluaran.render();

            var optionsPenjualanHariIni = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Total Penjualan',
                    data: @json($penjualanHariIni->pluck('total'))
                }],
                xaxis: {
                    categories: @json($penjualanHariIni->pluck('date'))
                }
            };

            var chartPenjualanHariIni = new ApexCharts(document.querySelector("#chart-penjualan-hari-ini"), optionsPenjualanHariIni);
            chartPenjualanHariIni.render();

            var optionsPenjualanBulanIni = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Total Penjualan',
                    data: @json($penjualanBulanIni->pluck('total'))
                }],
                xaxis: {
                    categories: @json($penjualanBulanIni->pluck('month'))
                }
            };

            var chartPenjualanBulanIni = new ApexCharts(document.querySelector("#chart-penjualan-bulan-ini"), optionsPenjualanBulanIni);
            chartPenjualanBulanIni.render();

            var optionsPembayaranPengeluaran = {
                chart: {
                    type: 'pie',
                    height: 400
                },
                series: [{{ $totalPembayarans }}, {{ $totalPengeluarans }}],
                labels: ['Total Pemasukan', 'Total Pengeluaran'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 400,
                            width: 400
                        },
                    }
                }]
            };

            var chartPembayaranPengeluaran = new ApexCharts(document.querySelector("#chart-pembayaran-pengeluaran"), optionsPembayaranPengeluaran);
            chartPembayaranPengeluaran.render();

            var optionsPengeluaranHariIni = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Total Pengeluaran',
                    data: @json($pengeluaranHariIni->pluck('total'))
                }],
                xaxis: {
                    categories: @json($pengeluaranHariIni->pluck('date'))
                }
            };

            var chartPengeluaranHariIni = new ApexCharts(document.querySelector("#chart-pengeluaran-hari-ini"), optionsPengeluaranHariIni);
            chartPengeluaranHariIni.render();

            var optionsPengeluaranBulanIni = {
                chart: {
                    type: 'bar',
                    height: 400
                },
                series: [{
                    name: 'Total Pengeluaran',
                    data: @json($pengeluaranBulanIni->pluck('total'))
                }],
                xaxis: {
                    categories: @json($pengeluaranBulanIni->pluck('month'))
                }
            };

            var chartPengeluaranBulanIni = new ApexCharts(document.querySelector("#chart-pengeluaran-bulan-ini"), optionsPengeluaranBulanIni);
            chartPengeluaranBulanIni.render();
        });
    </script>
@endsection
