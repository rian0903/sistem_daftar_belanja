<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" data-theme="theme-default"
  data-assets-path="<?= base_url('assets/') ?>" data-template="horizontal-menu-template">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - Sistem Daftar Belanja</title>

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

            <h4 class="mb-1">Daftar Akun Baru 🚀</h4>
            <p class="mb-4">Isi formulir di bawah untuk membuat akun pembeli</p>

            <form action="<?= base_url('auth/register') ?>" method="post">
              <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama lengkap"
                  required />
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                  placeholder="Alamat email" required />
              </div>

              <div class="mb-3 form-password-toggle">
                <label for="password" class="form-label">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" name="password" class="form-control"
                    placeholder="********" required />
                  <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                </div>
              </div>

              <div class="mb-3">
                <button class="btn btn-primary d-grid w-100" type="submit">Daftar</button>
              </div>
            </form>

            <p class="text-center">
              Sudah punya akun? <a href="<?= base_url('auth/login') ?>">Login di sini</a>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>