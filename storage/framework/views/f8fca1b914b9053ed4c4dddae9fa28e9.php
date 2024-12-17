<?php $__env->startSection('container'); ?>
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
            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-12">
                <!-- Start Single Product -->
                <div class="single-product">
                    <div class="product-image" style="position: relative;width: 100%;height: 300px;overflow: hidden;">
                        <img src="<?php echo e(asset('storage/' . $item->foto_produk)); ?>" alt="#" style="width: 100%; height: 300px; object-fit: cover;">
                        <form action="<?php echo e(route('carts.add')); ?>" method="POST" class="mt-2">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="produk_id" value="<?php echo e($item->id); ?>">
                            <input type="hidden" name="quantity" id="quantity_<?php echo e($item->id); ?>" class="form-control" min="1" value="1" required>
                            <div class="button">
                                <button type="submit" class="btn"><i class="lni lni-cart"></i> Add to Cart</button>
                            </div>  
                        </form>
                    </div>
                    <div class="product-info">
                        <span class="category"><?php echo e($item->kategori_nama); ?></span>
                        <h4 class="title">
                            <a href="product-grids.html"><?php echo e($item->nama); ?></a>
                        </h4>
                        <div class="price">
                            <span>Rp<?php echo e(number_format($item->harga, 0, ',', '.')); ?></span>
                        </div>
                    </div>
                </div>
                <!-- End Single Product -->
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/home.blade.php ENDPATH**/ ?>