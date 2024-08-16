@extends('dashboard.admin.layouts.main')
@section('title', 'Data Pembayaran')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <h3>Filter Pembayaran</h3>
            <form method="GET" action="{{ route('pembayaran.index') }}">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select name="year" class="form-control">
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="month" class="form-control">
                            <option value="">All Months</option>
                            @foreach(range(1, 12) as $m)
                                <option
                                    value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-control">
                            <option value="">All Status</option>
                            <option value="1" {{ $status === '1' ? 'selected' : '' }}>Paid</option>
                            <option value="0" {{ $status === '0' ? 'selected' : '' }}>Not Paid</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <div class="d-flex justify-content-between">
                    <h3>Data Pembayaran</h3>
                    <form action="{{ route('pembayaran.index') }}" method="GET">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Search</button>
                        </div>
                    </form>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Name</th>
                        @if(!$month)
                            @foreach(range(1, 12) as $m)
                                <th>{{ date('F', mktime(0, 0, 0, $m, 1)) }}</th>
                            @endforeach
                        @else
                            <th>{{ date('F', mktime(0, 0, 0, $month, 1)) }}</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($wargas as $warga)
                        <tr>
                            <td>{{ $warga->nama }}</td>
                            @if(!$month)
                                @foreach(range(1, 12) as $m)
                                    @php
                                        $payment = $warga->pembayaran->firstWhere('bulan', $m);
                                    @endphp
                                    <td>
                                        @if($payment)
                                            @if($payment->status == 1)
                                                <span>
                                                    <i class="ti ti-check fs-4 text-success"></i>
                                                </span>
                                            @else
                                                <span>
                                                    <i class="ti ti-ban fs-4 text-danger"></i>
                                                </span>
                                            @endif
                                        @else
                                            <span>
                                                <i class="ti ti-x fs-4"></i>
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                            @else
                                @php
                                    $payment = $warga->pembayaran->firstWhere('bulan', $month);
                                @endphp
                                <td>
                                    @if($payment)
                                        @if($payment->status == 1)
                                            <span>
                                                    <i class="ti ti-check fs-4 text-success"></i>
                                                </span>
                                        @else
                                            <span>
                                                    <i class="ti ti-ban fs-4 text-danger"></i>
                                                </span>
                                        @endif
                                    @else
                                        <span>
                                                <i class="ti ti-x fs-4"></i>
                                            </span>
                                    @endif
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $wargas->links('pagination::bootstrap-4') }}
                </div>
                <h3>Legend</h3>
                <ul>
                    <li><i class="ti ti-check fs-4"></i>Sudah Bayar</li>
                    <li><i class="ti ti-ban fs-4"></i>Belum Bayar</li>
                    <li><i class="ti ti-x fs-4"></i>Data Tidak Ada</li>
                </ul>
            </div>
        </div>
    </div>
@endsection
