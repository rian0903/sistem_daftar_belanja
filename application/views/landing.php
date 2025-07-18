<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>" data-template="front-pages">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page - SmartList</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/flag-icons.css') ?>" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/node-waves/node-waves.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/nouislider/nouislider.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/swiper/swiper.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/aos/aos.css') ?>" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/front-page.css') ?>" />

  <!-- Custom CSS -->
  <link rel="stylesheet" href="<?= base_url('assets/css/landing-custom.css') ?>" />
</head>

<body>
  <!-- Navbar -->
  <header class="layout-navbar container-fluid navbar navbar-expand-lg align-items-lg-center bg-navbar-theme">
    <div class="container">
      <a class="navbar-brand fw-bold me-4" href="#">
        SmartList
      </a>

      <div class="d-flex align-items-center ms-auto">
        <a href="<?= base_url('auth/login') ?>" class="btn btn-primary me-2">Login</a>
        <a href="<?= base_url('auth/register') ?>" class="btn btn-outline-secondary">Daftar</a>
      </div>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="py-5 bg-light">
    <div class="container text-center">
      <h1 class="display-4 fw-bold mb-3">Selamat Datang di SmartList</h1>
      <p class="lead mb-4">Kelola belanjaanmu dengan lebih rapi, efisien, dan profesional bersama kami!</p>
      <a href="<?= base_url('auth/login') ?>" class="btn btn-primary btn-lg">Mulai Sekarang</a>
    </div>
  </section>

  <!-- Features -->
  <section class="py-5">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <i class="ti ti-box fs-1 mb-3 text-primary"></i>
          <h5>Kelola Stock Barang</h5>
          <p>Admin dapat mengelola data barang, stok, dan harga dengan mudah.</p>
        </div>
        <div class="col-md-4 mb-4">
          <i class="ti ti-shopping-cart fs-1 mb-3 text-success"></i>
          <h5>Transaksi & Pesanan</h5>
          <p>Pembeli bisa langsung checkout barang dan melihat status pembayaran.</p>
        </div>
        <div class="col-md-4 mb-4">
          <i class="ti ti-chart-pie fs-1 mb-3 text-warning"></i>
          <h5>Laporan Otomatis</h5>
          <p>Admin dapat mengekspor laporan penjualan dalam format PDF.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-4 bg-dark text-white text-center">
    <div class="container">
      <p class="mb-0">&copy; <?= date('Y') ?> SmartList. All rights reserved.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/node-waves/node-waves.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/swiper/swiper.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/js/front-page.js') ?>"></script>
</body>

</html>