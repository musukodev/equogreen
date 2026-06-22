<!DOCTYPE html>
<html lang="id">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>Daftar Vendor - Equogreen</title>

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
            fadeIn: {
              '0%': { opacity: '0' },
              '100%': { opacity: '1' },
            },
            modalSlideUp: {
              'from': { opacity: '0', transform: 'translateY(24px) scale(0.96)' },
              'to': { opacity: '1', transform: 'translateY(0) scale(1)' },
            }
          },
          animation: {
            'fade-in': 'fadeIn 0.25s ease-out forwards',
            'modal-slide-up': 'modalSlideUp 0.3s ease-out forwards',
          }
        }
      }
    }
  </script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex h-screen overflow-hidden antialiased text-gray-800 bg-brand-bg font-sans">


  <!-- Sidebar Overlay -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- ===== SIDEBAR ===== -->
  <aside id="sidebar"
    class="fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 w-[280px] min-h-screen bg-white flex-shrink-0 flex flex-col shadow-md">

    <!-- Logo -->
    <div class="flex items-center gap-3 px-6 pt-8 pb-6 border-b border-gray-100">
      <img src="/gambar/logo.png" alt="Logo Equogreen" class="w-14 h-14 rounded-full object-cover" />
      <span class="text-2xl font-bold text-gray-800">Equogreen</span>
    </div>

    <!-- Nav Menu -->
    <nav class="flex-1 px-4 py-6 flex flex-col gap-1">

      <!-- Dashboard -->
      <a href="{{ route('procurement-dashboard') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/dashboard-layout.png" alt="Dashboard"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Dashboard
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Periksa Barang -->
      <a href="{{ route('procurement-batch_barang') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/search-database.png" alt="Periksa Barang"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Batch Barang
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Daftar Vendor (ACTIVE) -->
      <a href="{{ route('procurement-notifikasi') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Daftar Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Validasi Vendor -->
      <a href="{{ route('procurement-validasi-vendor') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/validasi.png" alt="Validasi Vendor"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Validasi Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Pengaturan -->


    </nav>

    <!-- Logout -->
    <div class="px-4 pb-8 border-t border-gray-100 pt-4">
      <a href="#"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
        <img src="/gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
        Logout
      </a>
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
          <img src="/gambar/garis3.png" alt="Menu"
            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>
        <div>
          <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Daftar Vendor</h1>
        </div>
      </div>

      <!-- Profile Section -->
      <div class="flex items-center gap-3">
        <button
          class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
          <img src="/gambar/bell-black.png" alt="Notifikasi"
            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>
        <img src="/gambar/profileup.png" alt="Profil"
          class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
        <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
      </div>
    </header>

    <!-- Filter Bar: Kategori Dropdown + Search -->
    <div class="flex flex-col md:flex-row items-center gap-4">
      <!-- Kategori Dropdown -->
      <div class="relative w-full md:w-48">
        <select id="filter-kategori"
          class="w-full appearance-none px-4 py-3 pr-10 rounded-xl border border-gray-800 bg-white text-gray-800 font-medium text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 cursor-pointer">
          <option value="semua">Kategori</option>
          <option value="atk">ATK</option>
          <option value="elektronik">Elektronik</option>
          <option value="furniture">Furniture</option>
          <option value="cleaning">Cleaning Supply</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
          </svg>
        </div>
      </div>
      <!-- Search Input -->
      <div class="w-full md:flex-1 relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"
          fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input id="search-input" type="text" placeholder="Search"
          class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-800 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" />
      </div>
    </div>

    <!-- Vendor Notification Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
      <table class="w-full border-collapse" id="notif-table">
        <thead>
          <tr class="border-b border-gray-200 bg-blue-600">
            <th class="px-3 md:px-5 py-3.5 text-left text-xs md:text-sm font-semibold text-white">Nama Vendor</th>
            <th class="px-3 md:px-5 py-3.5 text-left text-xs md:text-sm font-semibold text-white">Kategori</th>
            <th class="px-3 md:px-5 py-3.5 text-center text-xs md:text-sm font-semibold text-white">Profile</th>
          </tr>
        </thead>
        <tbody>
          @foreach($vendors as $vendor)
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="px-3 md:px-5 py-3.5 text-sm text-gray-700">{{ $vendor->nama_perusahaan }}</td>
            <td class="px-3 md:px-5 py-3.5 text-sm text-gray-700">{{ $vendor->kategori_vendor }}</td>
            <td class="px-3 md:px-5 py-3.5 text-center">
              <button class="btn-profile text-accent font-semibold text-sm underline underline-offset-2 hover:text-primary transition-colors"
                data-nama="{{ $vendor->nama_perusahaan }}"
                data-kategori="{{ $vendor->kategori_vendor }}"
                data-email="{{ $vendor->email_perusahaan }}"
                data-phone="{{ $vendor->no_hp }}"
                data-alamat="{{ $vendor->alamat }}">
                Profil
              </button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </main>

  <!-- ========== MODAL: Profile Vendor ========== -->
  <div id="profile-modal" class="hidden fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm animate-fade-in">
    <div class="animate-modal-slide-up bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 p-7 flex flex-col gap-4">
      <!-- Header -->
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Profil Vendor</h2>
        <button id="close-profile-modal"
          class="w-9 h-9 rounded-lg bg-red-500 text-white flex items-center justify-center hover:bg-red-600 active:scale-90 transition-all duration-200 text-lg font-bold">
          ✕
        </button>
      </div>
      <hr class="border-gray-100" />
      <!-- Vendor Info -->
      <div class="flex flex-col gap-3">
        <div class="flex items-center gap-4">
          <div
            class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl"
            id="modal-avatar">E</div>
          <div>
            <p class="font-bold text-gray-800 text-lg" id="modal-vendor-name">—</p>
            <span class="inline-block px-3 py-0.5 rounded-full bg-primary/10 text-primary text-xs font-semibold mt-1"
              id="modal-vendor-kategori">—</span>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-3 mt-2">
          <div class="bg-gray-50 rounded-lg p-3">
            <p class="text-xs text-gray-400 mb-0.5">Email</p>
            <p class="text-sm font-semibold text-gray-700 break-all" id="modal-vendor-email"></p>
          </div>
          <div class="bg-gray-50 rounded-lg p-3">
            <p class="text-xs text-gray-400 mb-0.5">Telepon</p>
            <p class="text-sm font-semibold text-gray-700" id="modal-vendor-phone"></p>
          </div>
          <div class="bg-gray-50 rounded-lg p-3 col-span-2">
            <p class="text-xs text-gray-400 mb-0.5">Alamat</p>
            <p class="text-sm font-semibold text-gray-700" id="modal-vendor-alamat"></p>
          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- ========== TOAST ========== -->
  <div id="toast"
    class="fixed bottom-6 right-6 z-[60] bg-primary text-white px-5 py-3 rounded-xl shadow-lg text-sm font-bold opacity-0 pointer-events-none transition-all duration-300 flex items-center gap-2">
    <span id="toast-icon">✓</span>
    <span id="toast-msg">Berhasil!</span>
  </div>

  <script>
    const profileModal = document.getElementById('profile-modal');
    const emailModal = document.getElementById('email-modal');

    // Logic Modal Profile
    document.querySelectorAll('.btn-profile').forEach(button => {
      button.addEventListener('click', function() {
        document.getElementById('modal-avatar').textContent = this.dataset.nama ? this.dataset.nama.charAt(0) : 'V';
        document.getElementById('modal-vendor-name').textContent = this.dataset.nama || '-';
        document.getElementById('modal-vendor-kategori').textContent = this.dataset.kategori || '-';
        document.getElementById('modal-vendor-email').textContent = this.dataset.email || '-';
        document.getElementById('modal-vendor-phone').textContent = this.dataset.phone || '-';
        document.getElementById('modal-vendor-alamat').textContent = this.dataset.alamat || '-';

        profileModal.classList.remove('hidden');
        profileModal.classList.add('flex');
      });
    });

    document.getElementById('close-profile-modal').addEventListener('click', function() {
      profileModal.classList.add('hidden');
      profileModal.classList.remove('flex');
    });

    // Close Modals when clicking outside
    window.addEventListener('click', function(e) {
      if (e.target === profileModal) {
        profileModal.classList.add('hidden');
        profileModal.classList.remove('flex');
      }
    });
  </script>
</body>

</html>
