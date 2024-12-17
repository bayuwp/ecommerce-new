<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Auth::user()->carts;
        return view('pages.cart.index', compact('carts'));
    }
    public function addToCart(Request $request)
    {
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->produk_id = $request->produk_id;
        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('carts.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function removeFromCart(Request $request)
    {
        $cart = Cart::find($request->cart_id);
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'selected_products' => 'required|array',
            'selected_products.*' => 'exists:carts,id',
        ]);

        $selectedProducts = Cart::whereIn('id', $request->selected_products)->get();

        $total = $selectedProducts->sum(function ($cart) {
            return $cart->produk->harga * $cart->quantity;
        });

        return view('pages.cart.index', compact('selectedProducts', 'total'));
    }

    public function userOrder()
    {
        $userId = auth()->id();

        $transaksis = Transaksi::where('user_id', $userId)
            ->with('produk') // Eager load produk terkait
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu transaksi terbaru
            ->get();

        return view('user.order', compact('transaksis'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'produk_id' => 'required|exists:produks,id',
            'transaction_id' => 'required|integer',
            'order_id' => 'required|string|max:100',
            'payment_type' => 'nullable|string|max:100',
            'gross_amount' => 'required|integer',
            'transaction_time' => 'nullable|date',
            'transaction_status' => 'required|in:pending,settlement,cancel,expire',
            'metadata' => 'nullable|string',
        ]);

        try {
            // Simpan transaksi ke database
            $transaction = new Transaksi();
            $transaction->transaction_id = $request->transaction_id;
            $transaction->order_id = $request->order_id;
            $transaction->payment_type = $request->payment_type;
            $transaction->gross_amount = $request->gross_amount;
            $transaction->transaction_time = $request->transaction_time ?? now();
            $transaction->transaction_status = $request->transaction_status;
            $transaction->metadata = $request->metadata ? json_encode($request->metadata) : null;
            $transaction->user_id = $request->user_id;
            $transaction->produk_id = $request->produk_id;
            $transaction->save();

            // Redirect ke halaman user order
            return redirect()->route('user.order')->with('success', 'Transaksi berhasil disimpan.');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan transaksi: ' . $e->getMessage());
        }
    }

}
