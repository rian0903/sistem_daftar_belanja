<div class="max-w-2xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Edit Produk</h2>

    <form action="<?= base_url('admin/update_product') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $product->id ?>">
        <div class="mb-4">
            <label for="product_name" class="block text-gray-700 font-semibold mb-2">Nama Produk</label>
            <input type="text" name="name" id="name" value="<?= $product->name ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold mb-2">Harga</label>
            <input type="number" name="price" id="price" value="<?= $product->price ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-semibold mb-2">Stok</label>
            <input type="number" name="quantity" id="quantity" value="<?= $product->quantity ?>" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        <div class="mb-6">
            <label for="photo" class="block text-gray-700 font-semibold mb-2">Foto Produk</label>
            <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <?php if ($product->image): ?>
                <div class="mt-2">
                    <img src="<?= base_url('public/image/' . $product->image) ?>" alt="Foto Produk" class="w-32 h-32 object-cover rounded">
                </div>
            <?php endif; ?>
        </div>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
            <a href="<?= base_url('admin/hapus_barang/' . $product->id) ?>" onclick="return confirm('Yakin ingin menghapus produk ini?')" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700">Hapus</a>
        </div>
    </form>
</div>