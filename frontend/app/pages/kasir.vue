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
  class="absolute left-4 right-4 -bottom-1 h-1 rounded-full bg-amber-400"
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

    <div class="grid grid-cols-3 gap-6 items-start">
      <!-- Daftar Barang -->
      <div class="col-span-2 bg-white p-6 rounded shadow">
      <div class="flex items-center justify-between border-b pb-2 mb-4">
         <h2 class="text-xl font-bold"> Pilih Produk </h2>

  <span
    class="px-3 py-1 text-sm font-semibold bg-blue-100 text-blue-700 rounded-full"
  >
    {{ filteredBarang.length }} Produk
  </span>
</div>
        <div class="grid grid-cols-3 gap-4">
  <div
    v-for="b in filteredBarang"
    :key="b.id"
    @click="tambahKeKeranjang(b)"
    :class="[
      'border rounded-xl p-4 shadow-sm transition-all duration-300',
      b.stok > 0
        ? 'cursor-pointer hover:shadow-lg hover:-translate-y-1 hover:border-blue-500 bg-white'
        : 'opacity-60 cursor-not-allowed bg-gray-100'
    ]"
  >
    <!-- Foto Produk -->
<img
  :src="`/${b.gambar}`"
  :alt="b.nama_barang"
  class="w-full h-40 object-cover rounded-lg mb-3"
/>

<!-- Nama Produk -->
<h3 class="font-bold text-gray-800 text-lg">
  {{ b.nama_barang }}
</h3>

<!-- Harga -->
<p class="text-blue-600 font-semibold mt-2">
  Rp {{ b.harga.toLocaleString("id-ID") }}
</p>

<!-- Badge Stok -->
<div class="mt-3">
  <span
    :class="[
      'inline-block px-3 py-1 rounded-full text-xs font-bold',
      b.stok > 10
        ? 'bg-green-100 text-green-700'
        : b.stok > 0
        ? 'bg-yellow-100 text-yellow-700'
        : 'bg-red-100 text-red-700'
    ]"
  >
    {{ b.stok > 0 ? `Stok ${b.stok}` : "Stok Habis" }}
  </span>
</div>
  </div>
  </div>
  </div>

      <!-- Keranjang Belanja -->
      <div class="bg-white p-6 rounded shadow flex flex-col h-fit">
        <div>
          <h2 class="text-xl font-bold mb-4 border-b pb-2">
            Keranjang Belanja
          </h2>

          <div
  v-if="keranjang.length === 0"
  class="flex items-center justify-center min-h-[420px]"
>
  <div
    class="w-full max-w-sm
           bg-gray-50
           border-2 border-dashed border-gray-300
           rounded-2xl
           p-8
           text-center
           shadow-sm"
  >

    <div
      class="w-16 h-16
             mx-auto mb-4
             flex items-center justify-center
             rounded-full
             bg-blue-100
             text-3xl"
    >
      📦
    </div>

    <h3 class="text-xl font-bold text-gray-700">
      Belum ada produk
    </h3>

    <p class="text-sm text-gray-500 mt-2">
      Silakan pilih produk yang ingin dibeli
    </p>

    <div class="mt-5">
      <span
        class="inline-flex items-center gap-2
               bg-blue-50
               text-blue-700
               px-4 py-2
               rounded-full
               text-sm
               font-medium"
      >
        🛒 Keranjang masih kosong
      </span>
    </div>
  </div>
</div>

          <div
  v-for="item in keranjang"
  :key="item.id"
  class="mb-4 border-b pb-4"
>
  <!-- Nama & harga satuan -->
  <div class="mb-3">
    <div class="font-bold text-sm text-gray-800">
      {{ item.nama_barang }}
    </div>

    <div class="text-xs text-gray-500 mt-1">
      Rp {{ item.harga.toLocaleString("id-ID") }} / pcs
    </div>
  </div>

  <!-- Quantity + Total Harga -->
  <div class="flex items-center justify-between">

    <!-- Quantity -->
    <div class="flex items-center gap-2">

      <button
        @click="kurangiQty(item)"
        class="w-8 h-8 rounded-lg
               bg-slate-100
               hover:bg-slate-200
               text-slate-700
               font-bold
               transition"
      >
        −
      </button>

      <input
        v-model.number="item.qty"
        type="number"
        min="1"
        :max="getStok(item.id)"
        @focus="$event.target.select()"
        @change="ubahQty(item)"
        class="w-16 h-9
               text-center
               rounded-lg
               border border-slate-200
               bg-white
               font-semibold
               text-slate-700
               focus:outline-none
               focus:border-blue-500
               focus:ring-2
               focus:ring-blue-500/20"
      />

      <button
        @click="tambahQty(item)"
        :disabled="item.qty >= getStok(item.id)"
        class="w-8 h-8 rounded-lg
               bg-[#1E3A8A]
               hover:bg-[#2563EB]
               disabled:bg-slate-200
               disabled:text-slate-400
               disabled:cursor-not-allowed
               text-white
               font-bold
               transition"
      >
        +
      </button>

    </div>

    <!-- Total harga -->
    <div class="text-right ml-8 min-w-[100px]">
      <p class="text-xs text-gray-400 mb-1">
        Subtotal
      </p>

      <p class="font-bold text-sm text-gray-800">
        Rp {{ (item.harga * item.qty).toLocaleString("id-ID") }}
      </p>
    </div>

  </div>
</div>
</div>

      <!-- Bagian Pembayaran -->
<div class="mt-6 border-t border-dashed pt-5">

  <!-- Total -->
  <div class="flex justify-between items-center mb-5">
    <h3 class="text-2xl font-bold text-gray-800">
      Total:
    </h3>

    <span class="text-2xl font-bold text-blue-600">
      Rp {{ totalHarga.toLocaleString("id-ID") }}
    </span>
  </div>

  <!-- Metode Pembayaran -->
  <div class="mb-5">
    <label class="block font-semibold text-base mb-2">
      Metode Pembayaran
    </label>

    <select
  v-model="metodePembayaran"
  class="w-full border rounded-xl p-3 bg-white"
>
  <option value="Tunai">💵 Tunai</option>
  <option value="QRIS">📱 QRIS</option>
  <option value="Transfer">🏦 Transfer Bank</option>
  <option value="Debit">💳 Kartu Debit</option>
</select>

<!-- QRIS -->
<div
  v-if="metodePembayaran === 'QRIS'"
  class="mt-4 text-center bg-gray-50 rounded-xl p-5 border"
>
  <img
  src="/images/qris.png"
  class="w-44 mx-auto"
/>

  <p class="text-sm mt-3 text-gray-600">
    Scan QRIS menggunakan aplikasi pembayaran.
  </p>
</div>

<!-- Transfer -->
<div
  v-if="metodePembayaran === 'Transfer'"
  class="mt-4 bg-blue-50 rounded-xl p-4"
>
  <label class="font-semibold">
    Pilih Bank
  </label>

  <select class="w-full mt-2 border rounded-lg p-2">
    <option>BCA</option>
    <option>BRI</option>
    <option>BNI</option>
    <option>Mandiri</option>
  </select>
</div>

<!-- Debit -->
<div
  v-if="metodePembayaran === 'Debit'"
  class="mt-4 bg-yellow-50 rounded-xl p-4"
>
  Gesek atau tempel kartu debit pada mesin EDC.
</div>
</div>

  <!-- Input Bayar -->
  <div
  class="mb-5"
  v-if="metodePembayaran === 'Tunai'"
>

    <div class="flex items-center gap-3 mb-3">

      <div
        class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-xl"
      >
        💳
      </div>

      <span class="font-semibold text-base">
        Uang Tunai (Bayar)
      </span>

    </div>

    <div class="flex">

      <input
        v-model.number="bayar"
        type="number"
        placeholder="0"
        class="flex-1 border border-gray-300 rounded-l-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
      />

      <div
        class="px-5 flex items-center bg-gray-100 border border-l-0 border-gray-300 rounded-r-xl font-semibold text-gray-600"
      >
        Rp
      </div>

    </div>

  </div>

  <!-- Kembalian -->
 <div
  v-if="metodePembayaran === 'Tunai'"
  class="flex justify-between items-center bg-green-50 rounded-xl p-4 mb-5"
>

    <div class="flex items-center gap-3">

      <div
        class="w-11 h-11 rounded-lg bg-green-100 flex items-center justify-center text-lg"
      >
        💵
      </div>

      <span class="font-semibold text-base">
        Kembalian:
      </span>

    </div>

    <span class="text-xl font-bold text-green-600">
      Rp {{ kembalian > 0 ? kembalian.toLocaleString("id-ID") : 0 }}
    </span>

  </div>

  <div
  v-if="bayar > 0 && bayar < totalHarga"
  class="mt-4 mb-5 p-3 bg-red-50 border border-red-300 rounded-lg"
>
  <p class="text-red-600 font-semibold">
    ⚠️ Uang Anda kurang
    <span class="font-bold">
      Rp {{ kekurangan.toLocaleString("id-ID") }}
    </span>
  </p>

  <p class="text-sm text-red-500 mt-1">
    Silakan masukkan uang minimal
    <b>Rp {{ totalHarga.toLocaleString("id-ID") }}</b>
  </p>
</div>

  <!-- Tombol -->
  <div class="grid grid-cols-2 gap-3">

    <button
      @click="batalkanPembayaran"
      class="py-3 rounded-xl bg-red-500 text-white font-semibold hover:bg-red-600 transition"
    >
      ❌ Batalkan
    </button>

    <button
      @click="prosesTransaksi"
     :disabled=" totalHarga === 0 || (metodePembayaran === 'Tunai' && bayar < totalHarga)"
      class="py-3 rounded-xl bg-gradient-to-r from-blue-700 to-blue-500 text-white font-semibold hover:opacity-90 transition disabled:bg-gray-300 disabled:cursor-not-allowed"
    >
      🛒 Proses Transaksi
    </button>
  </div>
</div>
      </div>
    </div>
  </div>

  <!-- ================= POPUP STRUK ================= -->
<div
  v-if="showStruk"
  class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
>
  <div class="bg-white rounded-2xl shadow-2xl w-[430px] overflow-hidden">

    <!-- Header -->
    <div class="bg-gradient-to-r from-[#1E3A8A] to-[#2563EB] text-white text-center py-5">
      <h2 class="text-2xl font-bold">🛍️ VELOURA STORE</h2>
      <p class="text-sm text-blue-100">Fashion Store Management</p>
    </div>

    <!-- Isi -->
    <div class="p-6">

      <div class="text-sm mb-4">
        <div class="flex justify-between">
          <span>No Nota</span>
          <span class="font-semibold">{{ dataStruk.no_nota }}</span>
        </div>

        <div class="flex justify-between">
          <span>Tanggal</span>
          <span>{{ dataStruk.tanggal }}</span>
        </div>

        <div class="flex justify-between">
          <span>Metode</span>
          <span>{{ dataStruk.metode }}</span>
        </div>
      </div>

      <hr>

      <!-- Daftar Barang -->
      <div class="my-4 max-h-60 overflow-auto">

        <div
          v-for="item in dataStruk.items"
          :key="item.id"
          class="mb-3"
        >
          <div class="font-semibold">
            {{ item.nama_barang }}
          </div>

          <div class="flex justify-between text-sm text-gray-500">
            <span>
              {{ item.qty }} × Rp
              {{ Number(item.harga).toLocaleString("id-ID") }}
            </span>

            <span>
              Rp
              {{ Number(item.qty * item.harga).toLocaleString("id-ID") }}
            </span>
          </div>

        </div>

      </div>

      <hr>

      <!-- Total -->
      <div class="space-y-2 mt-4">

        <div class="flex justify-between">
          <span>Total</span>
          <b>
            Rp {{ Number(dataStruk.total).toLocaleString("id-ID") }}
          </b>
        </div>

        <div class="flex justify-between">
          <span>Bayar</span>
          <b>
            Rp {{ Number(dataStruk.bayar).toLocaleString("id-ID") }}
          </b>
        </div>

        <div class="flex justify-between">
          <span>Kembalian</span>
          <b class="text-green-600">
            Rp {{ Number(dataStruk.kembali).toLocaleString("id-ID") }}
          </b>
        </div>

      </div>

      <div class="mt-6 text-center text-gray-500 text-sm">
        ❤️ Terima kasih telah berbelanja di Veloura Store
      </div>

      <!-- Tombol -->
      <div class="grid grid-cols-2 gap-3 mt-6">

        <button
          onclick="window.print()"
          class="bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold"
        >
          🖨️ Cetak
        </button>

        <button
          @click="showStruk = false"
          class="bg-gray-300 hover:bg-gray-400 py-3 rounded-xl font-semibold"
        >
          Tutup
        </button>

      </div>

    </div>

  </div>
</div>
</template>

<script setup>
const token = useCookie("token");
const daftarBarang = ref([]);
const keranjang = ref([]);
const bayar = ref(0);
const metodePembayaran = ref("Tunai");
const showDropdown = ref(false);
const route = useRoute();

const showStruk = ref(false)

const dataStruk = ref({
  no_nota: "",
  tanggal: "",
  items: [],
  total: 0,
  bayar: 0,
  kembali: 0,
  metode: "",
})

const loadBarang = async () => {
  try {
    const data = await $fetch(
      "http://localhost/crud-laravel/public/api/barang",
      {
        headers: {
          Authorization: `Bearer ${token.value}`,
        },
      }
    );

    console.log("DATA BARANG:", data);

    daftarBarang.value = data;
  } catch (err) {
    console.error("ERROR LOAD BARANG:", err);
  }
};

const search = ref("");

const filteredBarang = computed(() => {
  return daftarBarang.value.filter((barang) => {
    const keyword = search.value.toLowerCase();

    return (
      barang.nama_barang.toLowerCase().includes(keyword) ||
      barang.kode_barang.toLowerCase().includes(keyword)
    );
  });
});

watchEffect(() => {
  console.log("Daftar Barang:", daftarBarang.value);
  console.log("Filtered Barang:", filteredBarang.value);
});

onMounted(() => {
  if (!token.value) navigateTo("/");
  loadBarang();
});

const tambahKeKeranjang = (barang) => {
  // Ambil referensi stok asli dari daftarBarang
  const targetBarang = daftarBarang.value.find((b) => b.id === barang.id);
  const itemInCart = keranjang.value.find((i) => i.id === barang.id);

  if (!targetBarang || targetBarang.stok <= 0) {
    alert("Stok barang sudah habis!");
    return;
  }

  if (itemInCart) {
    if (itemInCart.qty < targetBarang.stok) {
      itemInCart.qty++;
    } else {
      alert("Jumlah melebihi stok yang tersedia!");
    }
  } else {
    keranjang.value.push({ ...barang, qty: 1 });
  }
};

const kurangiQty = (item) => {
  const index = keranjang.value.findIndex((i) => i.id === item.id);
  if (index !== -1) {
    if (keranjang.value[index].qty > 1) {
      keranjang.value[index].qty--;
    } else {
      keranjang.value.splice(index, 1);
    }
  }
};

const tambahQty = (item) => {
  const stokTersedia = getStok(item.id)

  if (item.qty < stokTersedia) {
    item.qty++
  } else {
    alert(
      `Stok ${item.nama_barang} hanya tersedia ${stokTersedia} pcs`
    )
  }
}

const getStok = (id) => {
  const barang = daftarBarang.value.find(
    (b) => b.id === id
  )

  return barang ? Number(barang.stok) : 0
}


const ubahQty = (item) => {
  const stokTersedia = getStok(item.id)

  let qty = Number(item.qty)

  // Jika kosong / bukan angka
  if (!Number.isFinite(qty) || qty < 1) {
    item.qty = 1
    return
  }

  // Bulatkan ke bawah
  qty = Math.floor(qty)

  // Jika melebihi stok
  if (qty > stokTersedia) {
    item.qty = stokTersedia

    alert(
      `Stok ${item.nama_barang} hanya tersedia ${stokTersedia} pcs`
    )

    return
  }

  item.qty = qty
}

const kekurangan = computed(() => {
  const bayarValue = Number(bayar.value) || 0
  return totalHarga.value > bayarValue
    ? totalHarga.value - bayarValue
    : 0
})

const batalkanPembayaran = () => {
  if (confirm("Yakin ingin membatalkan transaksi?")) {
    keranjang.value = [];
    bayar.value = 0;
    metodePembayaran.value = "Tunai";
  }
};

const totalHarga = computed(() => {
  return keranjang.value.reduce(
    (total, item) => total + item.harga * item.qty,
    0,
  );
});

// Perhitungan nominal kembalian
const kembalian = computed(() => {
  return bayar.value - totalHarga.value;
});

const prosesTransaksi = async () => {
  try {
    // Cek apakah keranjang kosong
    if (keranjang.value.length === 0) {
      alert("Keranjang masih kosong!")
      return
    }

    // Cek pembayaran tunai
    if (
      metodePembayaran.value === "Tunai" &&
      bayar.value < totalHarga.value
    ) {
      alert(
        `Uang Anda kurang Rp ${kekurangan.value.toLocaleString("id-ID")}\n` +
        `Silakan masukkan uang minimal Rp ${totalHarga.value.toLocaleString("id-ID")}`
      )

      return
    }

    // Kurangi stok di frontend
    keranjang.value.forEach((itemKeranjang) => {
      const barangAsli = daftarBarang.value.find(
        (b) => b.id === itemKeranjang.id
      )

      if (barangAsli) {
        barangAsli.stok -= itemKeranjang.qty
      }
    })

    // Kirim transaksi ke Laravel
    const response = await $fetch(
      "http://localhost/crud-laravel/public/api/transaksi",
      {
        method: "POST",

        headers: {
          Authorization: `Bearer ${token.value}`,
        },

        body: {
          items: keranjang.value,

          bayar:
            metodePembayaran.value === "Tunai"
              ? bayar.value
              : totalHarga.value,

          metode_pembayaran: metodePembayaran.value,
        },
      }
    )

    // Data struk
    dataStruk.value = {
      no_nota: response.transaksi.no_nota,
      tanggal: response.transaksi.tanggal,
      items: [...keranjang.value],
      total: response.transaksi.total_harga,
      bayar: response.transaksi.bayar,
      kembali: response.transaksi.kembali,
      metode: response.transaksi.metode_pembayaran,
    }

    // Tampilkan struk
    showStruk.value = true

    // Reset keranjang
    keranjang.value = []
    bayar.value = 0
  } catch (err) {
    console.error("ERROR TRANSAKSI:", err)

    alert(
      err?.data?.message ||
      "Gagal memproses transaksi."
    )
  }
}
</script>
