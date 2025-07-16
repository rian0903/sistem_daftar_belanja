<h2>Stock Barang</h2>
<table>
    <tr>
        <th>Nama</th><th>Kategori</th><th>Jumlah</th><th>Harga</th><th>QR</th><th>Aksi</th>
    </tr>
    <?php foreach ($products as $p): ?>
    <tr>
        <td><?= $p->name ?></td>
        <td><?= $p->category_name ?></td>
        <td><?= $p->quantity ?></td>
        <td><?= $p->price ?></td>
        <td><img src="<?= base_url('uploads/qr/' . $p->qr_code) ?>" width="50"></td>
        <td><a href="#">Edit</a></td>
    </tr>
    <?php endforeach; ?>
</table>
