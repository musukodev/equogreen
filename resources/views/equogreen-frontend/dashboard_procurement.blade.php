<!DOCTYPE html>
<html lang="id">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>Dashboard - Equogreen</title>
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
      <img src="/gambar/logo.png" alt="Logo Equogreen" class="w-14 h-14 rounded-full object-cover" />
      <span class="text-2xl font-bold text-gray-800">Equogreen</span>
    </div>

    <!-- Nav Menu -->
    <nav class="flex-1 px-4 py-6 flex flex-col gap-1">

      <!-- Dashboard -->
      <a href="{{ route('procurement-dashboard') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/dashboard-layout.png" alt="Dashboard"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Dashboard
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Periksa Barang -->
      <a href="{{ route('procurement-batch-list') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/search-database.png" alt="Periksa Barang"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Batch Barang
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Kelola Notifikasi -->
      <a href="{{ route('procurement-notifikasi') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/add-reminder.png" alt="Periksa Barang"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Kelola Notifikasi
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

      
    </nav>

    <!-- Logout -->
    <div class="px-4 pb-8 border-t border-gray-100 pt-4">
      <form method="POST" action="{{ route('logout') }}" id="logout-form">
        @csrf
        <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
          <img src="/gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
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
          <img src="/gambar/garis3.png" alt="Menu"
            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>
        <div>
          <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Dashboard</h1>
          <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Halo, ATK Corner! Selamat datang
            di website Equogreen</p>
        </div>
      </div>

      <!-- Profile Section -->
      <div class="flex items-center gap-3">
        <!-- Notification Bell -->
        <button
          class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
          <img src="/gambar/bell-black.png" alt="Notifikasi"
            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>

        <!-- Profile -->
        <img src="/gambar/profileup.png" alt="Profil"
          class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
        <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
      </div>
    </header>

    <!-- Announcement Banner (clickable) -->
    <section id="banner-pengumuman"
      class="bg-[#4039c9] rounded-2xl border border-black px-6 py-5 md:px-8 md:py-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 shadow-md cursor-pointer hover:shadow-lg hover:scale-[1.01] active:scale-[0.995] transition-all duration-200">
      <div class="flex-1">
        <p class="text-white/70 text-sm font-bold tracking-widest uppercase mb-1">PENGUMUMAN</p>
        <h2 class="text-white text-xl lg:text-2xl font-bold mb-2">Buat pengumuman untuk vendor</h2>
        <p class="text-white/80 text-sm lg:text-base">Pastikan spesifikasi barang dan tenggat waktu sudah sesuai</p>
      </div>
      <!-- Decorative icon area -->
      <div
        class="w-16 h-16 md:w-20 md:h-20 bg-[#2d4ddd]/65 rounded-full flex items-center justify-center flex-shrink-0">
        <img src="/gambar/pengumuman.png" alt="banner icon"
          class="w-10 h-10 md:w-12 md:h-12 object-cover rounded-full" />
      </div>
    </section>

    <!-- Kategori Section -->
    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
      <h2 class="text-xl font-bold text-gray-800 mb-6">Kategori</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-4">
        @php
          $categories = [
            'ATK', 'Perangkat Lunak', 'APD', 'Generator Set',
            'Elektronik', 'Pantry', 'Kemasan', 'Plumbing Set',
            'Furniture', 'Alat Komunikasi', 'Peralatan Lab', 'Papan Informasi',
            'Kesehatan', 'Suku Cadang', 'Keamanan Fisik', 'Kendaraan Logistik',
            'Mesin Produksi', 'Bahan Penolong', 'Pemadam Api', 'K. Operasional',
            'Perangkat IT', 'Bahan Baku Utama', 'Perangkat Listrik', 'Seragam Karyawan'
          ];
        @endphp

        @foreach($categories as $category)
          <button 
            type="button"
            onclick="toggleCategory(this)"
            class="category-btn flex items-center px-5 py-3 rounded-xl border border-gray-300 bg-white text-gray-700 font-medium text-[15px] transition-all duration-200 hover:border-primary hover:bg-primary/5 hover:shadow-sm text-left group"
          >
            <span class="truncate">{{ $category }}</span>
          </button>
        @endforeach
      </div>
    </section>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4">
      <button
        id="btn-pengaturan-waktu"
        class="flex-1 bg-accent text-white font-bold text-base md:text-lg rounded-2xl py-3 md:py-4 px-6 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg">
        Pengaturan Waktu
      </button>
      <button
        class="flex-1 bg-accent text-white font-bold text-base md:text-lg rounded-2xl py-3 md:py-4 px-6 hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg">
        Kirim
      </button>
    </div>


  </main>

  <!-- ========== MODAL: Pengumuman ========== -->
  <div id="pengumuman-modal"
  class="hidden fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm items-center justify-center p-4">
  
  <!-- Modal Content -->
  <div
      class="animate-[modalSlideUp_0.25s_ease-out] bg-[#eef0f5] rounded-2xl shadow-2xl w-full max-w-lg mx-auto p-5 md:p-7 flex flex-col gap-5">
      <!-- Header: Title + Action Buttons -->
      <div class="flex items-center justify-between gap-4">
        <h2 class="text-2xl font-bold text-gray-900">Pengumuman</h2>
        <div class="flex items-center gap-2 flex-shrink-0">
          <!-- Edit Button -->
          <button id="btn-edit-pengumuman"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg border-2 border-gray-200 bg-white text-gray-700 font-bold text-sm hover:border-primary hover:text-primary transition-all duration-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
          </button>
          <!-- Hapus Button (Icon Only) -->
          <button id="btn-hapus-pengumuman"
            class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#1f2937] text-white hover:bg-gray-800 transition-all duration-200 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
          </button>
          <!-- Close (X) Button -->
          <button id="close-pengumuman-modal"
            class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#ef4444] text-white hover:bg-red-600 active:scale-90 transition-all duration-200 shadow-sm text-xl font-bold">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
              stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Textarea -->
      <textarea id="pengumuman-text" rows="10" disabled
        class="w-full rounded-xl border border-gray-200 bg-white p-5 text-sm text-gray-700 resize-none outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 disabled:opacity-60 disabled:cursor-default placeholder:text-gray-400"
        placeholder="Buatlah pengumuman untuk vendor"></textarea>

    </div>
  </div>

  <!-- ========== MODAL: Pengaturan Waktu ========== -->
  <div id="waktu-modal"
    class="hidden fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm items-center justify-center p-4">

    <!-- Modal Content -->
    <div
      class="animate-[modalSlideUp_0.25s_ease-out] bg-[#f0f5ff] rounded-[32px] shadow-2xl w-full max-w-xl mx-auto overflow-hidden">
      
      <!-- Header -->
      <div class="bg-white px-8 py-6 flex items-center justify-between border-b border-gray-100">
        <div>
          <h2 class="text-2xl font-extrabold text-gray-900 tracking-tight">Pengaturan Waktu</h2>
          <p class="text-gray-500 text-base font-medium mt-0.5">Atur tenggat waktu pengumumuman</p>
        </div>
        <button id="close-waktu-modal" class="w-12 h-12 flex items-center justify-center bg-[#ff4d4d] rounded-xl hover:bg-red-600 active:scale-90 transition-all duration-200 shadow-sm">
           <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
           </svg>
        </button>
      </div>

      <!-- Body -->
      <div class="p-8 flex flex-col gap-5">
        
        <!-- Row 1: Time -->
        <div class="bg-primary rounded-2xl p-5 flex items-center gap-6">
          <div class="flex-shrink-0 flex items-center justify-center border-r border-white/20 pr-6">
             <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.5"/>
                <path d="M12 7V12L15 13.5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="18.5" cy="18.5" r="4" fill="#4039c9" stroke="white" stroke-width="1.5"/>
                <path d="M18.5 17V18.5M18.5 20H18.51" stroke="white" stroke-width="2" stroke-linecap="round"/>
             </svg>
          </div>
          <div class="flex-1 grid grid-cols-2 gap-6">
             <div class="flex flex-col gap-1.5">
                <label class="text-white text-sm font-bold ml-1">Start</label>
                <input type="time" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner" placeholder="--:--">
             </div>
             <div class="flex flex-col gap-1.5">
                <label class="text-white text-sm font-bold ml-1">End</label>
                <input type="time" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner" placeholder="--:--">
             </div>
          </div>
        </div>

        <!-- Row 2: Date -->
        <div class="bg-primary rounded-2xl p-5 flex items-center gap-6">
          <div class="flex-shrink-0 flex items-center justify-center border-r border-white/20 pr-6">
             <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 2V5M16 2V5M3 8.5H21M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="18.5" cy="18.5" r="4" fill="#4039c9" stroke="white" stroke-width="1.5"/>
                <circle cx="18.5" cy="18.5" r="2" stroke="white" stroke-width="1"/>
                <path d="M18.5 17.5V18.5L19.5 19" stroke="white" stroke-width="1" stroke-linecap="round"/>
             </svg>
          </div>
          <div class="flex-1 grid grid-cols-2 gap-6">
             <div class="flex flex-col gap-1.5">
                <label class="text-white text-sm font-bold ml-1">Start</label>
                <input type="date" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner" placeholder="DD/MM/YYYY">
             </div>
             <div class="flex flex-col gap-1.5">
                <label class="text-white text-sm font-bold ml-1">End</label>
                <input type="date" class="w-full bg-white rounded-xl px-4 py-2.5 text-gray-700 outline-none shadow-inner" placeholder="DD/MM/YYYY">
             </div>
          </div>
        </div>

        <!-- Submit Button -->
        <button id="save-waktu-modal" class="w-full bg-accent text-white font-bold text-lg py-4 rounded-xl hover:bg-blue-700 transition-all duration-200 mt-2 shadow-lg active:scale-[0.98]">
           Simpan
        </button>

      </div>
    </div>
  </div>

  <!-- ========== TOAST NOTIFICATION ========== -->
  <div id="toast"
    class="fixed bottom-6 right-6 z-[60] bg-primary text-white px-5 py-3 rounded-xl shadow-lg text-sm font-bold opacity-0 pointer-events-none transition-all duration-300 flex items-center gap-2">
    <span id="toast-icon">✓</span>
    <span id="toast-msg">Berhasil!</span>
  </div>

  <script>
    // ---- Elements ----
    const banner = document.getElementById('banner-pengumuman');
    const modal = document.getElementById('pengumuman-modal');
    const closeBtn = document.getElementById('close-pengumuman-modal');
    const editBtn = document.getElementById('btn-edit-pengumuman');
    const hapusBtn = document.getElementById('btn-hapus-pengumuman');
    const textarea = document.getElementById('pengumuman-text');

    // ---- Open Modal ----
    banner.addEventListener('click', () => {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });

    // ---- Close Modal ----
    closeBtn.addEventListener('click', () => {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      // Reset edit state when closing
      textarea.disabled = true;
      editBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
      editBtn.classList.remove('border-primary', 'text-primary');
    });

    // Click overlay to close
    modal.addEventListener('click', (e) => {
      if (e.target === modal) closeBtn.click();
    });

    // ---- Edit / Simpan Toggle ----
    editBtn.addEventListener('click', () => {
      const isEditing = !textarea.disabled;
      if (isEditing) {
        // Save mode
        textarea.disabled = true;
        editBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
        editBtn.classList.remove('border-primary', 'text-primary');
        showToast('Pengumuman berhasil disimpan!');
      } else {
        // Enter edit mode
        textarea.disabled = false;
        textarea.focus();
        editBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Simpan`;
        editBtn.classList.add('border-primary', 'text-primary');
      }
    });

    // ---- Hapus ----
    hapusBtn.addEventListener('click', () => {
      if (textarea.value.trim() === '') {
        showToast('Tidak ada pengumuman untuk dihapus.', true);
        return;
      }
      textarea.value = '';
      textarea.disabled = true;
      editBtn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
      editBtn.classList.remove('border-primary', 'text-primary');
      showToast('Pengumuman berhasil dihapus!');
    });

    // ---- Toast Helper ----
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

    // ---- Toggle Category (Multi-select) ----
    function toggleCategory(btn) {
      const isSelected = btn.classList.contains('selected');
      
      if (isSelected) {
        // Deselect
        btn.classList.remove('selected', 'bg-primary', 'text-white', 'border-primary');
        btn.classList.add('bg-white', 'text-gray-700', 'border-gray-300');
      } else {
        // Select
        btn.classList.add('selected', 'bg-primary', 'text-white', 'border-primary');
        btn.classList.remove('bg-white', 'text-gray-700', 'border-gray-300');
      }
    }

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

    // ---- Pengaturan Waktu Modal Logic ----
    const waktuModal = document.getElementById('waktu-modal');
    const btnWaktu = document.getElementById('btn-pengaturan-waktu');
    const closeWaktuBtn = document.getElementById('close-waktu-modal');
    const saveWaktuBtn = document.getElementById('save-waktu-modal');

    btnWaktu.addEventListener('click', () => {
      waktuModal.classList.remove('hidden');
      waktuModal.classList.add('flex');
    });

    closeWaktuBtn.addEventListener('click', () => {
      waktuModal.classList.add('hidden');
      waktuModal.classList.remove('flex');
    });

    waktuModal.addEventListener('click', (e) => {
      if (e.target === waktuModal) closeWaktuBtn.click();
    });

    saveWaktuBtn.addEventListener('click', () => {
      closeWaktuBtn.click();
      showToast('Pengaturan waktu berhasil disimpan!');
    });
  </script>

</body>

</html>