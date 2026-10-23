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

    <!-- Menu -->
    <div class="flex items-center gap-3">

  <NuxtLink
  to="/kasir"
  :class="[
    'flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold transition-all duration-300',
    route.path === '/kasir'
      ? 'bg-white text-[#1E3A8A] shadow-lg scale-105'
      : 'bg-white/20 text-white hover:bg-white/30 hover:scale-105'
  ]"
>
  🛍️ Produk

  <span
  v-if="route.path === '/kasir'"
  class="absolute left-4 right-4 -bottom-1 h-1 rounded-full bg-white"
></span>
  </NuxtLink>

  <NuxtLink
  to="/barang"
  :class="[
    'flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold transition-all duration-300',
    route.path === '/barang'
      ? 'bg-white text-[#1E3A8A] shadow-lg scale-105'
      : 'bg-white/20 text-white hover:bg-white/30 hover:scale-105'
  ]"
>
  📦 Kelola Produk

    <span
      v-if="route.path === '/barang'"
      class="absolute left-4 right-4 -bottom-1 h-1 rounded-full bg-amber-400"
    ></span>
  </NuxtLink>

  <NuxtLink
  to="/riwayat"
  :class="[
    'flex items-center gap-2 px-5 py-2.5 rounded-xl font-semibold transition-all duration-300',
    route.path === '/riwayat'
      ? 'bg-white text-[#1E3A8A] shadow-lg scale-105'
      : 'bg-white/20 text-white hover:bg-white/30 hover:scale-105'
  ]"
>
  📋 Riwayat Penjualan
</NuxtLink>

  <!-- Dropdown Admin -->
   <div class="relative">
    <button
      @click="showDropdown = !showDropdown"
      class="flex items-center gap-2 bg-white/20 px-3 py-2 rounded hover:bg-white/30"
    >
      👤 Administrator ▼
    </button>

    <div
      v-if="showDropdown"
      class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-50"
    >
      <NuxtLink
    to="/profil"
    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
  >
    👤 Profil
  </NuxtLink>

  <NuxtLink
    to="/pengaturan"
    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
  >
    ⚙️ Pengaturan
  </NuxtLink>

  <NuxtLink
    :to="`/ubahpassword?from=${route.path}`"
    class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition"
  >
    🔑 Ubah Password
  </NuxtLink>

  <button
    @click="logout"
    class="flex items-center gap-3 w-full px-4 py-3 text-left text-red-600 hover:bg-red-50 transition"
  >
    🚪 Logout
  </button>
    </div>
  </div>
</div>
  </div>
</header>

   <div class="flex justify-between items-center mb-4">
  <div class="relative w-80">
    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
      🔍
    </span>

    <input
      v-model="search"
      type="text"
      placeholder="Cari nama atau kode produk..."
      class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
  </div>

  <span class="text-sm text-gray-500">
    Menampilkan {{ filteredBarang.length }} produk
  </span>
</div>

<table class="w-full text-left border-collapse border">
  
</table>

      <!-- Form Tambah Produk -->
      <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-5 mb-6">

  <!-- Judul -->
  <div class="flex items-center gap-2 mb-4">
    <div class="w-9 h-9 rounded-lg bg-blue-100 flex items-center justify-center">
      ➕
    </div>

    <div>
      <h2 class="text-lg font-bold text-gray-800">
        Tambah Produk
      </h2>
      <p class="text-sm text-gray-500">
        Masukkan informasi produk baru
      </p>
    </div>
  </div>

  <!-- Form -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">

    <!-- Kode -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Kode Barang
      </label>

      <input
        v-model="form.kode_barang"
        type="text"
        placeholder="Contoh: VLR012"
        class="w-full h-11 px-4 rounded-xl border border-gray-300
               focus:outline-none focus:ring-2 focus:ring-blue-500
               focus:border-blue-500 transition"
      />
    </div>

    <!-- Nama -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Nama Barang
      </label>

      <input
        v-model="form.nama_barang"
        type="text"
        placeholder="Contoh: Polo"
        class="w-full h-11 px-4 rounded-xl border border-gray-300
               focus:outline-none focus:ring-2 focus:ring-blue-500
               focus:border-blue-500 transition"
      />
    </div>

    <!-- Harga -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Harga
      </label>

      <div class="relative">
        <span class="absolute left-4 top-1/2 -translate-y-1/2
                     text-gray-500 font-medium">
          Rp
        </span>

        <input
          v-model="form.harga"
          type="number"
          placeholder="0"
          class="w-full h-11 pl-12 pr-4 rounded-xl border border-gray-300
                 focus:outline-none focus:ring-2 focus:ring-blue-500
                 focus:border-blue-500 transition"
        />
      </div>
    </div>

    <!-- Stok -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Stok
      </label>

      <input
        v-model="form.stok"
        type="number"
        placeholder="0"
        min="0"
        class="w-full h-11 px-4 rounded-xl border border-gray-300
               focus:outline-none focus:ring-2 focus:ring-blue-500
               focus:border-blue-500 transition"
      />
    </div>

    <!-- Gambar -->
    <div>
      <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Gambar Produk
      </label>

      <label
        class="h-11 w-full px-4 rounded-xl border border-dashed
               border-gray-400 bg-gray-50 hover:bg-gray-100
               flex items-center gap-2 cursor-pointer transition"
      >
        <span class="text-xl">🖼️</span>

        <span class="text-sm text-gray-500 truncate">
          {{ form.gambar?.name || 'Pilih gambar' }}
        </span>

        <input
          type="file"
          accept="image/jpeg,image/png,image/jpg"
          @change="form.gambar = $event.target.files[0]"
          class="hidden"
        />
      </label>
    </div>

  </div>

  <!-- Tombol -->
  <div class="flex justify-end mt-5">

    <button
      @click="simpanBarang"
      class="h-11 px-7 rounded-xl
             bg-[#D4AF37] hover:bg-[#C19B2C]
             text-white font-bold
             shadow-sm hover:shadow-md
             transition duration-200
             flex items-center justify-center gap-2"
    >
      <span>＋</span>
      Tambah Produk
    </button>
  </div>
</div>

      <!-- ================= DAFTAR PRODUK ================= -->
<div class="mt-8">
  <!-- Card -->
  <div class="bg-white rounded-2xl shadow-xl overflow-hidden border">

    <table class="w-full">

      <!-- Header -->
      <thead class="bg-gradient-to-r from-[#1E3A8A] to-[#2563EB] text-white">

        <tr>
          <th class="px-6 py-4 text-left">Gambar</th>
          <th class="px-6 py-4 text-left">Kode</th>
          <th class="px-6 py-4 text-left">Nama Produk</th>
          <th class="px-6 py-4 text-center">Harga</th>
          <th class="px-6 py-4 text-center">Stok</th>
          <th class="px-6 py-4 text-center">Aksi</th>
        </tr>

      </thead>

      <!-- Body -->
      <tbody>

        <tr
          v-for="b in filteredBarang"
          :key="b.id"
          class="border-b hover:bg-blue-50 transition duration-300"
        >

          <!-- Gambar -->
          <td class="px-6 py-4">
           <img
  v-if="b.gambar"
  :src="getImageUrl(b.gambar)"
  :alt="b.nama_barang"
  @error="handleImageError($event, b.gambar)"
  class="w-16 h-16 rounded-xl object-cover border shadow-sm"
/>

<div
  v-else
  class="w-16 h-16 rounded-xl border shadow-sm flex items-center justify-center bg-gray-100 text-gray-400 text-xs text-center"
>
  Tidak ada gambar
</div>
          </td>

          <!-- Kode -->
          <td class="px-6 py-4">

            <span
              class="bg-gray-100 px-3 py-1 rounded-full text-sm font-semibold"
            >
              {{ b.kode_barang }}
            </span>

          </td>

          <!-- Nama -->
          <td class="px-6 py-4">

            <div class="font-semibold text-gray-800">
              {{ b.nama_barang }}
            </div>

            <div class="text-sm text-gray-500">
              Fashion Collection
            </div>

          </td>

          <!-- Harga -->
          <td class="px-6 py-4 text-center">

            <span class="text-green-600 text-lg font-bold">
              Rp {{ Number(b.harga).toLocaleString("id-ID") }}
            </span>

          </td>

          <!-- Stok -->
          <td class="px-6 py-4 text-center">

            <span
              :class="[
                'px-4 py-1 rounded-full text-xs font-bold',

                b.stok > 20
                  ? 'bg-green-100 text-green-700'

                : b.stok > 5
                  ? 'bg-yellow-100 text-yellow-700'

                : 'bg-red-100 text-red-700'
              ]"
            >
              {{ b.stok }} pcs
            </span>

          </td>

          <!-- Aksi -->
          <td class="px-6 py-4">

            <div class="flex justify-center gap-2">

              <NuxtLink
                :to="`/editbarang?id=${b.id}`"
                class="bg-blue-100 text-blue-700 p-2 rounded-lg hover:bg-blue-200 transition shadow"
              >
                ✏️
              </NuxtLink>

              <button
                @click="hapusBarang(b.id)"
                class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition shadow"
              >
                🗑️
              </button>
            </div>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
    </div>
</template>

<script setup>
import { computed } from "vue";
const token = useCookie("token");
const barangList = ref([]);
const search = ref("");
const editId = ref(null);
const showDropdown = ref(false);
const route = useRoute();

const simpanBarang = async () => {
  try {
    const data = new FormData();

    data.append("kode_barang", form.value.kode_barang);
    data.append("nama_barang", form.value.nama_barang);
    data.append("harga", form.value.harga);
    data.append("stok", form.value.stok);

    // Jika ada gambar baru yang dipilih
    if (form.value.gambar instanceof File) {
      data.append("gambar", form.value.gambar);
    }

    if (editId.value) {
      // Update produk
      data.append("_method", "PUT");

      await $fetch(
        `http://localhost/crud-laravel/public/api/barang/${editId.value}`,
        {
          method: "POST",
          headers: {
            Authorization: `Bearer ${token.value}`,
            Accept: "application/json",
          },
          body: data,
        }
      );

      alert("Produk berhasil diupdate!");
    } else {
      // Tambah produk
      await $fetch(
        "http://localhost/crud-laravel/public/api/barang",
        {
          method: "POST",
          headers: {
            Authorization: `Bearer ${token.value}`,
            Accept: "application/json",
          },
          body: data,
        }
      );

      alert("Produk berhasil ditambahkan!");
    }

    // Reset form
    form.value = {
      kode_barang: "",
      nama_barang: "",
      harga: "",
      stok: "",
      gambar: null
    };

    editId.value = null;

    await loadBarang();

  } catch (error) {
    console.error("ERROR SIMPAN PRODUK:", error);

    alert(
      "Gagal menyimpan produk!\n\n" +
      (
        error?.data?.message ||
        error?.message ||
        "Terjadi kesalahan pada server."
      )
    );
  }
};

const getImageUrl = (gambar) => {
  if (!gambar) {
    return "";
  }

  // Kalau sudah berupa URL lengkap
  if (gambar.startsWith("http://") || gambar.startsWith("https://")) {
    return gambar;
  }

  // Gambar lama dari Nuxt
  if (
    gambar.startsWith("images/") ||
    gambar.startsWith("/images/")
  ) {
    return gambar.startsWith("/")
      ? gambar
      : `/${gambar}`;
  }

  // Gambar baru hasil upload Laravel
  return `http://localhost/crud-laravel/public/images/${gambar}`;
};

const handleImageError = (event, gambar) => {
  const img = event.target;

  // Jangan melakukan fallback berkali-kali
  if (img.dataset.fallback === "true") {
    return;
  }

  img.dataset.fallback = "true";

  // Jika gambar gagal dari Laravel,
  // coba folder images Nuxt
  const namaFile = gambar
    .replace(/^\/+/, "")
    .replace(/^images\//, "");

  img.src = `/images/${namaFile}`;

  // Jika masih gagal, coba images/produk
  img.onerror = () => {
    if (img.dataset.fallback2 === "true") {
      return;
    }

    img.dataset.fallback2 = "true";
    img.src = `/images/produk/${namaFile}`;
  };
};

const form = ref({
  kode_barang: "",
  nama_barang: "",
  harga: "",
  stok: "",
  gambar: null
});

const loadBarang = async () => {
  barangList.value = await $fetch(
    "http://localhost/crud-laravel/public/api/barang",
    {
      headers: { Authorization: `Bearer ${token.value}` },
    },
  );
};

const filteredBarang = computed(() => {
  return barangList.value.filter((barang) => {
    const keyword = search.value.toLowerCase();

    return (
      barang.nama_barang.toLowerCase().includes(keyword) ||
      barang.kode_barang.toLowerCase().includes(keyword)
    );
  });
});

onMounted(() => {
  if (!token.value) navigateTo("/");
  loadBarang();
});

const hapusBarang = async (id) => {
  if (confirm("Yakin ingin menghapus produk ini?")) {
    try {
      const response = await $fetch(
        `http://localhost/crud-laravel/public/api/barang/${id}`,
        {
          method: "DELETE",
          headers: {
            Authorization: `Bearer ${token.value}`,
            Accept: "application/json",
          },
        }
      );

      console.log("HASIL DELETE:", response);

      alert("Produk berhasil dihapus!");

      await loadBarang();
    } catch (error) {
      console.error("ERROR DELETE:", error);

      alert(
        "Gagal menghapus produk!\n\n" +
        (error?.data?.message || error?.message || "Terjadi kesalahan.")
      );
    }
  }
};

const logout = () => {
  token.value = null;
  navigateTo("/");
};
</script>
