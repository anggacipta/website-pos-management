@extends('dashboard.admin.layouts.main')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Ruangan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-default">
                                    Tambah Ruangan
                                </button>
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="card">
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
                                    <td>{{ $ruangan->id }}</td>
                                    <td>{{ $ruangan->nama_ruangan }}</td>
                                    <td>
                                        {{--                            <a href="{{ route('ruangan.edit', $ruangan->id) }}" class="btn btn-warning">Edit</a> --}}
                                        {{--                            <form action="{{ route('ruangan.destroy', $ruangan->id) }}" method="post" class="d-inline"> --}}
                                        {{--                                @csrf --}}
                                        {{--                                @method('delete') --}}
                                        {{--                                <button type="submit" class="btn btn-danger">Delete</button> --}}
                                        {{--                            </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Modal for add Data --}}
                    <div class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data Ruangan</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>One fine body…</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    @endsection
