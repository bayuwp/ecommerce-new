@extends('user.app')

@section('container')
    <div class="container my-5">
        <h2 class="text-center mb-4">Kategori: {{ $kategori->nama }}</h2>

        <div class="row mt-1">
            @foreach($kategori->produk as $item)
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-image" style="position: relative;width: 100%;height: 300px;overflow: hidden;">
                        <img src="{{ asset('storage/' . $item->foto_produk) }}" alt="#" style="width: 100%; height: 300px; object-fit: cover;">
                        <form action="{{ route('carts.add') }}" method="POST" class="mt-2">
                            @csrf
                            <input type="hidden" name="produk_id" value="{{ $item->id }}">
                            <input type="hidden" name="quantity" id="quantity_{{ $item->id }}" class="form-control" min="1" value="1" required>
                            <div class="button">
                                <button type="submit" class="btn"><i class="lni lni-cart"></i> Add to Cart</button>
                            </div>  
                        </form>
                    </div>
                    <div class="product-info">
                        <span class="category">{{ $item->kategori_nama }}</span>
                        <h4 class="title">
                            <a href="product-grids.html">{{ $item->nama }}</a>
                        </h4>
                        <div class="price">
                            <span>Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
            @endforeach
        </div>
    </div>
@endsection
