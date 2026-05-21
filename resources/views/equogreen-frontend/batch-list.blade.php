<!DOCTYPE html>
<html lang="id">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>Batch Barang - Equogreen</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#4039c9',
            accent: '#002eff',
          },
          fontFamily: {
            sans: ['Inter', 'sans-serif'],
          }
        }
      }
    }
  </script>
  
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>


    /* Modal overlay */
    #folder-modal {
      display: none;
    }

    #folder-modal.show {
      display: flex;
    }

    /* Modal animation */
    @keyframes modalSlideUp {
      from {
        opacity: 0;
        transform: translateY(24px) scale(0.96);
      }

      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .modal-animate {
      animation: modalSlideUp 0.25s ease-out;
    }
  </style>
</head>

<body class="flex h-screen overflow-hidden antialiased text-gray-800 bg-brand-bg font-sans">

  <!-- Sidebar Overlay -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

  <!-- ===== SIDEBAR (sama dengan dashboard) ===== -->
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
      <a href="{{ route('procurement-dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/dashboard layout.png" alt="Dashboard" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Dashboard
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Periksa Barang (ACTIVE) -->
      <a href="{{ route('procurement-batch-list') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/search database.png" alt="Periksa Barang" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Batch Barang
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Kelola Notifikasi -->
      <a href="{{ route('procurement-notifikasi') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/Add Reminder.png" alt="Kelola Notifikasi" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Kelola Notifikasi
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Validasi Vendor -->
      <a href="{{ route('procurement-validasi-vendor') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="gambar/validasi.png" alt="Validasi Vendor" class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Validasi Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Pengaturan -->
      

    </nav>

    <!-- Logout -->
    <div class="px-4 pb-8 border-t border-gray-100 pt-4">
     <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form>
    </div>
  </aside>

  <!-- ===== MAIN CONTENT ===== -->
  <main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6">

    <!-- Top Header (sama dengan dashboard) -->
    <header class="flex items-center justify-between">
      <div class="flex items-center gap-4">
        <!-- Mobile Hamburger -->
        <button onclick="toggleSidebar()"
          class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
          <img src="gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>
        <!-- Back Button -->
        <a href="{{ route('procurement-dashboard') }}"
          class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm">
          <img src="gambar/Back Arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
        </a>
        <div>
          <h1 class="text-2xl md:text-[36px] font-bold text-[#111827] tracking-tight">Batch Barang</h1>
          <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Silahkan akses folder sesuai tahun yang diinginkan</p>
        </div>
      </div>

      <!-- Profile Section (sama dengan dashboard) -->
      <div class="flex items-center gap-3">
        <!-- Notification Bell -->
        <button
          class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
          <img src="gambar/bell-black.png" alt="Notifikasi"
            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
        </button>
        <img src="gambar/Profileup.png" alt="Profil"
          class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
        <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
      </div>
    </header>

    <!-- Search Bar & Add Folder Button -->
    <div class="flex items-center gap-4">
      <div class="flex-1 relative">
        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <input id="search-input" type="text" placeholder="Search"
          class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200 shadow-sm" />
      </div>
      <button id="btn-add-folder"
        class="flex items-center gap-2 px-5 py-3 rounded-xl bg-accent text-white font-bold text-sm hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        Folder
      </button>
    </div>

    <!-- Folder Grid -->
    <section id="folder-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

      <!-- Folder Card Template (repeated for each year) -->
      <a href="{{ route('procurement-batch_barang') }}" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2020">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2020</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2021">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2021</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2022">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2022</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2023">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2023</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2024">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2024</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2025">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2025</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2026">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2026</span>
        </div>
      </a>

      <a href="periksa-barang-detail.html" class="folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer" data-year="2027">
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">2027</span>
        </div>
      </a>

    </section>

  </main>

  <!-- ========== MODAL: Tambah Folder ========== -->
  <div id="folder-modal" class="fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm">
    <div class="modal-animate bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-7 flex flex-col gap-5">
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Tambah Folder</h2>
        <button id="close-folder-modal"
          class="w-9 h-9 rounded-lg bg-red-500 text-white flex items-center justify-center hover:bg-red-600 active:scale-90 transition-all duration-200 text-lg font-bold">
          ✕
        </button>
      </div>
      <div class="flex flex-col gap-1.5">
        <label class="text-sm font-semibold text-gray-700" for="folder-year">Nama Tahun</label>
        <input type="number" id="folder-year" placeholder="contoh: 2028" min="2000" max="2100"
          class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-white text-sm text-gray-700 outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200" />
      </div>
      <button id="btn-save-folder"
        class="w-full py-3 rounded-xl bg-accent text-white font-bold text-sm hover:bg-[#0023cc] active:scale-95 transition-all duration-200 shadow hover:shadow-lg">
        Simpan
      </button>
    </div>
  </div>

  <!-- ========== TOAST ========== -->
  <div id="toast"
    class="fixed bottom-6 right-6 z-[60] bg-primary text-white px-5 py-3 rounded-xl shadow-lg text-sm font-bold opacity-0 pointer-events-none transition-all duration-300 flex items-center gap-2">
    <span id="toast-icon">✓</span>
    <span id="toast-msg">Berhasil!</span>
  </div>

  <script>
    // ---- Add Folder Modal ----
    const folderModal = document.getElementById('folder-modal');
    const btnAddFolder = document.getElementById('btn-add-folder');
    const closeFolderModal = document.getElementById('close-folder-modal');
    const btnSaveFolder = document.getElementById('btn-save-folder');
    const folderYearInput = document.getElementById('folder-year');
    const folderGrid = document.getElementById('folder-grid');

    btnAddFolder.addEventListener('click', () => {
      folderModal.classList.add('show');
      folderYearInput.value = '';
      folderYearInput.focus();
    });

    closeFolderModal.addEventListener('click', () => folderModal.classList.remove('show'));
    folderModal.addEventListener('click', (e) => {
      if (e.target === folderModal) folderModal.classList.remove('show');
    });

    btnSaveFolder.addEventListener('click', () => {
      const year = folderYearInput.value.trim();
      if (!year || isNaN(year)) {
        showToast('Harap masukkan tahun yang valid!', true);
        return;
      }

      // Check if folder already exists
      const existing = document.querySelector(`.folder-card[data-year="${year}"]`);
      if (existing) {
        showToast(`Folder tahun ${year} sudah ada!`, true);
        return;
      }

      // Create new folder card
      const card = document.createElement('a');
      card.href = 'periksa-barang-detail.html';
      card.className = 'folder-card group bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-primary/40 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 overflow-hidden cursor-pointer';
      card.setAttribute('data-year', year);
      card.innerHTML = `
        <div class="h-32 bg-[#e8e8e0] group-hover:bg-primary/10 transition-colors duration-200 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-300 group-hover:text-primary/40 transition-colors duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
          </svg>
        </div>
        <div class="px-4 py-3 border-t border-gray-100">
          <span class="text-sm font-bold text-gray-700 group-hover:text-primary transition-colors duration-200">${year}</span>
        </div>
      `;
      // Add with animation
      card.style.opacity = '0';
      card.style.transform = 'scale(0.9)';
      folderGrid.appendChild(card);
      requestAnimationFrame(() => {
        card.style.transition = 'opacity 0.3s, transform 0.3s';
        card.style.opacity = '1';
        card.style.transform = 'scale(1)';
      });

      folderModal.classList.remove('show');
      showToast(`Folder tahun ${year} berhasil ditambahkan!`);
    });

    // ---- Search Filter ----
    document.getElementById('search-input').addEventListener('input', function() {
      const query = this.value.trim().toLowerCase();
      document.querySelectorAll('.folder-card').forEach(card => {
        const year = card.getAttribute('data-year');
        card.style.display = year.includes(query) ? '' : 'none';
      });
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
  </script>

</body>

</html>