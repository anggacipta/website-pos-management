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
                            <img src="{{ asset('assets/images/backgrounds/rocket.png') }}" alt="modernize-img"
                                 class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6">
                <div class="card bg-primary shadow-none mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <span>
                                    <i class="ti ti-coin-monero" style="font-size: 5em; color: #efe8e8; text-shadow: 2px 2px 2px grey;"></i>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="text-white">{{ date('F', mktime(0, 0, 0, $currentMonth, 1)) }} - Sudah Bayar</h5>
                                <h2 class="text-white">{{ $totalSudahBayar }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6">
                <div class="card bg-primary shadow-none mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-4">
                                <span>
                                    <i class="ti ti-moneybag" style="font-size: 5em; color: #efe8e8; text-shadow: 2px 2px 2px grey;"></i>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="text-white">{{ date('F', mktime(0, 0, 0, $currentMonth, 1)) }} - Belum Bayar</h5>
                                <h2 class="text-white">{{ $totalBelumBayar }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
