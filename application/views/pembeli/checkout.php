<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-lg">
  <h2 class="text-2xl font-bold mb-4 text-gray-800">💳 Checkout Pembayaran</h2>

  <form method="post" class="space-y-4">
    <div>
      <label for="nominal_display" class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
      <input type="text" id="nominal_display" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
        placeholder="Rp. 10.000">
      
      <!-- Hidden field buat ngirim angka bersih ke backend -->
      <input type="hidden" name="nominal" id="nominal">
    </div>

    <button type="submit"
      class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition-all">
      Bayar Sekarang
    </button>
  </form>
</div>

<script>
  const inputDisplay = document.getElementById('nominal_display');
  const inputHidden = document.getElementById('nominal');

  inputDisplay.addEventListener('input', function(e) {
    let angka = this.value.replace(/[^\d]/g, '');
    inputHidden.value = angka; // nilai asli ke input hidden
    this.value = formatRupiah(angka, 'Rp. ');
  });

  function formatRupiah(angka, prefix) {
    let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   	 = number_string.split(','),
        sisa     	 = split[0].length % 3,
        rupiah     	 = split[0].substr(0, sisa),
        ribuan     	 = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix + rupiah;
  }
</script>
