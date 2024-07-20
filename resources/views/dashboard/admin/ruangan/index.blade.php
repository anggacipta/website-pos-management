@extends('dashboard.admin.layouts.main')
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
                        <th>Nama Ruangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ruangans as $ruangan)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $ruangan->nama_ruang }}</td>
                            <td>
                                <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
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
