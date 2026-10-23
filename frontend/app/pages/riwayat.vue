<template>
  <div class="min-h-screen bg-gray-100 p-6">

    <!-- Header -->
    <div class="bg-gradient-to-r from-[#1E3A8A] to-[#2563EB] rounded-2xl shadow-lg p-6 text-white mb-6">
      <div class="flex justify-between items-center">

        <div>
          <h1 class="text-3xl font-bold">
            📊 Riwayat Penjualan
          </h1>
          <p class="text-blue-100 mt-1">
            Seluruh transaksi Veloura Store
          </p>
        </div>

        <NuxtLink
          to="/kasir"
          class="bg-white text-[#1E3A8A] px-5 py-2 rounded-lg font-semibold hover:bg-gray-100"
        >
          ← Kembali
        </NuxtLink>
      </div>
    </div>

    <!-- Search -->
    <div class="bg-white rounded-xl shadow p-5 mb-6">

      <input
        v-model="search"
        type="text"
        placeholder="🔍 Cari Nomor Nota..."
        class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
      />
    </div>

    <!-- Tabel -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
      <table class="w-full">
        <thead class="bg-gradient-to-r from-[#1E3A8A] to-[#2563EB] text-white">
          <tr>
            <th class="px-5 py-4 text-left">
              No Nota
            </th>
            <th class="px-5 py-4 text-left">
              Tanggal
            </th>
            <th class="px-5 py-4 text-center">
              Metode
            </th>
            <th class="px-5 py-4 text-center">
              Total
            </th>
            <th class="px-5 py-4 text-center">
              Aksi
            </th>
          </tr>
        </thead>

        <tbody>
          <tr
            v-for="t in filteredTransaksi"
            :key="t.id"
            class="border-b hover:bg-blue-50 transition"
          >

            <td class="px-5 py-4 font-semibold">
              {{ t.no_nota }}
            </td>

            <td class="px-5 py-4">
              {{ formatTanggal(t.created_at) }}
            </td>

            <td class="px-5 py-4 text-center">
              <span
                class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm"
              >
                {{ t.metode_pembayaran }}
              </span>
            </td>

            <td class="px-5 py-4 text-center font-bold text-green-600">
              Rp {{ Number(t.total_harga).toLocaleString("id-ID") }}
            </td>

            <td class="px-5 py-4">
              <div class="flex justify-center gap-2">
                <button
                  @click="lihatDetail(t.id)"
                  class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg"
                >
                  👁 Detail
                </button>
              </div>
            </td>
          </tr>

          <tr v-if="filteredTransaksi.length === 0">
            <td
              colspan="5"
              class="text-center py-8 text-gray-500"
            >
              Belum ada transaksi.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
const token = useCookie("token");
const transaksi = ref([]);
const search = ref("");
const filteredTransaksi = computed(() => {

  return transaksi.value.filter((item) =>
    item.no_nota
      .toLowerCase()
      .includes(search.value.toLowerCase())
  );
});

const loadData = async () => {
  transaksi.value = await $fetch(
    "http://localhost/crud-laravel/public/api/transaksi",
    {
      headers: {
        Authorization: `Bearer ${token.value}`,
      },
    }
  );
};

const formatTanggal = (tanggal) => {
  return new Date(tanggal).toLocaleString("id-ID");

};

const lihatDetail = (id) => {
  navigateTo(`/transaksi/${id}`);

};

onMounted(() => {
  loadData();

});
</script>