@extends('dashboard.admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ruangans as $ruangan)
                    <tr>
                        <td>{{ $ruangan->id }}</td>
                        <td>{{ $ruangan->nama_ruangan }}</td>
                        <td>
{{--                            <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-warning">Edit</a>--}}
{{--                            <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="post" class="d-inline">--}}
{{--                                @csrf--}}
{{--                                @method('delete')--}}
{{--                                <button type="submit" class="btn btn-danger">Delete</button>--}}
{{--                            </form>--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>No</th>
                    <th>Nama Ruangan</th>
                    <th>Aksi</th>
                </tr>
                </tfoot>
            </table>
        </section>
        <!-- /.content -->
@endsection
