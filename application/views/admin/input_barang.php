<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
  <h1 class="text-xl font-bold text-gray-800 mb-6">Input Barang Baru</h1>

  <form action="<?= base_url('admin/save_barang') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-4">
      <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Barang</label>
      <input type="text" name="name" id="name" required
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
      <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
      <input type="number" name="price" id="price" required
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
      <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
      <input type="number" name="quantity" id="quantity" required
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-4">
      <label for="expired" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Expired</label>
      <input type="date" name="expired" id="expired"
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <div class="mb-6">
      <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
      <select name="category" id="category" required
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    
    <div class="mb-6">
      <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Barang</label>
      <input type="file" name="image" id="image" accept="image/*" required
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    <button type="submit"
      class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-200">
      Simpan
    </button>
  </form>
</div>
