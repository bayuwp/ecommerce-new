@extends('user.app')

@section('container')
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <div class="row">
            @foreach($produk as $item)
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


    <!-- Detail Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- Detail akan dimuat di sini -->
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        function showDetail(id) {
            // Mengambil detail produk dengan AJAX
            fetch(`/produk/${id}`)
                .then(response => response.json())
                .then(data => {
                    const content = `
                        <h3>${data.nama}</h3>
                        <p><strong>Harga:</strong> Rp${data.harga.toLocaleString()}</p>
                        <p>${data.deskripsi}</p>
                        <img src="/storage/${data.foto_produk}" alt="${data.nama}" class="img-fluid">
                    `;
                    document.getElementById('detailContent').innerHTML = content;
                    new bootstrap.Modal(document.getElementById('detailModal')).show();
                })
                .catch(error => console.error(error));
        }
    </script>
@endsection
