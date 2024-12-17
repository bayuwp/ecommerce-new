<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        $produk = Produk::join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')
                ->select('produks.*', 'kategoris.nama as kategori_nama')
                ->get();
        $bestSellingProducts = Produk::orderBy('sold', 'desc')->take(5)->get();
        $recommendedProducts = Produk::inRandomOrder()->take(5)->get();

        $cartCount = auth()->check() ? auth()->user()->carts->count() : 0;
        $carts = auth()->check() ? auth()->user()->carts : 0;

        return view('home', [
            'kategoris' => $kategoris,
            'produk' => $produk,
            'bestSellingProducts' => $bestSellingProducts,
            'recommendedProducts' => $recommendedProducts,
            'cartCount' => $cartCount,
            'carts' =>  $carts
        ]);

    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function navbar()
    {
        $kategoris = Kategori::all();
        return view('pages.cart.index', compact('kategoris'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $kategori = $request->input('kategori', 'all');

        if ($category != 'all') {
            $results = $results->where('kategori_id', $kategori);
        }
        $results = Produk::where('nama')->get();
        return view('user.navbar', compact('results'));
    }

}
