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
        <form id="checkout-form">
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
                                <img src="{{ asset('storage/' . $cart->produk->foto_produk) }}" class="w-16 md:w-32 max-w-full max-h-full" alt="Product Image">
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                                {{ $cart->produk->nama }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="ms-3">
                                        <input type="number" id="quantity-{{ $cart->id }}" name="quantity-{{ $cart->id }}" class="qty-input bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                value="{{ $cart->quantity }}" data-price="{{ $cart->produk->harga }}" data-cart-id="{{ $cart->id }}">
                                    </div>
                                </div>
                            </td>
                            <td>Rp <span class="price">{{ number_format($cart->produk->harga, 0, ',', '.') }}</span></td>
                            <td class="subtotal"> <span id="subtotal-{{ $cart->id }}">{{ number_format($cart->produk->harga * $cart->quantity, 0, ',', '.') }}</span></td>
                            <td>
                                <input type="checkbox" class="transaction-checkbox" name="selected_products[]" value="{{ $cart->id }}" data-cart-id="{{ $cart->id }}" data-amount="{{ $cart->produk->harga * $cart->quantity }}" {{ in_array($cart->id, old('selected_products', [])) ? 'checked' : '' }}>
                                {{-- <input type="hidden" id="quantity-hidden-{{ $cart->id }}" name="quantities[{{ $cart->id }}]" value="{{ $cart->quantity }}" disabled> --}}
                            </td>
                            <td class="px-6 py-4">
                                <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

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
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#checkoutModal">Checkout</button>
                </div>
            </div>

            <!-- Modal Checkout -->
            <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="checkoutModalLabel">Checkout Produk</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- Pilih Provinsi Asal -->
                            <div class="form-group">
                                <label for="origin-province" class="col-form-label">Provinsi Asal:</label>
                                <select class="form-control" id="origin-province" name="origin_province" required>
                                    <option value="">Pilih Provinsi Asal</option>
                                    @if(isset($provinces) && count($provinces) > 0)
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Data provinsi tidak tersedia.</option>
                                    @endif
                                </select>
                                <small class="form-text text-danger d-none" id="origin-province-error">Provinsi asal harus dipilih.</small>
                            </div>

                            <!-- Pilih Kota Asal -->
                            <div class="form-group">
                                <label for="origin-city" class="col-form-label">Asal Kota:</label>
                                <select class="form-control" id="origin-city" name="origin_city" required disabled>
                                    <option value="">Pilih Kota Asal</option>
                                </select>
                                <small class="form-text text-danger d-none" id="origin-city-error">Kota asal harus dipilih.</small>
                            </div>

                            <!-- Pilih Provinsi Tujuan -->
                            <div class="form-group">
                                <label for="destination-province" class="col-form-label">Provinsi Tujuan:</label>
                                <select class="form-control" id="destination-province" name="destination_province" required>
                                    <option value="">Pilih Provinsi Tujuan</option>
                                    @if(isset($provinces) && count($provinces) > 0)
                                        @foreach ($provinces as $province)
                                            <option value="{{ $province['province_id'] }}">{{ $province['province'] }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled>Data provinsi tidak tersedia.</option>
                                    @endif
                                </select>
                                <small class="form-text text-danger d-none" id="destination-province-error">Provinsi tujuan harus dipilih.</small>
                            </div>

                            <!-- Pilih Kota Tujuan -->
                            <div class="form-group">
                                <label for="destination-city" class="col-form-label">Tujuan Kota:</label>
                                <select class="form-control" id="destination-city" name="destination_city" required disabled>
                                    <option value="">Pilih Kota Tujuan</option>
                                </select>
                                <small class="form-text text-danger d-none" id="destination-city-error">Kota tujuan harus dipilih.</small>
                            </div>

                            <!-- Berat Pengiriman -->
                            <div class="form-group">
                                <label for="weight" class="col-form-label">Berat (gram):</label>
                                <input type="number" class="form-control" id="weight" name="weight" required min="1">
                                <small class="form-text text-danger d-none" id="weight-error">Berat pengiriman harus diisi dengan benar.</small>
                            </div>

                            <!-- Pilih Kurir -->
                            <div class="form-group">
                                <label for="courier" class="col-form-label">Kurir:</label>
                                <select class="form-control" id="courier" name="courier" required>
                                    <option value="">Pilih Kurir</option>
                                    <option value="jne">JNE</option>
                                    <option value="pos">POS Indonesia</option>
                                    <option value="tiki">Tiki</option>
                                </select>
                                <small class="form-text text-danger d-none" id="courier-error">Kurir harus dipilih.</small>
                            </div>

                            <!-- Alamat Detail -->
                            <div class="form-group">
                                <label for="address-detail" class="col-form-label">Alamat Detail:</label>
                                <textarea class="form-control" id="address-detail" name="address_detail" rows="3" placeholder="Masukkan alamat lengkap Anda..." required></textarea>
                                <small class="form-text text-danger d-none" id="address-error">Alamat detail harus diisi.</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="submitCheckout()">Hitung Ongkos Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="modal fade" id="checkoutResult" tabindex="-1" role="dialog" aria-labelledby="checkoutResultLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkoutModalLabel">Checkout Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="checkout-result" style="margin-top: 20px; padding: 7px;"></div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            // Reset form dan hasil ketika modal dibuka
            $('#checkoutModal').on('show.bs.modal', function() {
                $('#checkout-form')[0].reset();
                $('#checkout-result').empty();
                $('#origin-city').empty().prop('disabled', true).append('<option value="">Pilih Kota Asal</option>');
                $('#destination-city').empty().prop('disabled', true).append('<option value="">Pilih Kota Tujuan</option>');
            });

            // Reset form saat modal ditutup
            $('#checkoutModal').on('hidden.bs.modal', function() {
                $('checkout-form')[0].reset();
                $('checkout-result').empty();
            });

            function getProvinces() {
                $.ajax({
                    url: 'http://localhost:8000/api/rajaongkir/provinces',
                    method: 'GET',
                    success: function(data) {
                        const provinces = data.rajaongkir.results;
                        const originProvinceSelect = $('#origin-province');
                        const destinationProvinceSelect = $('#destination-province');

                        originProvinceSelect.empty();
                        destinationProvinceSelect.empty();

                        originProvinceSelect.append('<option value="">Pilih Provinsi Asal</option>');
                        destinationProvinceSelect.append('<option value="">Pilih Provinsi Tujuan</option>');

                        provinces.forEach(function(province) {
                            originProvinceSelect.append('<option value="' + province.province_id + '">' + province.province + '</option>');
                            destinationProvinceSelect.append('<option value="' + province.province_id + '">' + province.province + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching provinces: ' + textStatus, errorThrown);
                        alert('Gagal mengambil data provinsi. Silakan coba lagi.');
                    }
                });
            }

            function getCitiesByProvince(provinceId, selectElement) {
                $.ajax({
                    url: 'http://localhost:8000/api/rajaongkir/cities/' + provinceId,
                    method: 'GET',
                    success: function(data) {
                        const cities = data.results;

                        if (cities && cities.length > 0) {
                            selectElement.empty();
                            selectElement.append('<option value="">Pilih Kota</option>');

                            cities.forEach(function(city) {
                                selectElement.append('<option value="' + city.city_id + '">' + city.type + ' ' + city.city_name + '</option>');
                            });

                            selectElement.removeAttr('disabled');
                        } else {
                            selectElement.empty().append('<option value="">Tidak ada kota ditemukan.</option>').attr('disabled', 'disabled');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error fetching cities: ' + textStatus, errorThrown);
                        alert('Gagal mengambil data kota. Silakan coba lagi.');
                    }
                });
            }

            $('#origin-province').on('change', function() {
                let provinceId = $(this).val();

                if (provinceId) {
                    getCitiesByProvince(provinceId, $('#origin-city'));
                } else {
                    $('#origin-city').empty().append('<option value="">Pilih Kota Asal</option>').attr('disabled', 'disabled');
                    $('#destination-city').empty().append('<option value="">Pilih Kota Tujuan</option>').attr('disabled', 'disabled');
                }
            });

            $('#destination-province').on('change', function() {
                let provinceId = $(this).val();

                if (provinceId) {
                    getCitiesByProvince(provinceId, $('#destination-city'));
                } else {
                    $('#destination-city').empty().append('<option value="">Pilih Kota Tujuan</option>').attr('disabled', 'disabled');
                }
            });

            getProvinces();
        });

        function submitCheckout() {
            const form = document.getElementById('checkout-form');

            if (!form) {
                console.error('Form tidak ditemukan!');
                alert('Terjadi kesalahan. Form tidak ditemukan.');
                return;
            }

            const formData = new FormData(form);
            const requiredFields = [
                'origin_province', 'origin_city',
                'destination_province', 'destination_city',
                'weight', 'courier', 'address_detail'
            ];
            let hasError = false;

            requiredFields.forEach(field => {
                const fieldValue = formData.get(field);
                const errorElement = document.getElementById(`${field}-error`);

                if (!fieldValue || fieldValue.trim() === '') {
                    hasError = true;
                    errorElement?.classList.remove('d-none');
                } else {
                    errorElement?.classList.add('d-none');
                }
            });

            const weight = formData.get('weight');
            const weightError = document.getElementById('weight-error');
            if (weight && (weight <= 0 || isNaN(weight))) {
                hasError = true;
                weightError?.classList.remove('d-none');
            } else {
                weightError?.classList.add('d-none');
            }

            if (hasError) {
                alert('Harap lengkapi semua field sebelum melanjutkan.');
                return;
            }

            $.ajax({
                url: "{{ route('calculateShipping') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#checkout-form').hide();
                        $('#checkout-result').show();
                        showResultForm(response);
                    } else {
                        console.log("response", response)
                        alert('Gagal mendapatkan ongkos kirim: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Terjadi kesalahan saat memproses checkout.');
                }
            });
        }

        function showResultForm(data) {
            console.log("Data received:", data);
            const container = $('#checkout-result');
            container.empty();

            dataRequest = data.request
            data = data.data
            if (!data || data.length === 0) {
                console.log("No shipping options available.");
                container.append('<p>Tidak ada pilihan pengiriman tersedia.</p>');
                return;
            }

            const formElement = $('<form id="result-form" style="padding: 7px;"></form>');

            data.forEach((courier, courierIndex) => {
                const courierElement = $(`<div><h4>${courier.service} (${courier.description})</h4></div>`);

                if (Array.isArray(courier.cost) && courier.cost.length > 0) {
                    courier.cost.forEach((costOption, index) => {
                        courierElement.append(`
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping_option" id="shipping_${courierIndex}_${index}" value="${costOption.value}">
                                <label class="form-check-label" for="shipping_${courierIndex}_${index}">
                                    ${courier.service} (${courier.description}) - Harga: Rp ${costOption.value} - Estimasi: ${costOption.etd} hari
                                </label>
                            </div>
                        `);
                    });
                }
                formElement.append(courierElement);
            });

            const submitButtonContainer = $('<div class="d-flex justify-content-end mt-2"></div>');
            const submitButton = $('<button type="button" class="btn btn-primary">Lanjutkan ke Pembayaran</button>');

            submitButton.on('click', function () {
                processPayment(dataRequest);
            });

            submitButtonContainer.append(submitButton);
            formElement.append(submitButtonContainer);
            container.append(formElement);

            console.log("Form appended to container:", container);
            $('#checkoutResult').modal('show');
        }


        function processPayment(dataRequest) {
            console.log("dataRequest", dataRequest)
            const selectedOption = $('input[name="shipping_option"]:checked').val();

            $.ajax({
                url: "{{ route('checkout.payment') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    shipping_cost: selectedOption,
                },
                success: function(response) {
                    if (response.status === 'success') {
                        window.snap.pay(response.token, {
                            onSuccess: function(result) {
                                alert('Pembayaran berhasil!');
                                console.log(result);
                                $.ajax({
                                    url: "{{ route('checkout.store') }}",
                                    type: 'POST',
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                        payment_result: result,
                                        original_request: dataRequest
                                    },
                                    success: function(storeResponse) {
                                        alert('Data berhasil disimpan.');
                                        console.log(storeResponse);

                                        window.location.href = "/cart";
                                    },
                                    error: function(xhr) {
                                        console.error(xhr);
                                        alert('Terjadi kesalahan saat menyimpan data checkout.');
                                    }
                                });
                            },
                            onPending: function(result) {
                                alert('Pembayaran tertunda.');
                                console.log(result);
                            },
                            onError: function(result) {
                                alert('Terjadi kesalahan dalam pembayaran.');
                                console.log(result);
                            }
                        });
                    } else {
                        alert('Gagal memproses pembayaran: ' + response.message);
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                    alert('Terjadi kesalahan saat memproses pembayaran.');
                }
            });
        }


        document.addEventListener('DOMContentLoaded', function () {
            const qtyInputs = document.querySelectorAll('.qty-input');
            qtyInputs.forEach(input => {
                input.addEventListener('input', function () {
                    const cartId = this.dataset.cartId;
                    const price = parseInt(this.dataset.price);
                    const quantity = parseInt(this.value);
                    const subtotal = price * quantity;
                    document.getElementById('subtotal-' + cartId).textContent = 'Rp ' + subtotal.toLocaleString();
                    updateTotal();
                });
            });

            // Fungsi untuk menghitung total belanja
            function updateTotal() {
                let total = 0;
                const selectedProducts = document.querySelectorAll('.transaction-checkbox:checked');

                selectedProducts.forEach(product => {
                    const cartId = product.value;
                    const subtotal = parseInt(
                        document.getElementById('subtotal-' + cartId)
                        .textContent.replace('Rp ', '').replace(/\./g, '')
                    );
                    total += subtotal;
                });

                document.getElementById('totalHarga').textContent = total.toLocaleString('id-ID');
            }

            // Event listener untuk checkbox
            const checkboxes = document.querySelectorAll('.transaction-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateTotal);
            });
        });
    </script>
@endpush
