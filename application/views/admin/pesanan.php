<h2 class="text-2xl font-bold text-gray-800 mb-4">Daftar Pesanan (Belum Bayar)</h2>

<div class="overflow-x-auto">
  <table class="min-w-full bg-white border border-gray-200 shadow rounded-lg">
    <thead>
      <tr class="bg-gray-100 text-gray-700 text-left text-sm uppercase tracking-wider">
        <th class="px-6 py-3 border-b">Pembeli</th>
        <th class="px-6 py-3 border-b">Total</th>
        <th class="px-6 py-3 border-b">Status</th>
      </tr>
    </thead>
    <tbody class="text-gray-700">
      <?php foreach ($pesanan as $p): ?>
      <tr class="hover:bg-gray-50 transition duration-150">
        <td class="px-6 py-4 border-b"><?= htmlspecialchars($p->user_name) ?></td>
        <td class="px-6 py-4 border-b">Rp <?= number_format($p->total, 0, ',', '.') ?></td>
        <td class="px-6 py-4 border-b">
          <?php if ($p->status == 'Belum Bayar'): ?>
            <span class="text-red-600 font-semibold"><?= $p->status ?></span>
          <?php else: ?>
            <span class="text-green-600 font-semibold"><?= $p->status ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
