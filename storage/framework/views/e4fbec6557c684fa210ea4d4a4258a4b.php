<?php $__env->startSection('container'); ?>
<div class="container">
    <h1 class="mt-4">Daftar Transaksi</h1>

    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>


    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Pilih</th>
                <th>ID Order</th>
                <th>Pelanggan</th>
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
                    <td><?php echo e($transaksi->user_id->name ?? 'N/A'); ?></td>
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

    <div class="d-flex justify-content-between align-items-center mt-4">
        <h5>Total Harga yang Harus Dibayar: Rp <span id="totalHarga">0</span></h5>
        <button class="btn btn-success btn-lg" onclick="checkout()">Checkout</button>
    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo e(env('MIDTRANS_CLIENT_KEY')); ?>"></script>
    <script>
        document.querySelectorAll('.transaction-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', calculateTotal);
        });

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.transaction-checkbox:checked').forEach(checkbox => {
                total += parseInt(checkbox.getAttribute('data-amount')) || 0;
            });
            document.getElementById('totalHarga').textContent = total.toLocaleString('id-ID');
            return total;
        }

    function checkout() {
        let totalHarga = calculateTotal();
        let selectedTransactions = [];

        document.querySelectorAll('.transaction-checkbox:checked').forEach(checkbox => {
            selectedTransactions.push({
                order_id: checkbox.closest('tr').children[1].innerText
            });
        });

        if (selectedTransactions.length === 0) {
            alert("Silakan pilih transaksi yang ingin di-checkout.");
            return;
        }

        let transactionData = {
            transactions: selectedTransactions,
            shipping_cost: totalHarga,
            shipping_service: 'Service Name Here',
        };
        $.ajax({
            url: "<?php echo e(route('checkout.saveTransaction')); ?>",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            data: transactionData,
            success: function(response) {
                console.log(response);
                if (response.redirect_url) {
                    window.location.href = response.redirect_url;
                } else {
                    alert("Terjadi kesalahan saat mendapatkan URL pembayaran.");
                }
            },
            error: function(xhr) {
                alert("Terjadi kesalahan saat menyimpan transaksi. Coba lagi nanti.");
            }
        });
    }


        function deleteTransaction(orderId) {
            if (confirm("Apakah Anda yakin ingin menghapus transaksi ini?")) {
                $.ajax({
                    url: "<?php echo e(route('transactions.delete', ':orderId')); ?>".replace(':orderId', orderId),
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        alert(data.message);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert("Terjadi kesalahan. Coba lagi nanti.");
                    }
                });
            }
        }
    </script>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/pages/admin/transaksi.blade.php ENDPATH**/ ?>