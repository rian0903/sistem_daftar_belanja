<h2 class="text-2xl font-bold text-gray-800 mb-6">Laporan Transaksi</h2>

<div class="flex justify-between items-center mb-4">
  <div>
    <p class="text-green-700 font-semibold">
      Total Transaksi Sukses: Rp <?= number_format($total_sukses ?? 0, 0, ',', '.') ?>
    </p>
    <p class="text-yellow-700 font-semibold">
      Total Transaksi Pending: Rp <?= number_format($total_pending ?? 0, 0, ',', '.') ?>
    </p>
  </div>
  <div class="space-x-2">
    <a href="<?= base_url('admin/laporan_pdf') ?>" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Download PDF</a>
    <a href="<?= base_url('admin/laporan_excel') ?>" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Download Excel</a>
  </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  <!-- Transaksi Sukses -->
  <div class="bg-white rounded shadow p-4">
    <h3 class="text-xl font-semibold text-green-700 mb-2">Transaksi Sukses</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full border border-green-200 text-sm">
        <thead class="bg-green-100">
          <tr>
            <th class="py-2 px-4 border">Nama Pembeli</th>
            <th class="py-2 px-4 border">Total</th>
            <th class="py-2 px-4 border">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($sukses as $trx): ?>
            <tr class="hover:bg-green-50">
              <td class="py-1 px-4 border"><?= $trx->pembeli ?></td>
              <td class="py-1 px-4 border">Rp <?= number_format($trx->total, 0, ',', '.') ?></td>
              <td class="py-1 px-4 border">
                <?= $trx->created_at ? date('d M Y, H:i', strtotime($trx->created_at)) : '-' ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Transaksi Pending -->
  <div class="bg-white rounded shadow p-4">
    <h3 class="text-xl font-semibold text-yellow-700 mb-2">Transaksi Pending</h3>
    <div class="overflow-x-auto">
      <table class="min-w-full border border-yellow-200 text-sm">
        <thead class="bg-yellow-100">
          <tr>
            <th class="py-2 px-4 border">Nama Pembeli</th>
            <th class="py-2 px-4 border">Total</th>
            <th class="py-2 px-4 border">Tanggal</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($pending as $trx): ?>
            <tr class="hover:bg-yellow-50">
              <td class="py-1 px-4 border"><?= $trx->pembeli ?></td>
              <td class="py-1 px-4 border">Rp <?= number_format($trx->total, 0, ',', '.') ?></td>
              <td class="py-1 px-4 border">
                <?= $trx->created_at ? date('d M Y, H:i', strtotime($trx->created_at)) : '-' ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
