<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <div class="max-w-xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">

      <!-- Header -->
      <div class="bg-[#1E3A8A] text-white p-6 text-center">
        <div
          class="w-24 h-24 mx-auto rounded-full bg-white text-[#1E3A8A] flex items-center justify-center text-5xl font-bold mb-3"
        >
          👤
        </div>

        <h1 class="text-2xl font-bold">Admin Veloura Store</h1>
        <p class="text-blue-100">Administrator</p>
      </div>

      <!-- Informasi -->
      <div class="p-6 space-y-4">

        <div class="border-b pb-3">
          <p class="text-sm text-gray-500">Nama</p>
          <p class="font-semibold">Admin Veloura</p>
        </div>

        <div class="border-b pb-3">
          <p class="text-sm text-gray-500">Username</p>
          <p class="font-semibold">admin</p>
        </div>

        <div class="border-b pb-3">
          <p class="text-sm text-gray-500">Role</p>
          <span
            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold"
          >
            Administrator
          </span>
        </div>

        <div class="border-b pb-3">
          <p class="text-sm text-gray-500">Status</p>
          <span
            class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold"
          >
            Aktif
          </span>
        </div>

      </div>

      <!-- Tombol -->
      <div class="bg-gray-50 p-6 flex justify-end gap-3">
        <NuxtLink
          to="/barang"
          class="bg-[#1E3A8A] text-white px-5 py-2 rounded-lg hover:bg-blue-800"
        >
          ← Kembali
        </NuxtLink>
      </div>

      <button
  @click="kembali"
  class="bg-blue-600 text-white px-4 py-2 rounded"
>
  ← Kembali
</button>

    </div>
  </div>
</template>

<script setup>
const route = useRoute();

definePageMeta({
  middleware: "auth",
});

const kembali = () => {
  navigateTo(route.query.from || "/kasir");
};
</script>