<?php $__env->startSection('container'); ?>
    <div class="container">
        <h1>Kelola Pelanggan</h1>

        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pelangganModal" onclick="resetForm()">
            Tambah Pelanggan
        </button>

        <!-- Modal untuk Tambah/Edit Pelanggan -->
        <div class="modal fade" id="pelangganModal" tabindex="-1" role="dialog" aria-labelledby="pelangganModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pelangganModalLabel">Tambah Pelanggan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="pelanggan-form" action="<?php echo e(route('admin.pelanggan.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="_method" id="method" value="POST">
                        <input type="hidden" name="pelanggan_id" id="pelanggan_id">

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" required>
                                <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin" required>
                                    <option value="">Pilih</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                                <?php $__errorArgs = ['jenis_kelamin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="nomer_hp" class="form-label">Nomor HP</label>
                                <input type="text" name="nomer_hp" class="form-control" id="nomer_hp" required>
                                <?php $__errorArgs = ['nomer_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" id="alamat" required></textarea>
                                <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label for="foto_profil" class="form-label">Foto Profil</label>
                                <input type="file" name="foto_profil" class="form-control" id="foto_profil" accept="image/*">
                                <?php $__errorArgs = ['foto_profil'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="text-danger"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        
        <div class="mt-5">
            <h3>Daftar Pelanggan</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Jenis Kelamin</th>
                        <th>Email</th>
                        <th>Nomor HP</th>
                        <th>Alamat</th>
                        <th>Foto Profil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $pelanggans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pelanggan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($pelanggan->nama_lengkap); ?></td>
                            <td><?php echo e($pelanggan->jenis_kelamin); ?></td>
                            <td><?php echo e($pelanggan->email); ?></td>
                            <td><?php echo e($pelanggan->nomer_hp); ?></td>
                            <td><?php echo e($pelanggan->alamat); ?></td>
                            <td>
                                <?php if($pelanggan->foto_profil): ?>
                                    <img src="<?php echo e(asset('storage/' . $pelanggan->foto_profil)); ?>" alt="Foto Profil" style="width: 50px; height: auto;">
                                <?php else: ?>
                                    Tidak ada
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" onclick="editPelanggan(<?php echo e(json_encode($pelanggan)); ?>)">Edit</button>
                                <form action="<?php echo e(route('admin.pelanggan.destroy', $pelanggan->id)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>

<?php $__env->startSection('scripts'); ?>
    <script>
        function editPelanggan(pelanggan) {
            document.getElementById('pelangganModalLabel').innerText = 'Edit Pelanggan';
            document.getElementById('pelanggan-form').action = `/admin/pelanggan/${pelanggan.id}`;
            document.getElementById('pelanggan-form').method = 'POST';
            document.getElementById('method').value = 'PUT';
            document.getElementById('pelanggan_id').value = pelanggan.id;

            document.getElementById('nama_lengkap').value = pelanggan.nama_lengkap;
            document.getElementById('jenis_kelamin').value = pelanggan.jenis_kelamin;
            document.getElementById('email').value = pelanggan.email;
            document.getElementById('nomer_hp').value = pelanggan.nomer_hp;
            document.getElementById('alamat').value = pelanggan.alamat;
        }

        function resetForm() {
            document.getElementById('pelangganModalLabel').innerText = 'Tambah Pelanggan';
            document.getElementById('pelanggan-form').action = "<?php echo e(route('admin.pelanggan.store')); ?>";
            document.getElementById('pelanggan-form').method = 'POST';
            document.getElementById('method').value = 'POST';
            document.getElementById('pelanggan_id').value = '';

            document.getElementById('nama_lengkap').value = '';
            document.getElementById('jenis_kelamin').value = '';
            document.getElementById('email').value = '';
            document.getElementById('nomer_hp').value = '';
            document.getElementById('alamat').value = '';
            document.getElementById('foto_profil').value = ''; // Reset file input
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/pages/pelanggan/pelanggan.blade.php ENDPATH**/ ?>