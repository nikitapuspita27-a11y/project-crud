<template>
  <div class="min-h-screen bg-gray-100 flex justify-center items-center p-6">

    <div
  id="struk"
  class="bg-white w-full max-w-xl rounded-2xl shadow-2xl overflow-hidden"
>

  <!-- Header -->
  <div class="bg-gradient-to-r from-[#1E3A8A] to-[#2563EB] text-white p-6 text-center">
    <h1 class="text-3xl font-bold">🛍️ Veloura Store</h1>
    <p class="text-blue-100">
      Fashion Store Management
    </p>
  </div>

  <!-- Isi -->
  <div class="p-6">

        <div class="border-b pb-4 mb-4">
          <div class="flex justify-between">
            <span class="font-semibold">No Nota</span>
            <span>{{ transaksi.no_nota }}</span>
          </div>

          <div class="flex justify-between">
            <span class="font-semibold">Tanggal</span>
            <span>{{ transaksi.tanggal }}</span>
          </div>

          <div class="flex justify-between">
            <span class="font-semibold">Metode</span>
            <span>{{ transaksi.metode }}</span>
          </div>
        </div>

        <!-- Produk -->
        <h2 class="font-bold text-lg mb-3">
          Daftar Produk
        </h2>

        <table class="w-full text-sm">
          <thead class="border-b">
            <tr>
              <th class="text-left py-2">Produk</th>
              <th class="text-center">Qty</th>
              <th class="text-right">Subtotal</th>
            </tr>
          </thead>

          <tbody>
            <tr
              v-for="item in transaksi.items"
              :key="item.id"
              class="border-b"
            >
              <td class="py-2">
                {{ item.nama_barang }}
              </td>

              <td class="text-center">
                {{ item.qty }}
              </td>

              <td class="text-right">
                Rp {{ Number(item.subtotal).toLocaleString("id-ID") }}
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Total -->
        <div class="mt-6 border-t pt-4 space-y-2">

          <div class="flex justify-between">
            <span>Total</span>
            <span class="font-bold">
              Rp {{ Number(transaksi.total).toLocaleString("id-ID") }}
            </span>
          </div>

          <div class="flex justify-between">
            <span>Bayar</span>
            <span>
              Rp {{ Number(transaksi.bayar).toLocaleString("id-ID") }}
            </span>
          </div>

          <div class="flex justify-between">
            <span>Kembalian</span>
            <span class="text-green-600 font-bold">
              Rp {{ Number(transaksi.kembali).toLocaleString("id-ID") }}
            </span>
          </div>

        </div>

        <div class="text-center mt-8 text-gray-500">
          <p>Terima kasih telah berbelanja</p>
          <p>di Veloura Store ❤️</p>
        </div>
      </div>

     <!-- Tombol -->
<div class="bg-gray-50 p-5 flex justify-between no-print">

  <NuxtLink
    to="/riwayat"
    class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg"
  >
    ← Kembali
  </NuxtLink>

  <button
    @click="printStruk"
    class="bg-green-600 hover:bg-green-700 text-black px-5 py-2 rounded-lg"
  >
    🖨 Cetak Struk
  </button>
</div>
    </div>
  </div>
</template>

<script setup>
const route = useRoute()

const transaksi = ref({
  no_nota: "",
  tanggal: "",
  metode: "",
  total: 0,
  bayar: 0,
  kembali: 0,
  items: []
})

const token = useCookie("token")

const loadTransaksi = async () => {
  const data = await $fetch(
    `http://localhost/crud-laravel/public/api/transaksi/${route.params.id}`,
    {
      headers: {
        Authorization: `Bearer ${token.value}`
      }
    }
  )

  transaksi.value = data
}

const printStruk = () => {
  window.print()
}

onMounted(loadTransaksi)
</script>

<style scoped>
@media print {

  body {
    margin: 0;
    padding: 0;
    background: white;
  }

  .no-print {
    display: none !important;
  }

  #struk {
    width: 100%;
    max-width: 100%;
    box-shadow: none !important;
    border-radius: 0 !important;
    margin: 0 auto;
  }

}
</style>