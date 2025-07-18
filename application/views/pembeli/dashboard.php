<div class="bg-white rounded-lg shadow p-6 mb-6">
  <h1 class="text-2xl font-bold text-gray-800 mb-2">Selamat datang, <?= $this->session->userdata('name') ?>!</h1>
  <p class="text-gray-600">Silakan lihat dan beli barang yang tersedia di bawah ini:</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <?php if (!empty($products)): ?>
    <?php foreach ($products as $item): ?>
      <div class="bg-white shadow rounded-lg p-4">
        <img src="<?= base_url('public/image/' . $item->image) ?>" alt="<?= $item->name ?>" class="w-full h-48 object-cover rounded mb-3">
        <h2 class="text-lg font-semibold text-gray-700"><?= $item->name ?></h2>
        <p class="text-gray-600 mb-2">Harga: Rp <?= number_format($item->price) ?></p>
        <a href="<?= site_url('pembeli/tambah_keranjang/' . $item->id) ?>" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah ke Keranjang</a>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-span-3 text-center text-gray-500">
      <p>Tidak ada barang yang tersedia saat ini.</p>
    </div>
  <?php endif; ?>
</div>
