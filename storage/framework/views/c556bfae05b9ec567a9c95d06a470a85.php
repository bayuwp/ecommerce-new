<?php $__env->startSection('container'); ?>
    <section class="contact py-5">
        <div class="container">
            <div class="content text-center mb-5">
                <h2>Contact Us</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam, corrupti. Praesentium, fugiat incidunt? Vero quo quod sequi eaque? Iusto facilis placeat totam et tempore beatae eum asperiores eius voluptatibus? Libero.</p>
            </div>

            <div class="row">
                <!-- Contact Info on the Left -->
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fa fa-map-marker fa-2x me-3"></i>
                                        <div>
                                            <h5 class="card-title">Address</h5>
                                            <p class="card-text">62391 Kradena, Palang <br>Tuban, Jawa Timur <br>392674</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fa fa-phone-square fa-2x me-3"></i>
                                        <div>
                                            <h5 class="card-title">Phone</h5>
                                            <p class="card-text">0895-3953-80933</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fa fa-envelope fa-2x me-3"></i>
                                        <div>
                                            <h5 class="card-title">Email</h5>
                                            <p class="card-text">bayu.22140@mhs.unesa.ac.id</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form on the Right -->
                <div class="col-md-6">
                    <div class="contactform mt-5">
                        <h2 class="text-center mb-3">Send Message</h2>
                        <form action="" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Type your Message</label>
                                <textarea class="form-control" id="message" rows="4" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/user/ContactUs.blade.php ENDPATH**/ ?>