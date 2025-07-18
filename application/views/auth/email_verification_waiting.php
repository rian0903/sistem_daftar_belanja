<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>" data-template="horizontal-menu-template">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verifikasi Email - Sistem Daftar Belanja</title>

  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/node-waves/node-waves.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-auth.css') ?>" />
</head>

<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6">

        <!-- Card -->
        <div class="card">
          <div class="card-body text-center">

            <!-- Brand -->
            <div class="app-brand justify-content-center mb-4">
              <a href="<?= base_url() ?>" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <img src="<?= base_url('assets/img/logo.png') ?>" width="32">
                </span>
                <span class="app-brand-text demo text-heading fw-bold">Belanja+ App</span>
              </a>
            </div>

            <h4 class="mb-2">Registrasi Berhasil 🎉</h4>
            <p class="mb-4">Kami telah mengirimkan email verifikasi ke alamat email kamu.<br>
              Silakan klik link yang terdapat pada email tersebut untuk mengaktifkan akunmu.</p>

            <a href="<?= base_url('auth/login') ?>" class="btn btn-outline-primary d-grid w-100">
              Kembali ke Halaman Login
            </a>

          </div>
        </div>
        <!-- /Card -->

      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
