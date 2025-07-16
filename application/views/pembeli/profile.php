<h2>Profil Pembeli</h2>
<p>Halo, <?= $this->session->userdata('user_name') ?></p>
<a href="<?= base_url('index.php/auth/logout') ?>">Logout</a>
