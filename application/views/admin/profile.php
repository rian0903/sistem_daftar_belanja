<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-lg p-6 mt-6">
  <h2 class="text-2xl font-bold text-gray-800 mb-4">Profil Admin</h2>

  <!-- Info Profil -->
  <div class="mb-6">
    <p class="text-gray-700 mb-2"><strong>Nama:</strong> <?= $user->name ?></p>
    <p class="text-gray-700 mb-2"><strong>Email:</strong> <?= $user->email ?></p>
  </div>

  <!-- Tombol Aksi -->
  <div class="flex gap-4">
    <button onclick="toggleEdit()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
      Edit Profil
    </button>
    <button onclick="toggleReset()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
      Reset Password
    </button>
    <a href="<?= base_url('index.php/auth/logout') ?>" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded shadow">
      Logout
    </a>
  </div>

  <!-- Form Edit Profil -->
  <form action="<?= base_url('admin/update_profile') ?>" method="post" class="mt-6 hidden" id="editForm">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Edit Profil</h3>
    <div class="mb-4">
      <label class="block text-gray-600">Nama</label>
      <input type="text" name="name" value="<?= $user->name ?>" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-600">Email</label>
      <input type="email" name="email" value="<?= $user->email ?>" class="w-full border rounded px-3 py-2" required>
    </div>
    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
      Simpan Perubahan
    </button>
  </form>

  <!-- Form Reset Password -->
  <form action="<?= base_url('admin/reset_password') ?>" method="post" class="mt-6 hidden" id="resetForm">
    <h3 class="text-lg font-semibold text-gray-700 mb-2">Reset Password</h3>
    <div class="mb-4">
      <label class="block text-gray-600">Password Baru</label>
      <input type="password" name="new_password" class="w-full border rounded px-3 py-2" required>
    </div>
    <div class="mb-4">
      <label class="block text-gray-600">Konfirmasi Password</label>
      <input type="password" name="confirm_password" class="w-full border rounded px-3 py-2" required>
    </div>
    <button type="submit" class="bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded">
      Simpan Password Baru
    </button>
  </form>
</div>

<script>
  function toggleEdit() {
    document.getElementById("editForm").classList.toggle("hidden");
    document.getElementById("resetForm").classList.add("hidden");
  }

  function toggleReset() {
    document.getElementById("resetForm").classList.toggle("hidden");
    document.getElementById("editForm").classList.add("hidden");
  }
</script>
