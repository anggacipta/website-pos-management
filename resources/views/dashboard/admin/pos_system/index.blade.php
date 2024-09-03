<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS System</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{--  Jquery  --}}
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
</head>
<body>
<a href="{{ route('dashboard.index') }}" class="text-dark">Kembali ke Dashboard</a>
<div class="mx-3">
    <div class="row mt-3">
        <!-- Cart Section -->
        <div class="col-xxl-4 col-lg-5 col-12">
            <h2>Cart</h2>
            <ul id="cart-items">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($cart as $id => $item)
                        <tr id="cart-item-{{ $id }}">
                            <td>{{ $item['nama_produk'] }}</td>
                            <td class="quantity">{{ $item['quantity'] }}</td>
                            <td class="price">Rp{{ $item['harga'] }}</td>
                            <td>Rp{{ $item['quantity'] * $item['harga'] }}</td>
                            <td>
                                <button class="btn btn-success btn-sm increase-cart-item" data-id="{{ $id }}">+</button>
                                <button class="btn btn-danger btn-sm decrease-cart-item" data-id="{{ $id }}">-</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </ul>
            <div class="mb-3">
                <label for="diskon" class="form-label">Diskon</label>
                <input type="number" id="diskon" class="form-control">
            </div>
            <div class="mb-3">
                <label for="pajak" class="form-label">Pajak</label>
                <input type="number" id="pajak" class="form-control">
            </div>
            <h3>Total: <span id="cart-total">Rp{{ array_sum(array_map(function($item) { return $item['quantity'] * $item['harga']; }, $cart)) }}</span></h3>
            <button class="btn me-1 mb-4 bg-primary text-white px-4 fs-4 " style="float: right" data-bs-toggle="modal" data-bs-target="#bs-example-modal-md">
                Bayar
            </button>
        </div>

        <!-- Products Section -->
        <div class="col-xxl-8 col-lg-7 col-12">
            <h2>Products</h2>
            <!-- Filter Buttons -->
            <div class="mb-3">
                <button class="btn btn-primary me-1 filter-button" data-category-id="all">All</button>
                @foreach ($kategoris as $kategori)
                    <button class="btn btn-primary mx-1 filter-button" data-category-id="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</button>
                @endforeach
            </div>
            <div class="row" id="product-list">
                @foreach($products as $product)
                    <div class="col-md-4 product-row" data-category-id="{{ $product->kategori_id }}">
                        <div class="card mb-4">
                            <div class="card-body">
                                <img class="card-img" src="{{ asset($product->gambar) }}" height="200" width="200" alt="">
                                <h5 class="card-title">{{ $product->nama_produk }}</h5>
                                <p class="card-text">Price: {{ $product->harga }}</p>
                                <p class="card-text">Stock: <span id="product-stock-{{ $product->id }}">{{ $product->stok }}</span></p>
                                <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}" {{ $product->stok == 0 ? 'disabled' : '' }}>Add to Cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<!-- ------------------------------------------ -->
<!-- Medium Modal -->
<!-- ------------------------------------------ -->
<!-- sample modal content -->
<div id="bs-example-modal-md" class="modal fade" tabindex="-1" aria-labelledby="bs-example-modal-md" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center">
                <h4 class="modal-title" id="myModalLabel">
                    Pembayaran
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <form action="{{ route('pos.processPayment') }}" method="post" id="payment-form">
                            @csrf
                            <input type="hidden" name="diskon" id="modal-diskon">
                            <input type="hidden" name="pajak" id="modal-pajak">
                            <div class="mb-3">
                                <label for="uang_diterima" class="form-label">Uang Diterima</label>
                                <input type="number" name="uang_diterima" class="form-control" id="uang_diterima" required>
                            </div>
                            <div class="mb-3">
                                <label for="uang_kembalian" class="form-label">Kembalian</label>
                                <input type="number" name="kembalian" class="form-control" id="uang_kembalian" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                                <select name="metode_pembayaran" class="form-select" id="metode_pembayaran" required>
                                    <option value="cash">Cash</option>
                                    <option value="debit">Debit</option>
                                    <option value="credit">Credit</option>
                                    <option value="qris">QRIS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" id="catatan"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="process-payment">Proses Pembayaran</button>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Invoice</h5>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Total Harga</td>
                                        <td id="invoice-total-harga"></td>
                                    </tr>
                                    <tr>
                                        <td>Diskon</td>
                                        <td id="invoice-diskon"></td>
                                    </tr>
                                    <tr>
                                        <td>Pajak</td>
                                        <td id="invoice-pajak"></td>
                                    </tr>
                                    <tr>
                                        <td>Total yang harus dibayar</td>
                                        <td id="invoice-total-bayar"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn bg-danger-subtle text-danger waves-effect" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Medium Modal -->

{{-- End Body Wrap --}}
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script>
    @if(session('invoice_url'))
    window.open("{{ session('invoice_url') }}", '_blank');
    @endif
</script>
<script>
    $(document).ready(function() {
        // Event handlers
        function attachEventHandlers() {
            $('.add-to-cart').off('click').on('click', function() {
                var id = $(this).data('id');
                $.post("{{ url('/pos/add-to-cart') }}/" + id, {_token: "{{ csrf_token() }}"}, function(data) {
                    updateCart(data.cart);
                    updateProductStock(data.product);
                });
            });

            $('.increase-cart-item').off('click').on('click', function() {
                var id = $(this).data('id');
                $.post("{{ url('/pos/increase-cart-item') }}/" + id, {_token: "{{ csrf_token() }}"}, function(data) {
                    updateCart(data.cart);
                    updateProductStock(data.product);
                });
            });

            $('.decrease-cart-item').off('click').on('click', function() {
                var id = $(this).data('id');
                $.post("{{ url('/pos/decrease-cart-item') }}/" + id, {_token: "{{ csrf_token() }}"}, function(data) {
                    updateCart(data.cart);
                    updateProductStock(data.product);
                });
            });
        }

        // Update Cart
        function updateCart(cart) {
            var total = 0;
            $('#cart-items tbody').empty();
            $.each(cart, function(id, item) {
                if (item.quantity > 0) {
                    $('#cart-items tbody').append(
                        '<tr>' +
                        '<td>' + item.nama_produk + '</td>' +
                        '<td class="quantity">' + item.quantity + '</td>' +
                        '<td class="price">Rp' + item.harga + '</td>' +
                        '<td> Rp' + item.quantity * item.harga + '</td>' +
                        '<td>' +
                        '<button class="btn btn-success btn-sm increase-cart-item" data-id="' + id + '">+</button>' +
                        '<button class="btn btn-danger btn-sm decrease-cart-item" data-id="' + id + '">-</button>' +
                        '</td>' +
                        '</tr>'
                    );
                    total += item.quantity * item.harga;
                }
            });
            $('#cart-total').text('Rp' + total);
            attachEventHandlers();
        }

        // Update Product Stock
        function updateProductStock(product) {
            $('#product-stock-' + product.id).text(product.stok);
            if (product.stok == 0) {
                $('.add-to-cart[data-id="' + product.id + '"]').attr('disabled', 'disabled');
            } else {
                $('.add-to-cart[data-id="' + product.id + '"]').removeAttr('disabled');
            }
        }

        // Calculate Total
        function calculateTotal() {
            var total = 0;
            $('#cart-items tbody tr').each(function() {
                var quantity = parseInt($(this).find('.quantity').text());
                var price = parseInt($(this).find('.price').text().replace(/[^0-9]/g, ''));
                total += quantity * price;
            });
            var diskon = parseInt($('#diskon').val()) || 0;
            var pajak = parseInt($('#pajak').val()) || 0;
            var hitungDiskon = total * diskon / 100;
            var hitungPajak = total * pajak / 100;
            total = total - hitungDiskon + hitungPajak;
            $('#cart-total').text('Rp' + total);
        }

        // Calculate Change
        function calculateChange() {
            var uangDiterima = parseInt($('#uang_diterima').val()) || 0;
            var totalBayar = parseInt($('#invoice-total-bayar').text().replace(/[^0-9]/g, ''));
            var kembalian = uangDiterima - totalBayar;
            $('#uang_kembalian').val(kembalian);
        }

        // Event listeners
        $('#diskon, #pajak').on('input', function() {
            calculateTotal();
        });

        $('#bs-example-modal-md').on('show.bs.modal', function() {
            var totalHarga = parseInt($('#cart-total').text().replace(/[^0-9]/g, ''));
            var diskon = parseInt($('#diskon').val()) || 0;
            var pajak = parseInt($('#pajak').val()) || 0;
            var totalBayar = totalHarga;

            $('#modal-diskon').val(diskon);
            $('#modal-pajak').val(pajak);
            $('#invoice-total-harga').text('Rp' + totalHarga);
            $('#invoice-diskon').text(diskon + '%');
            $('#invoice-pajak').text(pajak + '%');
            $('#invoice-total-bayar').text('Rp' + totalBayar);
        });

        $('#uang_diterima').on('input', function() {
            calculateChange();
        });

        // Filter products by category
        $('.filter-button').on('click', function() {
            var categoryId = $(this).data('category-id');
            if (categoryId === 'all') {
                $('.product-row').show();
            } else {
                $('.product-row').hide();
                $('.product-row[data-category-id="' + categoryId + '"]').show();
            }
        });

        attachEventHandlers();
    });
</script>

{{-- Toastr --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (session('success'))
    toastr.success("{{ session('success') }}");
    @endif

    @if (session('error'))
    toastr.error("{{ session('error') }}");
    @endif

    @if (session('info'))
    toastr.info("{{ session('info') }}");
    @endif

    @if (session('warning'))
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>
</html>
