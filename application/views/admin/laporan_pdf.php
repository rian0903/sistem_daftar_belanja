<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        table {
            width: 100%; border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000; padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Laporan Transaksi</h2>
    <p>Total Sukses: Rp <?= number_format($total_sukses, 0, ',', '.') ?></p>
    <p>Total Pending: Rp <?= number_format($total_pending, 0, ',', '.') ?></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pembeli</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($laporan as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->pembeli ?></td>
                <td>Rp <?= number_format($row->total, 0, ',', '.') ?></td>
                <td><?= ucfirst($row->status) ?></td>
                <td><?= $row->created_at ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
