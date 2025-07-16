<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" data-theme="theme-default" data-assets-path="<?= base_url('assets/') ?>" data-template="horizontal-menu-template">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Sistem Daftar Belanja</title>

  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
  <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-auth.css') ?>" />
</head>

<body>
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="authentication-inner py-6">

        <div class="card">
          <div class="card-body">
            <div class="app-brand justify-content-center mb-6">
              <a href="<?= base_url() ?>" class="app-brand-link">
                <span class="app-brand-logo demo">
                  <img src="<?= base_url('assets/img/logo.png') ?>" width="32">
                </span>
                <span class="app-brand-text demo text-heading fw-bold">Belanja+ App</span>
              </a>
            </div>

            <h4 class="mb-1">Lupa Password?</h4>
            <p class="mb-4">Masukkan email kamu untuk menerima link reset</p>

            <form method="post" action="">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="you@example.com" required />
              </div>

              <button type="submit" class="btn btn-primary d-grid w-100">Kirim Link Reset</button>
            </form>

            <p class="text-center mt-3">
              <a href="<?= base_url('index.php/auth/login') ?>">Kembali ke Login</a>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>
