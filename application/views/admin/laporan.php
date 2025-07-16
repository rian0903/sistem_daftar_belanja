<h2>Laporan Transaksi</h2>
<table>
    <tr><th>Pembeli</th><th>Total</th><th>Status</th><th>Tanggal</th></tr>
    <?php foreach ($laporan as $l): ?>
        <tr>
            <td><?= $l->user_name ?></td>
            <td><?= $l->total ?></td>
            <td><?= $l->status ?></td>
            <td><?= $l->created_at ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p><strong>Total Penjualan: </strong> Rp <?= number_format($total, 0, ',', '.') ?></p>
