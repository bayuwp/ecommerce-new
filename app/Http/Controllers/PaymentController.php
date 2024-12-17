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

        $request->validate([
            'shipping_cost' => 'required|integer',
        ]);

        $shippingCost = (int) $request->input('shipping_cost');
        $totalAmount = $shippingCost;

        $user = Auth::user();

        $transactionDetails = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $totalAmount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '081234567890',
            ],
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
