@extends('dashboard.admin.layouts.main')
@section('title', 'Kurang Stok')
@section('content')
    <!--  Header Start -->
    @include('dashboard.admin.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Kurangi Stok Produk</h5>
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
                        <form id="barangForm" action="{{ route('products.update-stok-kurang') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="product_id" class="form-label">Nama produk</label>
                                <select class="form-control js-example-basic-single" name="product_id" id="product_id">
                                    <option value="">Pilih Produk</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->nama_produk }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="mb-3">
                                <label for="stok" class="form-label">Jumlah stok produk yang dikurangi</label>
                                <input type="number" name="stok" class="form-control" id="stok"
                                       aria-describedby="emailHelp">
                            </div>
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Alasan stok dikurangi</label>
                                <textarea name="keterangan" class="form-control" id="keterangan"
                                          aria-describedby="emailHelp"></textarea>
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
