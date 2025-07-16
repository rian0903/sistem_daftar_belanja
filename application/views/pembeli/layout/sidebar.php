<aside id="layout-menu" class="layout-menu menu-vertical bg-menu-theme">
  <div class="app-brand px-3">
    <a href="<?= base_url('index.php/pembeli') ?>" class="app-brand-link">
      <span class="app-brand-logo"><img src="<?= base_url('assets/img/logo.png') ?>" width="30"></span>
      <span class="app-brand-text fw-bold">Pembeli</span>
    </a>
  </div>
  <ul class="menu-inner py-1">
    <li class="menu-item"><a href="<?= base_url('index.php/pembeli') ?>" class="menu-link"><i class="menu-icon ti ti-home"></i> Dashboard</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/pembeli/barang') ?>" class="menu-link"><i class="menu-icon ti ti-box"></i> Barang</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/pembeli/keranjang') ?>" class="menu-link"><i class="menu-icon ti ti-shopping-cart"></i> Keranjang</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/pembeli/checkout') ?>" class="menu-link"><i class="menu-icon ti ti-cash"></i> Checkout</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/pembeli/profile') ?>" class="menu-link"><i class="menu-icon ti ti-user"></i> Profile</a></li>
    <li class="menu-item"><a href="<?= base_url('index.php/auth/logout') ?>" class="menu-link text-danger"><i class="menu-icon ti ti-logout"></i> Logout</a></li>
  </ul>
</aside>
