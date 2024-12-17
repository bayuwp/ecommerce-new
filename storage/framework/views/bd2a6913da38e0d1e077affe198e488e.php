<?php $__env->startSection('container'); ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Kategori: <?php echo e($kategori->nama); ?></h2>

        <div class="row mt-1">
            <?php $__currentLoopData = $kategori->produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/user/kategori.blade.php ENDPATH**/ ?>