<aside class="w-64 bg-white border-r border-gray-200 p-4 shadow-sm">
  <div class="text-2xl font-bold text-purple-700 mb-6">Pembeli Panel</div>
  <nav class="space-y-2">
    <a href="<?= base_url('pembeli') ?>" class="flex items-center px-3 py-2 rounded-md hover:bg-purple-100 text-gray-700 font-medium">
      <span class="material-icons mr-2">dashboard</span> Dashboard
    </a>
    <a href="<?= base_url('pembeli/keranjang') ?>" class="flex items-center px-3 py-2 rounded-md hover:bg-purple-100 text-gray-700 font-medium">
      <span class="material-icons mr-2">shopping_cart</span> Keranjang
    </a>
    <a href="<?= base_url('pembeli/checkout') ?>" class="flex items-center px-3 py-2 rounded-md hover:bg-purple-100 text-gray-700 font-medium">
      <span class="material-icons mr-2">payment</span> Checkout
    </a>
    <a href="<?= base_url('pembeli/profile') ?>" class="flex items-center px-3 py-2 rounded-md hover:bg-purple-100 text-gray-700 font-medium">
      <span class="material-icons mr-2">person</span> Profile
    </a>
    <a href="<?= base_url('auth/logout') ?>" class="flex items-center px-3 py-2 rounded-md text-red-500 hover:bg-red-100">
      <span class="material-icons mr-2">logout</span> Logout
    </a>
  </nav>
</aside>
