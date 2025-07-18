<!DOCTYPE html>
<html lang="en" class="light-style layout-wide customizer-hide" data-theme="theme-default"
    data-assets-path="<?= base_url('assets/') ?>" data-template="horizontal-menu-template">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Daftar Belanja</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon/favicon.ico') ?>" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/fontawesome.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/tabler-icons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fonts/flag-icons.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/core.css') ?>"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/rtl/theme-default.css') ?>"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= base_url('assets/css/demo.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/node-waves/node-waves.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/typeahead-js/typeahead.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/libs/@form-validation/form-validation.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/css/pages/page-auth.css') ?>" />

    <script src="<?= base_url('assets/vendor/js/helpers.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/template-customizer.js') ?>"></script>
    <script src="<?= base_url('assets/js/config.js') ?>"></script>
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

                        <h4 class="mb-1">Selamat datang kembali! 👋</h4>
                        <p class="mb-6">Silakan login untuk melanjutkan</p>

                        <?php if ($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>

                        <form id="formAuthentication" class="mb-4" action="<?= base_url('auth/login') ?>" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email" required />
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="********" required />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember-me" />
                                    <label class="form-check-label" for="remember-me">Ingat Saya</label>
                                </div>
                                <a href="<?= base_url('auth/forgotPassword') ?>">Lupa Password?</a>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                            </div>
                        </form>

                        <p class="text-center">
                            <span>Belum punya akun?</span>
                            <a href="<?= base_url('auth/register') ?>">
                                <span>Daftar Sekarang</span>
                            </a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/node-waves/node-waves.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/hammer/hammer.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/libs/typeahead-js/typeahead.js') ?>"></script>
    <script src="<?= base_url('assets/vendor/js/menu.js') ?>"></script>

    <!-- <script src="<?= base_url('assets/vendor/libs/@form-validation/popular.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/@form-validation/bootstrap5.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/libs/@form-validation/auto-focus.js') ?>"></script> -->

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="<?= base_url('assets/js/pages-auth.js') ?>"></script>
</body>

</html>