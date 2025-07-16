<aside id="layout-menu" class="layout-menu menu-vertical bg-menu-theme">
  <div class="app-brand px-3">
    <a href="<?= base_url('index.php/admin') ?>" class="app-brand-link">
      <span class="app-brand-logo"><img src="<?= base_url('assets/img/logo.png') ?>" width="30"></span>
      <span class="app-brand-text fw-bold">Admin Panel</span>
    </a>
  </div>
  <ul class="menu-inner py-1">
    <li class="menu-item"><a href="<?= base_url('index.php/admin') ?>" class="menu-link"><i class="menu-icon ti ti-home"></i> Dashboard</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/admin/stock_barang') ?>" class="menu-link"><i class="menu-icon ti ti-box"></i> Stock Barang</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/admin/input_barang') ?>" class="menu-link"><i class="menu-icon ti ti-plus"></i> Input Barang</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/admin/pesanan') ?>" class="menu-link"><i class="menu-icon ti ti-shopping-cart"></i> Pesanan</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/admin/laporan') ?>" class="menu-link"><i class="menu-icon ti ti-file-invoice"></i> Laporan</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/admin/profile') ?>" class="menu-link"><i class="menu-icon ti ti-user"></i> Profile</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/auth/logout') ?>" class="menu-link text-danger"><i class="menu-icon ti ti-logout"></i> Logout</a></li>
  </ul>
</aside>
