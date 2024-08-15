@extends('dashboard.admin.layouts.main')
@section('title', 'Tambah Pembayaran')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Pembayaran</h5>
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('pembayaran.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="warga_id" class="form-label">Nama Warga:</label>
                                        <select name="warga_id" id="warga_id" class="form-control js-example-basic-single">
                                            <option value="">Pilih Warga</option>
                                            @foreach($wargas as $warga)
                                                <option value="{{ $warga->id }}">{{ $warga->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('warga_id')
                                        <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun" class="form-label">Bulan:</label>
                                    <select name="bulan" class="form-control" required>
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tahun" class="form-label">Tahun:</label>
                                    <select name="tahun" class="form-control">
                                        @for($i = date('Y'); $i >= 2020; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah:</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                                @error('jumlah')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" name="status" value="1">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
