@extends('dashboard.admin.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card-body">
            <div>
                <!-- ------------------------------------------ -->
                <!-- Medium -->
                <!-- ------------------------------------------ -->
                <button class="btn me-1 mb-4 bg-primary text-white px-4 fs-4 " style="float: right" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                    Tambah Data
                </button>
                <!-- sample modal content -->
                <div id="bs-example-modal-md" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="myModalLabel">
                                    Tambah Data
                                </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('kondisi-barang.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Maintenance</label>
                                        <input type="text" name="kondisi_barang" class="form-control" id="nama" aria-describedby="emailHelp">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn bg-danger-subtle text-danger  waves-effect" data-bs-dismiss="modal">
                                    Close
                                </button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div>
            <div class="clearfix"></div> <!-- for spacing -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Alasan rusak</th>
                    <th>Kondisi Barang</th>
                    <th>Catatan</th>
                    <th>Biaya Maintenance</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($maintenances as $maint)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $maint->barang->id }}</td>
                        <td>{{ $maint->alasan_rusak }}</td>
                        <td>{{ $maint->kondisiBarang->kondisi_barang }}</td>
                        <td>{{ $maint->catatan }}</td>
                        <td>{{ 'Rp' . number_format($maint->harga, 2, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('maintenance.diperbaiki', $maint->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-info">Berhasil Diperbaiki</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="5" class="text-right"><strong>Total Harga Maintenance:</strong></td>
                    <td>{{ 'Rp' . number_format($maintenances->sum('harga'), 2, ',', '.') }}</td>
                </tr>
                </tfoot>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>
@endsection
