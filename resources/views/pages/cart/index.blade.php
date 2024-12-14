@extends('user.app') <!-- Sesuaikan dengan layout Anda -->

@section('container')
<div class="container mt-5">
    <h1>Keranjang Belanja</h1>

    <!-- Menampilkan Pesan Sukses -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Cek Apakah Keranjang Kosong -->
    @if($carts->isEmpty())
        <div class="alert alert-warning">
            Keranjang belanja Anda kosong.
        </div>
    @else
        <form action="{{ route('carts.checkout') }}" method="POST">
            @csrf
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="p-4">No</th>
                            <th scope="col" class="px-16 py-3"><span class="sr-only">Image</span></th>
                            <th scope="col" class="px-6 py-3">Product</th>
                            <th scope="col" class="px-6 py-3">Qty</th>
                            <th scope="col" class="px-6 py-3">Price</th>
                            <th scope="col" class="px-6 py-3">Subtotal</th>
                            <th>Pilih</th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($carts as $key => $cart)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="p-4">{{ $key + 1 }}</td>
                            <td class="p-4">
                                <img src="{{ asset('storage/' . $cart->produk->foto_produk) }}" class="w-16 md:w-32 max-w-full max-h-full" alt="Apple Watch">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            {{ $cart->produk->nama }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <button class="inline-flex items-center justify-center p-1 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                        </svg> 
                                    </button>
                                    <div class="ms-3">
                                        <input type="number" id="first_product" class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" required value="" />
                                    </div>
                                    <button class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700" type="button">
                                        <span class="sr-only">Quantity button</span>
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                            <td>Rp {{ number_format($cart->produk->harga * $cart->quantity, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                            Rp {{ number_format($cart->produk->harga, 0, ',', '.') }}       
                            </td>
                            <td>
                                <input type="checkbox"
                                    class="transaction-checkbox"
                                    name="selected_products[]"
                                    value="{{ $cart->id }}"
                                    data-amount="{{ $cart->produk->harga * $cart->quantity }}"
                                    {{ in_array($cart->id, old('selected_products', [])) ? 'checked' : '' }}>
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>  
            <div class="d-flex justify-content-between my-4">
                <h3>Total: Rp <span id="totalHarga">
                    @php
                        $total = 0;
                        $selectedProducts = old('selected_products', []);
                        foreach($carts as $cart) {
                            if (in_array($cart->id, $selectedProducts)) {
                                $total += $cart->produk->harga * $cart->quantity;
                            }
                        }
                        echo number_format($total, 0, ',', '.');
                    @endphp
                </span></h3>
                <button type="submit" class="btn btn-success">Checkout</button>
            </div>
        </form>
        
        <!-- <form action="{{ route('carts.checkout') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Pilih</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carts as $key => $cart)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $cart->produk->nama }}</td>
                            <td>{{ $cart->quantity }}</td>
                            <td>Rp {{ number_format($cart->produk->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($cart->produk->harga * $cart->quantity, 0, ',', '.') }}</td>
                            <td>
                                <input type="checkbox"
                                        class="transaction-checkbox"
                                        name="selected_products[]"
                                        value="{{ $cart->id }}"
                                        data-amount="{{ $cart->produk->harga * $cart->quantity }}"
                                        {{ in_array($cart->id, old('selected_products', [])) ? 'checked' : '' }}>
                                </td>
                            <td>
                                <form action="{{ route('carts.remove') }}" method="POST" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-between mt-4">
                <h3>Total: Rp <span id="totalHarga">
                    @php
                        $total = 0;
                        $selectedProducts = old('selected_products', []);
                        foreach($carts as $cart) {
                            if (in_array($cart->id, $selectedProducts)) {
                                $total += $cart->produk->harga * $cart->quantity;
                            }
                        }
                        echo number_format($total, 0, ',', '.');
                    @endphp
                </span></h3>
                <button type="submit" class="btn btn-success">Checkout</button>
            </div>
        </form> -->
    @endif
</div>

<script>
    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.transaction-checkbox:checked').forEach(checkbox => {
            total += parseInt(checkbox.getAttribute('data-amount')) || 0;
        });
        document.getElementById('totalHarga').textContent = total.toLocaleString('id-ID');
    }

    // Panggil fungsi ketika ada perubahan pada checkbox
    document.querySelectorAll('.transaction-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', calculateTotal);
    });
</script>
@endsection
