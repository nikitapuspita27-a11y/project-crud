<template>
  <div class="min-h-screen bg-gray-100 flex items-center justify-center p-6">

    <div class="bg-white shadow-xl rounded-2xl w-full max-w-md">

      <!-- Header -->
      <div class="bg-[#1E3A8A] rounded-t-2xl p-6 text-white text-center">
        <div class="text-5xl mb-2">🔒</div>
        <h1 class="text-2xl font-bold">Ubah Password</h1>
        <p class="text-blue-100 text-sm">
          Silakan masukkan password baru Anda.
        </p>
      </div>

      <!-- Form -->
      <div class="p-6 space-y-5">

        <!-- Password Lama -->
        <div>
          <label class="block font-semibold mb-2">
            Password Lama
          </label>

          <input
            v-model="form.password_lama"
            type="password"
            placeholder="Masukkan password lama"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

        <!-- Password Baru -->
        <div>
          <label class="block font-semibold mb-2">
            Password Baru
          </label>

          <input
            v-model="form.password_baru"
            type="password"
            placeholder="Masukkan password baru"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

        <!-- Konfirmasi Password -->
        <div>
          <label class="block font-semibold mb-2">
            Konfirmasi Password Baru
          </label>

          <input
            v-model="form.konfirmasi_password"
            type="password"
            placeholder="Ulangi password baru"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
          />
        </div>

        <!-- Tombol -->
        <div class="flex gap-3">

          <button
            @click="simpanPassword"
            class="flex-1 bg-[#1E3A8A] text-white py-3 rounded-lg hover:bg-blue-900 transition font-semibold"
          >
            💾 Simpan
          </button>

          <button
            @click="kembali"
            class="flex-1 bg-gray-500 text-white py-3 rounded-lg hover:bg-gray-600 transition font-semibold"
          >
            ← Kembali
          </button>

        </div>

      </div>

    </div>

  </div>
</template>

<script setup>
const route = useRoute();

const form = ref({
  password_lama: "",
  password_baru: "",
  konfirmasi_password: "",
});

const kembali = () => {
  navigateTo(route.query.from || "/kasir");
};

const simpanPassword = () => {

  if (
    !form.value.password_lama ||
    !form.value.password_baru ||
    !form.value.konfirmasi_password
  ) {
    alert("Semua kolom harus diisi!");
    return;
  }

  if (form.value.password_baru.length < 6) {
    alert("Password baru minimal 6 karakter.");
    return;
  }

  if (
    form.value.password_baru !==
    form.value.konfirmasi_password
  ) {
    alert("Konfirmasi password tidak sama.");
    return;
  }

  // TODO: Tambahkan API Laravel untuk mengubah password

  alert("Password berhasil diubah!");

  kembali();
};
</script>