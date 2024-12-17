<?php $__env->startSection('container'); ?>
<div class="container">
    <h2>Riwayat Transaksi</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
    <?php endif; ?>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Pilih</th>
                <th>ID Order</th>
                <th>User</th>  <!-- Ganti 'Pelanggan' menjadi 'User' -->
                <th>Produk</th>
                <th>Payment Type</th>
                <th>Gross Amount</th>
                <th>Transaction Time</th>
                <th>Transaction Status</th>
                <th>Metadata</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $transaktions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaksi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <input type="checkbox" class="transaction-checkbox" data-amount="<?php echo e($transaksi->gross_amount); ?>" aria-label="Pilih transaksi <?php echo e($transaksi->order_id); ?>">
                    </td>
                    <td><?php echo e($transaksi->order_id); ?></td>
                    <td><?php echo e($transaksi->user->name ?? 'N/A'); ?></td> <!-- Menampilkan nama user yang terkait -->
                    <td><?php echo e($transaksi->produk->nama ?? 'N/A'); ?></td>
                    <td><?php echo e($transaksi->payment_type ?? 'N/A'); ?></td>
                    <td>Rp <?php echo e(number_format($transaksi->gross_amount, 0, ',', '.')); ?></td>
                    <td><?php echo e($transaksi->transaction_time ? \Carbon\Carbon::parse($transaksi->transaction_time)->format('Y-m-d H:i:s') : 'N/A'); ?></td>
                    <td><?php echo e(ucfirst($transaksi->transaction_status)); ?></td>
                    <td>
                        <pre class="bg-light p-2"><?php echo e(json_encode(json_decode($transaksi->metadata), JSON_PRETTY_PRINT)); ?></pre>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="showDetails('<?php echo e($transaksi->order_id); ?>')">Detail</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteTransaction('<?php echo e($transaksi->order_id); ?>')">Hapus</button>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="10" class="text-center">Tidak ada transaksi ditemukan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/user/transaksi.blade.php ENDPATH**/ ?>