<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>" data-template="horizontal-menu-template">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password - Sistem Daftar Belanja</title>

  <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" />
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

            <h4 class="mb-1">Reset Password 🔐</h4>
            <p class="mb-4">Masukkan password baru kamu</p>

            <?php if ($this->session->flashdata('error')): ?>
              <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
            <?php endif; ?>
            <?php if ($this->session->flashdata('success')): ?>
              <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
            <?php endif; ?>

            <form method="post" action="">
              <div class="mb-3">
                <label for="password" class="form-label">Password Baru</label>
                <input type="password" class="form-control" name="password" placeholder="••••••••" required>
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100">Reset Password</button>
            </form>

            <p class="text-center mt-3">
              <a href="<?= base_url('auth/login') ?>">Kembali ke Login</a>
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
