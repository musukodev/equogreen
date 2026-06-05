<!DOCTYPE html>
<html lang="id">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>Profile - Equogreen</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4039c9',
            accent: '#002eff',
            brand: {
              bg: '#f1f5fa',
            }
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          },
          keyframes: {
            modalSlideUp: {
              'from': { opacity: '0', transform: 'translateY(24px) scale(0.96)' },
              'to': { opacity: '1', transform: 'translateY(0) scale(1)' },
            }
          },
          animation: {
            'modal-slide-up': 'modalSlideUp 0.25s ease-out',
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
</head>

<body class="flex h-screen overflow-hidden antialiased text-gray-800 bg-brand-bg font-sans">

  <!-- Sidebar Overlay -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside id="sidebar"
    class="fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 w-[280px] min-h-screen bg-white flex-shrink-0 flex flex-col shadow-md">

    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 pt-8 pb-6 border-b border-gray-100">
      <img src="gambar/logo.png" alt="Logo Equogreen" class="w-14 h-14 rounded-full object-cover" />
      <span class="text-2xl font-bold text-gray-800">Equogreen</span>
    </div>

    <!-- Nav Menu -->
    <nav class="flex-1 px-4 py-6 flex flex-col gap-1">

      <!-- Dashboard -->
      <a href="{{ route('procurement-dashboard') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/dashboard-layout.png" alt="Dashboard"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Dashboard
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Batch Barang -->
      <a href="{{ route('procurement-batch-list') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/search-database.png" alt="Batch Barang"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Batch Barang
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Kelola Notifikasi -->
      <a href="{{ route('procurement-notifikasi') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/Add-Reminder.png" alt="Kelola Notifikasi"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Kelola Notifikasi
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Validasi Vendor -->
      <a href="{{ route('procurement-validasi-vendor') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/validasi.png" alt="Validasi Vendor"
          class="w-7 h-7 scale-[1.4] object-contain group-hover:brightness-0 group-hover:invert" />
        Validasi Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>

    </nav>

    <!-- Logout -->
    <div class="px-4 pb-8 border-t border-gray-100 pt-4">
      <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
        <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
          <img src="gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
          Logout
        </button>
      </form>
    </div>
  </aside>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 gap-6 overflow-y-auto">

    <!-- Top Header -->
    <header class="flex items-center justify-between">
      <div class="flex items-center gap-4">
        <!-- Mobile Hamburger -->
        <button onclick="toggleSidebar()"
          class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
          <img src="gambar/garis3.png" alt="Menu"
            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>

        <!-- Back Button + Title -->
        <div class="flex items-center gap-3">
         
          <div>
            <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Profile</h1>
            <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Silakan ubah data profile apabila ada perubahan</p>
          </div>
        </div>
      </div>

      <!-- Profile Section -->
      <div class="flex items-center gap-3">
        <!-- Notification Bell -->
        <button
          class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200">
          <img src="gambar/bell-black.png" alt="Notifikasi"
            class="w-6 h-6 object-contain" />
        </button>

        <!-- Profile -->
        <img src="gambar/Profileup.png" alt="Profil"
          class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
        <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
      </div>
    </header>

    <!-- ===== PROFILE FORM CARD ===== -->
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

      <form method="POST" action="#" class="flex flex-col gap-6">
        @csrf
        @method('PUT')

        <!-- Form Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6">
          
          <!-- Nama Procurement -->
          <div class="flex flex-col gap-2">
            <label for="nama_procurement" class="text-[15px] font-semibold text-gray-700">
              Nama Procurement
            </label>
            <input
              id="nama_procurement"
              type="text"
              name="nama_procurement"
              value="{{ auth()->user()->procurement?->nama_procurement }}"
              class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
            />
          </div>

          <!-- ID Procurement -->
          <div class="flex flex-col gap-2">
            <label for="id_procurement" class="text-[15px] font-semibold text-gray-700">
              ID Procurement
            </label>
            <input
              id="id_procurement"
              type="text"
              name="id_procurement"
              value="{{ auth()->user()->procurement?->id_procurement }}"
              readonly
              class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50 text-gray-500 text-[15px] outline-none cursor-not-allowed"
              placeholder="ID Procurement"
            />
          </div>

          <!-- Email Procurement -->
          <div class="flex flex-col gap-2">
            <label for="email_procurement" class="text-[15px] font-semibold text-gray-700">
              Email Procurement
            </label>
            <input
              id="email_procurement"
              type="email"
              name="email"
              value="{{ auth()->user()->procurement?->email}}"
              class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
              placeholder="Masukkan email"
            />
          </div>
          <!-- No. Handphone -->
          <div class="flex flex-col gap-2">
            <label for="no_handphone" class="text-[15px] font-semibold text-gray-700">
              No. Handphone Procurement
            </label>
            <input
              id="no_handphone"
              type="tel"
              name="no_handphone"
              value="{{ auth()->user()->procurement?->no_hp}}"
              class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 text-[15px] outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 placeholder:text-gray-400"
              placeholder="Masukkan no. handphone"
            />
          </div>
          
        </div>

        <!-- Save Button -->
        <div class="pt-2">
          <button
            type="submit"
            id="btn-simpan-profile"
            class="w-full bg-accent text-white font-bold text-base md:text-lg rounded-2xl py-3 md:py-4 px-6 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg">
            Simpan Perubahan
          </button>
        </div>

      </form>
    </section>

  </main>

  <!-- ========== TOAST NOTIFICATION ========== -->
  <div id="toast"
    class="fixed bottom-6 right-6 z-[60] bg-primary text-white px-5 py-3 rounded-xl shadow-lg text-sm font-bold opacity-0 pointer-events-none transition-all duration-300 flex items-center gap-2">
    <span id="toast-icon">✓</span>
    <span id="toast-msg">Berhasil!</span>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.getElementById('sidebarOverlay');
      if (sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
      } else {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
      }
    }

    function showToast(msg, isError = false) {
      const toast = document.getElementById('toast');
      const toastMsg = document.getElementById('toast-msg');
      const toastIcon = document.getElementById('toast-icon');
      toastMsg.textContent = msg;
      toast.style.background = isError ? '#e53e3e' : '#4039c9';
      toastIcon.textContent = isError ? '!' : '✓';
      toast.style.opacity = '1';
      toast.style.pointerEvents = 'auto';
      setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.pointerEvents = 'none';
      }, 2800);
    }

 
  </script>

</body>

</html>
