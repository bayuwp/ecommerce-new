<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    /**
     * Handle the shipping calculation request.
     */
    public function calculateShipping(Request $request)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'origin_province' => 'required',
            'origin_city' => 'required',
            'destination_province' => 'required',
            'destination_city' => 'required',
            'weight' => 'required|integer|min:1',
            'courier' => 'required',
        ]);

        try {
            // Contoh endpoint API dari penyedia jasa pengiriman, misalnya RajaOngkir
            $response = Http::withHeaders([
                'key' => env('RAJAONGKIR_API_KEY'), // API Key dari RajaOngkir
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $validatedData['origin_city'],
                'destination' => $validatedData['destination_city'],
                'weight' => $validatedData['weight'],
                'courier' => $validatedData['courier'],
            ]);

            $data = $response->json();

            if (isset($data['rajaongkir']['results'][0]['costs'])) {
                return response()->json([
                    'success' => true,
                    'data' => $data['rajaongkir']['results'][0]['costs'],
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data ongkos kirim yang ditemukan.',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghitung ongkos kirim.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Retrieve cities based on selected province.
     */
    public function getCities(Request $request)
    {
        $request->validate([
            'province_id' => 'required',
        ]);

        try {
            $response = Http::withHeaders([
                'key' => env('RAJAONGKIR_API_KEY'),
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $request->province_id,
            ]);

            $data = $response->json();

            if (isset($data['rajaongkir']['results'])) {
                return response()->json([
                    'success' => true,
                    'data' => $data['rajaongkir']['results'],
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data kota yang ditemukan.',
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data kota.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
