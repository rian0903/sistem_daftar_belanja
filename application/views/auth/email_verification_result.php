<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4" style="max-width: 500px; width: 100%;">
            <div class="card-body text-center">
                <?php if (isset($status) && $status == 'already'): ?>
                    <h4 class="card-title text-success mb-3">Email Sudah Diverifikasi</h4>
                    <p class="card-text">Akun Anda sudah diverifikasi sebelumnya. Silakan login untuk melanjutkan.</p>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-primary">Login Sekarang</a>
                <?php elseif (isset($status) && $status == 'invalid'): ?>
                    <h4 class="card-title text-danger mb-3">Token Tidak Valid</h4>
                    <p class="card-text">Link verifikasi tidak valid atau sudah digunakan. Silakan daftar ulang.</p>
                    <a href="<?= base_url('auth/register') ?>" class="btn btn-warning">Daftar Ulang</a>
                <?php else: ?>
                    <h4 class="card-title text-info mb-3">Verifikasi Email</h4>
                    <p class="card-text">Status verifikasi tidak diketahui. Silakan coba lagi nanti.</p>
                    <a href="<?= base_url('auth/register') ?>" class="btn btn-secondary">Kembali</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
