@extends('dashboard.admin.layouts.main')
@section('title', 'Tambah Pengeluaran')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Pengeluaran</h5>
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
                        <form action="{{ route('pengeluaran.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah:</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah" required>
                                @error('jumlah')
                                <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Keterangan:</label>
                                <textarea name="keterangan" cols="15" class="form-control"></textarea>
                                @error('keterangan')
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
