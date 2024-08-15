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
                <h3>Data Pembayaran</h3>
                <table class="table">
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
                                                    <i class="ti ti-check fs-4"></i>
                                                </span>
                                            @else
                                                <span>
                                                    <i class="ti ti-ban fs-4"></i>
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
                                                    <i class="ti ti-check fs-4"></i>
                                                </span>
                                        @else
                                            <span>
                                                    <i class="ti ti-ban fs-4"></i>
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
                <h3>Legend</h3>
                <ul>
                    <li><i class="ti ti-check fs-4"></i> Paid</li>
                    <li><i class="ti ti-ban fs-4"></i> Not Paid</li>
                    <li><i class="ti ti-x fs-4"></i> No Data</li>
            </div>
        </div>
    </div>
@endsection
