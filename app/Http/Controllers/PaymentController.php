<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // return response()->json(['item'=>$request->input('items')]);
        $items = $request ->input('items');

        $request->validate([
            'shipping_cost' => 'required|integer',
        ]);

        $shippingCost = (int) $request->input('shipping_cost');
        $totalAmount = $shippingCost;

        $user = Auth::user();

        $transactionDetails = [
            'transaction_details' => [
                'order_id' => uniqid(), // Menggunakan uniqid() untuk menghasilkan ID unik
                'gross_amount' => $totalAmount, // Total jumlah pembayaran
            ],
            'customer_details' => [
                'first_name' => $user->name, // Nama pelanggan
                'email' => $user->email, // Email pelanggan
                'phone' => $user->phone ?? '081234567890', // Nomor telepon, default jika null
            ],
            'item_details' => array_merge(
                $items, // Detail item produk yang dibeli
                [
                    [
                        'id' => 'ongkir', // ID untuk ongkos kirim
                        'price' => $shippingCost, // Harga ongkos kirim
                        'quantity' => 1, // Jumlah (biasanya 1 untuk ongkos kirim)
                        'name' => 'Ongkir', // Nama item ongkos kirim
                    ],
                ]
            ),
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionDetails);

            return response()->json([
                'status' => 'success',
                'token' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
