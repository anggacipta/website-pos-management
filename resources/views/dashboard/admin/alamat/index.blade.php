@extends('dashboard.admin.layouts.main')
@section('title', 'Data Alamat')
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
                @if(!$hasAlamat)
                    <button class="btn me-1 mb-4 bg-primary text-white px-4 fs-4 " style="float: left" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                        Tambah Data
                    </button>
                @endif
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
                                <form action="{{ route('alamat.store') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Alamat</label>
                                        <input type="text" name="alamat" class="form-control" id="nama" aria-describedby="emailHelp">
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
                    <th>Alamat Toko</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($alamats as $alamat)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $alamat->alamat }}</td>
                        <td>
                            <a href="{{ route('alamat.edit', $alamat->id) }}" class=""><i class="ti ti-edit h2 text-warning"></i></a>
                            <form action="{{ route('alamat.destroy', $alamat->id) }}" method="post" class="d-inline delete-form">
                                @csrf
                                @method('delete')
                                <button type="submit" class="" style="border: none">
                                    <i class="ti ti-trash text-danger h2"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @include('dashboard.admin.layouts.footer')
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah kamu yakin?',
                        text: "Kamu tidak akan bisa mengembalikan data ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
