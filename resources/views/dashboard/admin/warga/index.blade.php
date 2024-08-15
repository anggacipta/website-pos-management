@extends('dashboard.admin.layouts.main')
@section('title', 'Data Warga')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Warga</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($wargas as $warga)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $warga->nik }}</td>
                        <td>{{ $warga->nama }}</td>
                        <td>{{ $warga->tempat_lahir }}</td>
                        <td>{{ $warga->tanggal_lahir }}</td>
                        <td>{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>
                            <a href="{{ route('warga.edit', $warga->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('warga.destroy', $warga->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            @php
                                $currentMonth = date('n');
                                $currentYear = date('Y');
                                $pembayaran = $warga->pembayaran->where('bulan', $currentMonth)->where('tahun', $currentYear)->first();
                            @endphp
                            @if($pembayaran && $pembayaran->status == 1)
                                <!-- Do nothing or show a message indicating payment is complete -->
                            @else
                                <form action="{{ route('warga.send-reminder', $warga->id) }}" method="post" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-info">Ingatkan pembayaran bulan ini</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
