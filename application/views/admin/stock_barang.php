<div>
  <h1 class="text-xl font-bold text-gray-800 mb-4">Stok Barang</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <?php foreach ($products as $item): ?>
        <div class="bg-white border rounded-lg shadow hover:shadow-lg transition-all duration-200">
          <img src="<?= base_url('public/image/' . $item->image) ?>" alt="<?= $item->name ?>" class="w-full h-48 object-cover rounded-t-lg">
          <div class="p-4">
            <h3 class="text-lg font-semibold text-gray-800"><?= $item->name ?></h3>
            <p class="text-sm text-gray-500">Stok: <?= $item->quantity ?></p>
            <p class="text-sm text-gray-500">Harga: Rp <?= number_format($item->price, 0, ',', '.') ?></p>
            <a href="<?= base_url('admin/edit_barang/' . $item->id) ?>" class="inline-block mt-2 px-4 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700">Edit</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</div>
