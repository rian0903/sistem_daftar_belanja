<h2>Input Barang Baru</h2>
<form method="post" action="<?= base_url('index.php/admin/save_barang') ?>">
    <input type="text" name="name" placeholder="Nama Barang"><br>
    <select name="category">
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat->id ?>"><?= $cat->name ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="number" name="quantity" placeholder="Jumlah"><br>
    <input type="number" step="0.01" name="price" placeholder="Harga"><br>
    <input type="date" name="expired"><br>
    <button type="submit">Simpan</button>
</form>
