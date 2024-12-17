<?php

namespace App\Http\Controllers;

use App\Models\Transaksi; // Model transaksi
use Illuminate\Http\Request;

class OrderControllerUser extends Controller
{
    public function index()
    {
        // Ambil semua transaksi dari database
        $transaktions = Transaksi::with(['user', 'produk'])->get();

        // Tampilkan view dengan data transaksi
        return view('user.transaksi', compact('transaktions'));
    }

    public function show($id)
    {
        // Ambil data transaksi beserta user terkait
        $transaksi = Transaksi::with('user')->findOrFail($id);

        // Kirimkan data transaksi ke view
        return view('user.transaksi', [
            'transaksi' => $transaksi, // Pastikan nama variabel ini konsisten
        ]);
    }
}
