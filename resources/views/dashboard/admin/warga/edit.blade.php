@extends('dashboard.admin.layouts.main')
@section('title', 'Edit Warga')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tambah Data Warga</h5>
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
                        <form id="barangForm" action="{{ route('warga.update', $warga->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">NIK</label>
                                        <input type="text" name="nik" class="form-control" id="nik"
                                               aria-describedby="emailHelp" value="{{ $warga->nik }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control js-example-basic-single" name="jenis_kelamin" id="unit_kerja">
                                            <option>Pilih Jenis Kelamin</option>
                                            <option value="L" {{ $warga->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ $warga->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nama_warga" class="form-label">Nama Warga</label>
                                        <input type="text" name="nama" class="form-control" id="nama_warga"
                                               aria-describedby="emailHelp" value="{{ $warga->nama }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="no_akl_akd" class="form-label">Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" id="tempat_lahir"
                                               aria-describedby="emailHelp" value="{{ $warga->tempat_lahir }}">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal Lahir</label>
                                <input type="text" name="tanggal_lahir" class="form-control" id="date"
                                       aria-describedby="emailHelp" value="{{ date('m/d/Y', strtotime($warga->tanggal_lahir)) }}">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">Nomor HP</label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ $warga->no_hp }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @include('dashboard.admin.layouts.footer')
        </div>
    </div>
@endsection
