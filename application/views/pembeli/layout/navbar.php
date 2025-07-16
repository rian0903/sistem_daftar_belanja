<nav class="layout-navbar container-fluid navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    
    <ul class="navbar-nav flex-row align-items-center ms-auto">

      <!-- User dropdown -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="#" data-bs-toggle="dropdown">
          <?php
            $user_name = $this->session->userdata('user_name') ?? 'User';
            $initials = strtoupper(substr($user_name, 0, 2));
          ?>
          <div class="avatar bg-primary">
            <span class="avatar-initial fw-bold"><?= $initials ?></span>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="<?= base_url('index.php/' . ($this->session->userdata('role_id') == 1 ? 'admin' : 'pembeli') . '/profile') ?>">
              <i class="ti ti-user me-2"></i>
              <span class="align-middle">Profile</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item text-danger" href="<?= base_url('index.php/auth/logout') ?>">
              <i class="ti ti-logout me-2"></i>
              <span class="align-middle">Logout</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>
  </div>
</nav>
