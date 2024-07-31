@extends('dashboard.admin.layouts.main')
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
                            <img src="{{ asset('assets/images/backgrounds/rocket.png') }}" alt="modernize-img" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-8">
                            <h4 class="card-title mb-0">Data</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-stretch">
                                <div class="card w-100 position-relative overflow-hidden border shadow-none mb-7 mb-lg-0">
                                    <div class="card-body">
                                        <div id="get-perbaiki" style="min-height: 144.533px;"></div>
                                        <div class="d-flex align-items-end justify-content-between mt-7">
                                            <div>
                                                <p class="mb-1">Total Barang yang Telah Diperbaiki Bulan Ini</p>
                                                <h4 class="mb-0 fw-semibold">{{ $currentMonthMaintenances }} barang</h4>
                                            </div>
                                            <span class="text-success fw-normal">{{ $percentageChangeMaintenance > 0 ? '+' : '' }}{{ number_format($percentageChangeMaintenance, 2) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-stretch">
                                <div class="card w-100 position-relative overflow-hidden border shadow-none mb-7 mb-lg-0">
                                    <div class="card-body">
                                        <div id="monthly-additions" style="min-height: 144.533px;"></div>
                                        <div class="d-flex align-items-end justify-content-between mt-7">
                                            <div>
                                                <p class="mb-1">Penambahan Barang per Bulan</p>
                                                <h4 class="mb-0 fw-semibold">{{ $currentMonthBarang }} barang</h4>
                                            </div>
                                            <span class="text-success fw-normal">{{ $percentageChangeBarang > 0 ? '+' : '' }}{{ number_format($percentageChangeBarang, 2) }}%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var options1 = {
                chart: {
                    type: 'pie',
                    height: 350
                },
                series: [{{ $serverPercentage }}, {{ $iprsPercentage }}, {{ $vendorPercentage }}],
                labels: ['Server', 'IPRS', 'Vendor'],
                colors: ['#008FFB', '#00E396', '#FEB019'],
                legend: {
                    position: 'bottom'
                }
            };

            var chart1 = new ApexCharts(document.querySelector("#get-perbaiki"), options1);
            chart1.render();

            var options2 = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Penambahan Barang',
                    data: @json(array_values($monthlyAdditionsBarang))
                }],
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#monthly-additions"), options2);
            chart2.render();
        });
    </script>
@endsection
