<template>
  <div class="min-h-screen bg-gray-100 p-6">

    <!-- Header -->
    <div class="bg-[#1E3A8A] text-white rounded-xl shadow p-5 mb-6">
      <h1 class="text-2xl font-bold">⚙️ Pengaturan Veloura Store</h1>
      <p class="text-blue-100 mt-1">
        Kelola informasi toko dan pengaturan aplikasi.
      </p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">

      <!-- Informasi Toko -->
      <h2 class="text-xl font-bold text-gray-700 mb-5">
        🏪 Informasi Toko
      </h2>

      <div class="grid md:grid-cols-2 gap-5">

        <div>
          <label class="block mb-2 font-semibold text-gray-600">
            Nama Toko
          </label>

          <input
            v-model="form.nama_toko"
            type="text"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

        <div>
          <label class="block mb-2 font-semibold text-gray-600">
            Pemilik
          </label>

          <input
            v-model="form.pemilik"
            type="text"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

        <div>
          <label class="block mb-2 font-semibold text-gray-600">
            Nomor Telepon
          </label>

          <input
            v-model="form.telepon"
            type="text"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

        <div>
          <label class="block mb-2 font-semibold text-gray-600">
            Email
          </label>

          <input
            v-model="form.email"
            type="email"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

      </div>

      <div class="mt-5">
        <label class="block mb-2 font-semibold text-gray-600">
          Alamat
        </label>

        <textarea
          v-model="form.alamat"
          rows="3"
          class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
        ></textarea>
      </div>

      <!-- Tema -->
      <hr class="my-8">

      <h2 class="text-xl font-bold text-gray-700 mb-4">
        🎨 Tampilan
      </h2>

      <div class="space-y-3">

        <label class="flex items-center gap-3">
          <input
            type="radio"
            value="Light"
            v-model="form.tema"
          >
          Light Mode
        </label>

        <label class="flex items-center gap-3">
          <input
            type="radio"
            value="Dark"
            v-model="form.tema"
          >
          Dark Mode
        </label>

      </div>

      <!-- Bahasa -->
      <hr class="my-8">

      <h2 class="text-xl font-bold text-gray-700 mb-4">
        🌐 Bahasa
      </h2>

      <select
        v-model="form.bahasa"
        class="border rounded-lg p-3 w-64"
      >
        <option>Indonesia</option>
        <option>English</option>
      </select>

      <!-- Mata Uang -->
      <hr class="my-8">

      <h2 class="text-xl font-bold text-gray-700 mb-4">
        💰 Mata Uang
      </h2>

      <select
        v-model="form.matauang"
        class="border rounded-lg p-3 w-64"
      >
        <option>Rupiah (IDR)</option>
        <option>Dollar (USD)</option>
      </select>

      <!-- Tombol -->
      <div class="mt-10 flex gap-4">

        <button
          @click="simpan"
          class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold"
        >
          💾 Simpan Pengaturan
        </button>

        <NuxtLink
          to="/barang"
          class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg"
        >
          ← Kembali
        </NuxtLink>

      </div>

    </div>

  </div>
</template>

<script setup>
const route = useRoute();

const form = ref({
  nama_toko: "Veloura Store",
  pemilik: "Admin",
  telepon: "081234567890",
  email: "velourastore@gmail.com",
  alamat: "Jakarta Timur",
  tema: "Light",
  bahasa: "Indonesia",
  matauang: "Rupiah (IDR)"
})

const simpan = () => {
  alert("Pengaturan berhasil disimpan!")
}

const kembali = () => {
  navigateTo(route.query.from || "/kasir");
};
</script>