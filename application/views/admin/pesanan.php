<h2>Daftar Pesanan (Belum Bayar)</h2>
<table>
    <tr><th>Pembeli</th><th>Total</th><th>Status</th></tr>
    <?php foreach ($pesanan as $p): ?>
        <tr>
            <td><?= $p->user_name ?></td>
            <td><?= $p->total ?></td>
            <td><?= $p->status ?></td>
        </tr>
    <?php endforeach; ?>
</table>
