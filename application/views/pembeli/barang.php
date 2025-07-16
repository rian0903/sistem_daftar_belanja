<h2>Daftar Barang</h2>
<form method="get">
    <input type="text" name="q" placeholder="Cari nama barang...">
    <select name="kategori">
        <option value="">Semua Kategori</option>
        <?php foreach ($categories as $c): ?>
            <option value="<?= $c->id ?>"><?= $c->name ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Cari</button>
</form>

<?php foreach ($products as $p): ?>
    <div>
        <h3><?= $p->name ?></h3>
        <p>Harga: <?= $p->price ?></p>
        <a href="<?= base_url('index.php/pembeli/tambah_keranjang/' . $p->id) ?>">+ Tambah ke keranjang</a>
    </div>
<?php endforeach; ?>
