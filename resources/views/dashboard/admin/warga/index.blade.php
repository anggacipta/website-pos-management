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
                        @if($warga->jenis_kelamin == 'L')
                            <td>Laki-laki</td>
                        @else
                            <td>Perempuan</td>
                        @endif
                        <td>
                            <a href="{{ route('warga.edit', $warga->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('warga.destroy', $warga->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <form action="{{ route('warga.send-reminder', $warga->id) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-info">Send Reminder</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
