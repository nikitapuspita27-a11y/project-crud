<template>
  <div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header Navbar -->
        <header
  class="bg-gradient-to-r from-[#1E3A8A] to-[#2563EB] text-white rounded-2xl shadow-lg px-6 py-4 mb-6"
>
  <div class="flex justify-between items-center">
    <!-- Logo -->
    <div class="flex items-center gap-3">
      <div
        class="w-12 h-12 rounded-full bg-white text-blue-700 flex items-center justify-center text-2xl shadow"
      >
        🛍️
      </div>

      <div>
        <h1 class="text-2xl font-bold">
          Veloura Store
        </h1>
        <p class="text-sm text-blue-100">
          Fashion Store Management
        </p>
      </div>
    </div>
    <NuxtLink
        to="/barang"
        class="bg-white text-[#1E3A8A] px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition"
      >
        ← Kembali
      </NuxtLink>
     </div>
    </header>

    <!-- Form -->
    <div class="flex justify-center items-center py-10 px-4">

      <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl overflow-hidden">

        <!-- Header -->
        <div class="bg-[#1E3A8A] text-white p-6">
          <h2 class="text-3xl font-bold">
            ✏️ Edit Produk
          </h2>
          <p class="text-blue-100 mt-1">
            Ubah informasi produk yang dipilih.
          </p>
        </div>

        <!-- Body -->
        <form
          @submit.prevent="updateBarang"
          class="p-8 space-y-5"
        >

          <!-- Kode Barang -->
          <div>
            <label class="block font-semibold mb-2 text-gray-700">
              Kode Produk
            </label>

            <div class="relative">
              <span class="absolute left-3 top-3">🏷️</span>

              <input
                v-model="form.kode_barang"
                type="text"
                class="w-full border rounded-lg pl-10 p-3 focus:ring-2 focus:ring-blue-500 outline-none"
              >
            </div>
          </div>

          <!-- Nama Barang -->
          <div>
            <label class="block font-semibold mb-2 text-gray-700">
              Nama Produk
            </label>

            <div class="relative">
              <span class="absolute left-3 top-3">👕</span>

              <input
                v-model="form.nama_barang"
                type="text"
                class="w-full border rounded-lg pl-10 p-3 focus:ring-2 focus:ring-blue-500 outline-none"
              >
            </div>
          </div>

          <!-- Harga -->
          <div>
            <label class="block font-semibold mb-2 text-gray-700">
              Harga
            </label>

            <div class="relative">
              <span class="absolute left-3 top-3">💰</span>

              <input
                v-model="form.harga"
                type="number"
                class="w-full border rounded-lg pl-10 p-3 focus:ring-2 focus:ring-blue-500 outline-none"
              >
            </div>
          </div>

          <!-- Stok -->
          <div>
            <label class="block font-semibold mb-2 text-gray-700">
              Stok
            </label>

            <div class="relative">
              <span class="absolute left-3 top-3">📦</span>

              <input
                v-model="form.stok"
                type="number"
                class="w-full border rounded-lg pl-10 p-3 focus:ring-2 focus:ring-blue-500 outline-none"
              >
            </div>
          </div>

          <!-- Tombol -->
          <div class="flex justify-end gap-4 pt-5">

            <NuxtLink
              to="/barang"
              class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition"
            >
              Batal
            </NuxtLink>

            <button
              type="submit"
              class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold shadow-lg"
            >
              💾 Simpan Perubahan
            </button>

          </div>

        </form>

      </div>

    </div>
  </div>
</template>

<script setup>
const route = useRoute()
const router = useRouter()

const token = useCookie("token")

const form = ref({
  kode_barang: "",
  nama_barang: "",
  harga: "",
  stok: "",
})

const loadData = async () => {
  const data = await $fetch(
    `http://localhost/crud-laravel/public/api/barang/${route.query.id}`,
    {
      headers: {
        Authorization: `Bearer ${token.value}`,
      },
    }
  )

  form.value = data
}

const updateBarang = async () => {
  try {
    await $fetch(
      `http://localhost/crud-laravel/public/api/barang/${route.query.id}`,
      {
        method: "PUT",
        headers: {
          Authorization: `Bearer ${token.value}`,
        },
        body: form.value,
      }
    )

    alert("Produk berhasil diperbarui!")

    router.push("/barang")
  } catch (err) {
    alert("Gagal memperbarui produk.")
  }
}

onMounted(loadData)
</script>