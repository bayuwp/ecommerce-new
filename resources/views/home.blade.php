@extends('user.app')

@section('container')
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="max-width: 70%; margin: 0 auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://storage.googleapis.com/eraspacelink/pmp/production/banners/images/u3Eu0k4NtpR1nMMKKKvajjzTYKmTyOtJSr04OLjY.jpg" class="d-block w-100" alt="..." style="height: 500px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="https://png.pngtree.com/template/20220331/ourmid/pngtree-new-sports-shoes-promotion-rotation-banner-image_909903.jpg" class="d-block w-100" alt="..." style="height: 500px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="https://sportaways.com/media/rokanthemes/blog/images/b/n/bn1.jpg" class="d-block w-100" alt="..." style="height: 500px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="https://sportaways.com/media/rokanthemes/blog/images/b/n/bn3.jpg" class="d-block w-100" alt="..." style="height: 500px; object-fit: contain;">
            </div>
            <div class="carousel-item">
                <img src="https://i.ytimg.com/vi/fBonRLiYdYA/maxresdefault.jpg" class="d-block w-100" alt="..." style="height: 500px; object-fit: contain;">
            </div>
        </div>
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
