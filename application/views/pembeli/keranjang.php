<h2>Keranjang Belanja</h2>
<?php foreach ($keranjang as $k): ?>
    <div>
        <p><?= $k->name ?> x<?= $k->quantity ?> - Rp<?= $k->price * $k->quantity ?></p>
    </div>
<?php endforeach; ?>
<a href="<?= base_url('index.php/pembeli/checkout') ?>">Checkout Sekarang</a>
