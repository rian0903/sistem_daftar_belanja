<div class="bg-white rounded-lg shadow p-6 mb-6">
  <h1 class="text-2xl font-bold text-gray-800 mb-2">Selamat datang, Admin!</h1>
  <p class="text-gray-600">Berikut adalah daftar barang yang tersedia:</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
  <?php foreach ($products as $item): ?>
    <div class="bg-white shadow rounded-lg p-4 relative">
      <img src="<?= base_url('public/image/' . $item->image) ?>" alt="<?= $item->name ?>" class="w-full h-48 object-cover rounded mb-3">
      <h2 class="text-lg font-semibold text-gray-700"><?= $item->name ?></h2>
      <p class="text-gray-600">Harga: Rp <?= number_format($item->price) ?></p>

      <!-- QR Code di pojok kanan bawah -->
      <img src="<?= base_url('public/assets/qrcode/qrcode_' . $item->id . '.png') ?>" 
           alt="QR Code" 
           style="position: absolute; bottom: 10px; right: 10px; width: 60px; height: 60px; border: 2px solid #000; padding: 3px; background: #fff; border-radius: 6px;">
    </div>
  <?php endforeach; ?>
</div>

