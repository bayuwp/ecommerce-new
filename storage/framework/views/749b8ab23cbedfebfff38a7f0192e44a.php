<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">E-commerce</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('produk.byKategori', $kategori->id)); ?>">
                                        <?php echo e($kategori->nama); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="bestSellingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produk Terlaris
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="bestSellingDropdown">
                            <?php $__currentLoopData = $bestSellingProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('produk.show', $product->id)); ?>">
                                        <?php echo e($product->nama); ?> - <?php echo e($product->sold); ?> terjual
                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="recommendedDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produk Rekomendasi
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="recommendedDropdown">
                            <?php $__currentLoopData = $recommendedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('produk.show', $product->id)); ?>">
                                        <?php echo e($product->nama); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <form class="d-flex mx-auto" method="GET" action="<?php echo e(route('search')); ?>">
            <input class="form-control me-2" type="search" name="query" placeholder="Cari produk..." aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Cari</button>
        </form>

        <a href="<?php echo e(route('carts.index')); ?>" class="nav-link">
            <i class="fa fa-shopping-cart" style="font-size: 24px;"></i>
            <?php if($cartCount > 0): ?>
                <span class="badge bg-danger rounded-pill">
                    <?php echo e($cartCount); ?>

                </span>
            <?php endif; ?>
        </a>

        <ul class="navbar-nav ms-auto">
            <?php if(auth()->guard()->guest()): ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>">Register</a></li>
            <?php else: ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>

    </div>
</nav> -->

<header class="header navbar-area">
    <!-- Start Topbar -->
    <div class="topbar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 col-12"></div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-middle">
                        <ul class="useful-links">
                            <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                            <li><a href="about-us.html">About Us</a></li>
                            <li><a href="contact.html">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-end">
                        <?php if(auth()->guard()->guest()): ?>
                        <ul class="user-login">
                            <li>
                                <a href="<?php echo e(route('login')); ?>">Sign In</a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('register')); ?>">Register</a>
                            </li>
                        </ul>
                        <?php else: ?>
                        <div class="user pr-0 mega-category-menu " style="padding-right: 0!important; border: none!important;">
                            <span class="cat-button text-white"><i class="lni lni-user"></i>Hello, <?php echo e(Auth::user()->name); ?></span>
                            <ul class="sub-category" style="top: 30px!important; z-index: 99!important;">
                                <li>
                                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                                <li>
                                    <a href="<?php echo e(route('order.index')); ?>" class="dropdown-item">Order</a>
                                </li>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Topbar -->
    <!-- Start Header Middle -->
    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">
                    <!-- Start Header Logo -->
                    <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                        <div style="display: flex; align-items: center;">
                            <!-- Logo Gambar di Sebelah Kiri -->
                            <img src="<?php echo e(asset('img/1.png')); ?>" alt="Logo" style="max-width: 90px; margin-right: 5px;">

                            <!-- Teks Bay Ecommerce di Sebelah Kanan -->
                            <span style="color: black; font-size: 30px; font-family: 'Arial', sans-serif; font-weight: 700;">BAY</span>
                            <span style="color: blue; font-size: 30px; font-family: 'Arial', sans-serif; font-weight: 700;">Ecommerce</span>
                        </div>
                    </a>
                    <!-- End Header Logo -->
                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <!-- Start Main Menu Search -->
                    <div class="main-menu-search">
                        <!-- navbar search start -->
                        <form action="<?php echo e(route('search')); ?>" method="GET">
                            <div class="navbar-search search-style-5">
                                <div class="search-select">
                                    <div class="select-position">
                                        <form action="<?php echo e(route('search')); ?>" method="GET">
                                            <select id="select1" name="category">
                                                <option value="all" selected>All</option>
                                                <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($kategori->id); ?>"><?php echo e($kategori->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="search-input">
                                    <input type="text" name="query" placeholder="Search">
                                </div>
                                <div class="search-btn">
                                    <button type="submit"><i class="lni lni-search-alt"></i></button>
                                </div>
                            </div>
                        </form>
                        <!-- navbar search Ends -->
                    </div>
                    <!-- End Main Menu Search -->
                </div>
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="middle-right-area">
                        <div class="nav-hotline"></div>
                        <div class="navbar-cart">
                            <div class="wishlist">
                                <a href="javascript:void(0)">
                                    <i class="lni lni-heart"></i>
                                    <span class="total-items">0</span>
                                </a>
                            </div>
                            <div class="cart-items">
                                <?php
                                    $carts = auth()->check() ? auth()->user()->carts : [];
                                    $cartCount = auth()->check() ? auth()->user()->carts->count() : 0;
                                    $totalPrice = 0;
                                    foreach ($carts as $cart) {
                                        $totalPrice += $cart->produk->harga * $cart->quantity; // harga * quantity
                                    }
                                ?>

                                <a href="javascript:void(0)" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    <span class="total-items"><?php echo e($cartCount); ?></span>
                                </a>

                                <!-- Shopping Item -->
                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span><?php echo e($cartCount); ?> Items</span>
                                        <a href="<?php echo e(route('carts.index')); ?>">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        <?php $__currentLoopData = $carts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <form action="<?php echo e(route('carts.remove')); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="cart_id" value="<?php echo e($cart->id); ?>">
                                                <button type="submit" href="javascript:void(0)" class="remove" title="Remove this item">
                                                    <i class="lni lni-close"></i>
                                                </button>
                                            </form>

                                            <div class="cart-img-head">
                                                <a class="cart-img" href="product-details.html">
                                                    <img src="<?php echo e(asset('storage/' . $cart->produk->foto_produk)); ?>" alt="<?php echo e($cart->produk->nama); ?>">
                                                </a>
                                            </div>

                                            <div class="content">
                                                <h4><a href="product-details.html">
                                                <?php echo e($cart->produk->nama); ?></a></h4>
                                                <p class="quantity"><span class="amount">Rp <?php echo e(number_format($cart->produk->harga, 0, ',', '.')); ?></span></p>
                                            </div>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">Rp <?php echo e(number_format($totalPrice, 0, ',', '.')); ?></span>
                                        </div>
                                        <div class="button">
                                            <a href="checkout.html" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Shopping Item -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Middle -->
    <!-- Start Header Bottom -->
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">
                    <!-- Start Mega Category Menu -->
                    <div class="mega-category-menu">
                        <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                        <ul class="sub-category">
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('produk.byKategori', $kategori->id)); ?>">
                                        <?php echo e($kategori->nama); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <!-- End Mega Category Menu -->
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="index.html" class="active" aria-label="Toggle navigation">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                        data-bs-target="#submenu-1-2" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">Pages</a>
                                    <ul class="sub-menu collapse" id="submenu-1-2">
                                        <li class="nav-item"><a href="about-us.html">About Us</a></li>
                                        <li class="nav-item"><a href="faq.html">Faq</a></li>
                                        <li class="nav-item"><a href="login.html">Login</a></li>
                                        <li class="nav-item"><a href="register.html">Register</a></li>
                                        <li class="nav-item"><a href="mail-success.html">Mail Success</a></li>
                                        <li class="nav-item"><a href="404.html">404 Error</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                        data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">Shop</a>
                                    <ul class="sub-menu collapse" id="submenu-1-3">
                                        <li class="nav-item"><a href="product-grids.html">Shop Grid</a></li>
                                        <li class="nav-item"><a href="product-list.html">Shop List</a></li>
                                        <li class="nav-item"><a href="product-details.html">shop Single</a></li>
                                        <li class="nav-item"><a href="cart.html">Cart</a></li>
                                        <li class="nav-item"><a href="checkout.html">Checkout</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse"
                                        data-bs-target="#submenu-1-4" aria-controls="navbarSupportedContent"
                                        aria-expanded="false" aria-label="Toggle navigation">Blog</a>
                                    <ul class="sub-menu collapse" id="submenu-1-4">
                                        <li class="nav-item"><a href="blog-grid-sidebar.html">Blog Grid Sidebar</a>
                                        </li>
                                        <li class="nav-item"><a href="blog-single.html">Blog Single</a></li>
                                        <li class="nav-item"><a href="blog-single-sidebar.html">Blog Single
                                                Sibebar</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.html" aria-label="Toggle navigation">Contact Us</a>
                                </li>
                            </ul>
                        </div> <!-- navbar collapse -->
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">
                <!-- Start Nav Social -->
                <div class="nav-social">
                    <h5 class="title">Follow Us:</h5>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Social -->
            </div>
        </div>
    </div>
    <!-- End Header Bottom -->
</header>

<script>
    document.getElementById('navbarDropdown').addEventListener('click', function () {
        document.getElementById('kategoriDropdown').classList.toggle('hidden');
    });
    document.getElementById('bestSellingDropdown').addEventListener('click', function () {
        document.getElementById('bestSellingDropdownMenu').classList.toggle('hidden');
    });
    document.getElementById('recommendedDropdown').addEventListener('click', function () {
        document.getElementById('recommendedDropdownMenu').classList.toggle('hidden');
    });
    document.getElementById('profileDropdown').addEventListener('click', function () {
        document.getElementById('profileDropdownMenu').classList.toggle('hidden');
    });
</script>
<?php /**PATH C:\Users\ASUS\Documents\MSIB\e_commerce\pw1-bast7-bayu\Tugas7\resources\views/user/navbar.blade.php ENDPATH**/ ?>