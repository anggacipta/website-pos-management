<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alamat;
use App\Models\Category;
use App\Models\Pembayaran;
use App\Models\PembayaranItems;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class POSController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $products = Product::all();
        $kategoris = Category::all();
        $cart = Session::get('cart', []);
        return view('dashboard.admin.pos_system.index', compact('products', 'cart', 'kategoris'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);
        if ($product && $product->stok > 0) {
            $cart = Session::get('cart', []);
            $cart[$id] = [
                'nama_produk' => $product->nama_produk,
                'harga' => $product->harga,
                'quantity' => isset($cart[$id]) ? $cart[$id]['quantity'] + 1 : 1
            ];
            Session::put('cart', $cart);

            $product->stok -= 1;
            $product->save();
        }
        return response()->json(['cart' => $cart, 'product' => $product]);
    }

    public function processPayment(Request $request)
    {
        $cart = Session::get('cart', []);
        $totalHarga = array_sum(array_map(function($item) {
            return $item['quantity'] * $item['harga'];
        }, $cart));

        $diskon = $request->input('diskon', 0);
        $pajak = $request->input('pajak', 0);
        $totalDiskon = $totalHarga * $diskon / 100;
        $totalPajak = $totalHarga * $pajak / 100;

        $totalHarga = $totalHarga - $totalDiskon + $totalPajak;

        $pembayaran = Pembayaran::create([
            'total_harga' => $totalHarga,
            'uang_diterima' => $request->input('uang_diterima'),
            'kembalian' => $request->input('uang_diterima') - $totalHarga,
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'status' => 'completed',
            'catatan' => $request->input('catatan'),
            'diskon' => $diskon,
            'pajak' => $pajak,
            'user_id' => auth()->id(),
        ]);

        $customer = new Buyer([
            'name' => auth()->user()->name,
            'custom_fields' => [
                'email' => auth()->user()->email,
            ],
        ]);

        $items = [];
        foreach ($cart as $id => $item) {
            PembayaranItems::create([
                'pembayaran_id' => $pembayaran->id,
                'product_id' => $id,
                'jumlah' => $item['quantity'],
                'harga' => $item['harga'],
            ]);

            $items[] = (new InvoiceItem())->title($item['nama_produk'])->pricePerUnit($item['harga'])->quantity($item['quantity']);
        }

        $invoice = Invoice::make('receipt')
            ->buyer($customer)
            ->addItems($items)
            ->date(now())
            ->dateFormat('d/m/Y')
            ->currencySymbol('Rp')
            ->currencyCode('IDR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->template('custom') // Use the custom template
            ->logo(public_path('assets/images/logos/logo-barokah.jpeg')); // Set the logo path

        Session::forget('cart');

        return redirect()->route('pos.index')->with('success', 'Pembayaran sukses')->with('payment_id', $pembayaran->id);
    }

    public function showInvoice($id)
    {
        $pembayaran = Pembayaran::with('items.product')->findOrFail($id);
        $customer = new Buyer([
            'name' => auth()->user()->name,
            'custom_fields' => [
                'email' => auth()->user()->email,
            ],
        ]);

        $items = [];
        foreach ($pembayaran->items as $item) {
            $items[] = (new InvoiceItem())->title($item->product->nama_produk)->pricePerUnit($item->harga)->quantity($item->jumlah);
        }

        $alamat = Alamat::query()->first(); // Retrieve the address from the `alamats` table

        $invoice = Invoice::make('receipt')
            ->buyer($customer)
            ->addItems($items)
            ->date($pembayaran->created_at)
            ->discountByPercent($pembayaran->diskon)
            ->taxRate($pembayaran->pajak)
            ->dateFormat('d/m/Y')
            ->currencySymbol('Rp')
            ->currencyCode('IDR')
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->template('custom') // Use the custom template
            ->logo(public_path('assets/images/logos/logo-barokah.jpeg')) // Set the logo path
            ->setCustomData([
                'alamat' => $alamat ? $alamat->alamat : '', // Ensure this is a string
                'uang_diterima' => $pembayaran->uang_diterima,
                'kembalian' => $pembayaran->kembalian,
            ]);

        return $invoice->stream();
    }

    public function increaseCartItem($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $product = Product::find($id);
            if ($product && $product->stok > 0) {
                $cart[$id]['quantity'] += 1;
                Session::put('cart', $cart);

                $product->stok -= 1;
                $product->save();
            }
        }
        return response()->json(['cart' => $cart, 'product' => $product]);
    }

    public function decreaseCartItem($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id]) && $cart[$id]['quantity'] > 0) {
            $product = Product::find($id);
            if ($product) {
                $cart[$id]['quantity'] -= 1;
                if ($cart[$id]['quantity'] == 0) {
                    unset($cart[$id]);
                }
                Session::put('cart', $cart);

                $product->stok += 1;
                $product->save();
            }
        }
        return response()->json(['cart' => $cart, 'product' => $product]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('nama_produk', 'like', "%$query%")->get();
        return response()->json(['products' => $products]);
    }

    public function showLogo()
    {
        $path = public_path('images/20240902_Aqt7UlXDa8.jpg');
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }
}
