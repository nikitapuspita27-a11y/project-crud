<template>
  <div
    class="min-h-screen relative overflow-hidden
    bg-gradient-to-br from-slate-50 via-white to-blue-50"
  >

    <!-- ================= BACKGROUND ================= -->
    <div class="absolute inset-0 pointer-events-none">

      <!-- Soft blue glow -->
      <div
        class="absolute -top-40 -left-40
        w-[500px] h-[500px]
        rounded-full
        bg-blue-200/30
        blur-3xl"
      ></div>

      <div
        class="absolute -bottom-40 -right-40
        w-[550px] h-[550px]
        rounded-full
        bg-indigo-200/30
        blur-3xl"
      ></div>

      <!-- Top left dots -->
      <div
        class="absolute top-8 left-8
        grid grid-cols-4 gap-3 opacity-60"
      >
        <span
          v-for="n in 12"
          :key="`left-${n}`"
          class="w-1.5 h-1.5
          rounded-full
          bg-blue-400"
        ></span>
      </div>

      <!-- Bottom right dots -->
      <div
        class="absolute bottom-8 right-8
        grid grid-cols-4 gap-3 opacity-40"
      >
        <span
          v-for="n in 12"
          :key="`right-${n}`"
          class="w-1.5 h-1.5
          rounded-full
          bg-blue-500"
        ></span>
      </div>

      <!-- Decorative circles -->
      <div
        class="absolute top-20 right-[12%]
        w-5 h-5
        rounded-full
        bg-blue-300/50"
      ></div>

      <div
        class="absolute bottom-32 left-[14%]
        w-8 h-8
        rounded-full
        bg-blue-300/30"
      ></div>

      <div
        class="absolute top-[38%] left-[7%]
        w-3 h-3
        rounded-full
        bg-indigo-300/40"
      ></div>

      <div
        class="absolute top-[25%] right-[7%]
        w-3 h-3
        rounded-full
        bg-blue-300/40"
      ></div>

    </div>


    <!-- ================= MAIN CONTENT ================= -->
    <main
      class="relative z-10
      min-h-screen
      flex
      items-center
      justify-center
      px-5
      py-10"
    >

      <div class="w-full max-w-[460px]">

        <!-- ================= BRAND ================= -->
        <div class="text-center mb-7">

          <!-- Logo -->
          <div class="flex justify-center mb-4">

            <div
              class="w-[78px] h-[78px]
              rounded-2xl
              bg-gradient-to-br
              from-[#1E3A8A]
              to-[#2563EB]
              flex
              items-center
              justify-center
              shadow-[0_15px_35px_rgba(30,58,138,0.25)]
              ring-8
              ring-blue-50"
            >
              <span class="text-4xl">
                🛍️
              </span>
            </div>

          </div>

          <h1
            class="text-[30px]
            font-black
            tracking-tight
            text-[#102A5C]"
          >
            Veloura Store
          </h1>

          <p
            class="mt-1
            text-sm
            font-medium
            text-slate-500"
          >
            Fashion that defines you
          </p>

        </div>


        <!-- ================= LOGIN CARD ================= -->
        <div
          class="bg-white/95
          backdrop-blur-xl
          rounded-[28px]
          border
          border-white
          shadow-[0_25px_70px_rgba(15,43,99,0.12)]
          px-6
          sm:px-9
          py-8"
        >

          <!-- Header -->
          <div class="mb-7">

            <h2
              class="text-2xl
              font-extrabold
              text-[#102A5C]"
            >
              Welcome Back 👋
            </h2>

            <p
              class="mt-2
              text-sm
              text-slate-500"
            >
              Masuk untuk mengelola Veloura Store
            </p>

          </div>


          <!-- ================= FORM ================= -->
          <form @submit.prevent="login">

            <!-- Email -->
            <div class="mb-5">

              <label
                for="email"
                class="block
                text-sm
                font-bold
                text-slate-700
                mb-2"
              >
                Email
              </label>

              <div class="relative">

                <span
                  class="absolute
                  left-4
                  top-1/2
                  -translate-y-1/2
                  text-slate-400"
                >
                  ✉️
                </span>

                <input
                  id="email"
                  v-model="email"
                  type="email"
                  autocomplete="email"
                  placeholder="admin@gmail.com"
                  class="w-full
                  h-13
                  pl-11
                  pr-4
                  rounded-xl
                  border
                  border-slate-200
                  bg-slate-50
                  text-slate-700
                  placeholder:text-slate-400
                  outline-none
                  transition-all
                  duration-200
                  focus:bg-white
                  focus:border-blue-500
                  focus:ring-4
                  focus:ring-blue-500/10"
                />

              </div>

            </div>


            <!-- Password -->
            <div class="mb-5">

              <label
                for="password"
                class="block
                text-sm
                font-bold
                text-slate-700
                mb-2"
              >
                Password
              </label>

              <div class="relative">

                <span
                  class="absolute
                  left-4
                  top-1/2
                  -translate-y-1/2
                  text-slate-400"
                >
                  🔒
                </span>

                <input
                  id="password"
                  v-model="password"
                  :type="showPassword ? 'text' : 'password'"
                  autocomplete="current-password"
                  placeholder="••••••••"
                  class="w-full
                  h-13
                  pl-11
                  pr-12
                  rounded-xl
                  border
                  border-slate-200
                  bg-slate-50
                  text-slate-700
                  placeholder:text-slate-400
                  outline-none
                  transition-all
                  duration-200
                  focus:bg-white
                  focus:border-blue-500
                  focus:ring-4
                  focus:ring-blue-500/10"
                />

                <button
                  type="button"
                  @click="showPassword = !showPassword"
                  class="absolute
                  right-4
                  top-1/2
                  -translate-y-1/2
                  text-slate-400
                  hover:text-blue-600
                  transition"
                >
                  {{ showPassword ? "🙈" : "👁️" }}
                </button>

              </div>

            </div>


            <!-- Remember + Forgot -->
            <div
              class="flex
              flex-wrap
              items-center
              justify-between
              gap-3
              mb-7"
            >

              <label
                class="flex
                items-center
                gap-2
                text-sm
                text-slate-500
                cursor-pointer"
              >

                <input
                  v-model="rememberMe"
                  type="checkbox"
                  class="w-4
                  h-4
                  rounded
                  border-slate-300
                  accent-blue-600"
                />

                Ingat saya

              </label>


              <button
                type="button"
                @click="forgotPassword"
                class="text-sm
                font-semibold
                text-blue-600
                hover:text-blue-800
                transition"
              >
                Lupa password?
              </button>

            </div>


            <!-- Login Button -->
            <button
              type="submit"
              :disabled="loading"
              class="group
              w-full
              h-13
              rounded-xl
              bg-gradient-to-r
              from-[#1E3A8A]
              to-[#2563EB]
              text-white
              font-bold
              shadow-[0_10px_25px_rgba(37,99,235,0.25)]
              hover:shadow-[0_15px_30px_rgba(37,99,235,0.30)]
              hover:-translate-y-0.5
              active:translate-y-0
              disabled:opacity-60
              disabled:cursor-not-allowed
              transition-all
              duration-200"
            >

              <span
                v-if="!loading"
                class="flex
                items-center
                justify-center
                gap-3"
              >
                Masuk ke Dashboard

                <span
                  class="text-xl
                  transition-transform
                  duration-200
                  group-hover:translate-x-1"
                >
                  →
                </span>
              </span>

              <span v-else>
                Memproses...
              </span>

            </button>

          </form>


          <!-- ================= DIVIDER ================= -->
          <div
            class="flex
            items-center
            gap-4
            my-7"
          >

            <div class="flex-1 h-px bg-slate-200"></div>

            <span
              class="text-xs
              font-medium
              text-slate-400"
            >
              Veloura Store
            </span>

            <div class="flex-1 h-px bg-slate-200"></div>

          </div>


          <!-- ================= SECURITY ================= -->
          <div
            class="flex
            items-center
            justify-center
            gap-3
            rounded-xl
            bg-blue-50/70
            border
            border-blue-100
            px-4
            py-3"
          >

            <div
              class="w-9
              h-9
              shrink-0
              rounded-full
              bg-white
              shadow-sm
              flex
              items-center
              justify-center"
            >
              🛡️
            </div>

            <div>

              <p
                class="text-sm
                font-semibold
                text-[#1E3A8A]"
              >
                Sistem aman & terpercaya
              </p>

              <p
                class="text-xs
                text-slate-400
                mt-0.5"
              >
                Data akun Anda terlindungi
              </p>

            </div>

          </div>

        </div>


        <!-- ================= FOOTER ================= -->
        <div class="text-center mt-6">

          <p class="text-xs text-slate-400">
            © {{ currentYear }} Veloura Store
          </p>

          <p class="text-xs text-slate-400 mt-1">
            Fashion • Quality • Style
          </p>

        </div>

      </div>

    </main>

  </div>
</template>


<script setup>
const email = ref("")
const password = ref("")
const showPassword = ref(false)
const rememberMe = ref(false)
const loading = ref(false)

const currentYear = new Date().getFullYear()


const login = async () => {

  if (!email.value || !password.value) {
    alert("Email dan password wajib diisi!")
    return
  }

  loading.value = true

  try {

    const response = await $fetch(
      "http://localhost/crud-laravel/public/api/login",
      {
        method: "POST",

        body: {
          email: email.value,
          password: password.value
        }
      }
    )

    console.log("Login berhasil:", response)

    if (response.token) {

      const token = useCookie("token", {
        sameSite: "lax",
        secure: false
      })

      token.value = response.token
    }

    await navigateTo("/kasir")

  } catch (error) {
  console.error("Login error:", error)
  console.log("Status:", error?.status)
  console.log("Response:", error?.data)

  alert(
    `Login gagal (${error?.status || "tidak diketahui"}): ${
      error?.data?.message || error?.message || "Periksa Console"
    }`
  )
}
  loading.value = false
}


const forgotPassword = () => {
  alert("Silakan hubungi administrator Veloura Store.")
}
</script>