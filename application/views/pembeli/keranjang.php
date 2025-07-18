<div class="bg-white p-6 rounded-lg shadow-md mb-6">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">🛒 Keranjang Belanja</h2>

  <?php if (!empty($keranjang)): ?>
    <div class="space-y-4">
      <?php foreach ($keranjang as $k): ?>
        <div class="flex items-center justify-between bg-gray-100 p-4 rounded-md">
          <div>
            <p class="text-lg font-semibold text-gray-700"><?= $k->name ?></p>
            <div class="flex items-center space-x-2">
              <form action="<?= base_url('pembeli/keranjang_kurang/' . $k->id) ?>" method="post">
                <button type="submit" class="bg-red-500 text-white px-2 rounded hover:bg-red-600">-</button>
              </form>
              <span class="text-sm text-gray-700"><?= $k->quantity ?></span>
              <form action="<?= base_url('pembeli/keranjang_tambah/' . $k->id) ?>" method="post">
                <button type="submit" class="bg-green-500 text-white px-2 rounded hover:bg-green-600">+</button>
              </form>
            </div>
          </div>
          <p class="text-lg font-semibold text-green-600">Rp<?= number_format($k->price * $k->quantity, 0, ',', '.') ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="mt-6 text-right">
      <a href="<?= base_url('pembeli/checkout') ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-all">
        Checkout Sekarang
      </a>
    </div>
  <?php else: ?>
    <p class="text-gray-500">Keranjang kamu masih kosong. Yuk belanja dulu!</p>
  <?php endif; ?>
</div>
