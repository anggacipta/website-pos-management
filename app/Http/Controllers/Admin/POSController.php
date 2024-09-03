<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pembayaran;
use App\Models\PembayaranItems;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use ConsoleTVs\Invoices\Classes\Invoice;
use ConsoleTVs\Invoices\Classes\Items\InvoiceItem;

class POSController extends Controller
{
    public function index()
    {
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

        $invoice = Invoice::make()
            ->template('default') // Use the default template
            ->number($pembayaran->id)
            ->with_pagination(true)
            ->duplicate_header(true)
            ->logo(public_path('assets/images/logos/dark-logo.svg'));

        foreach ($cart as $id => $item) {
            PembayaranItems::create([
                'pembayaran_id' => $pembayaran->id,
                'product_id' => $id,
                'jumlah' => $item['quantity'],
                'harga' => $item['harga'],
            ]);

            $invoice->addItem($item['nama_produk'], $item['quantity'], $item['harga']);
        }

        Session::forget('cart');

        $invoice->save('public');

        // Redirect to pos.index and open a new tab to show the invoice
        return redirect()->route('pos.index')->with('success', 'Pembayaran sukses')->with('invoice_url', route('pos.showInvoice', ['id' => $pembayaran->id]));
    }

    public function showInvoice($id)
    {
        $pembayaran = Pembayaran::with('items.product')->findOrFail($id);
        $invoice = Invoice::make()
            ->template('default')
            ->number($pembayaran->id)
            ->with_pagination(true)
            ->duplicate_header(true)
            ->logo(public_path('assets/images/logos/dark-logo.svg'));

        if ($pembayaran->items) {
            foreach ($pembayaran->items as $item) {
                $invoice->addItem($item->product->nama_produk, $item->jumlah, $item->harga);
            }
        }

        return $invoice->show();
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
}
