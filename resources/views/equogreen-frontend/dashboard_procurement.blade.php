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
                              'from': {
                                  opacity: '0',
                                  transform: 'translateY(24px) scale(0.96)'
                              },
                              'to': {
                                  opacity: '1',
                                  transform: 'translateY(0) scale(1)'
                              },
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

  <body class="bg-brand-bg flex h-screen overflow-hidden font-sans text-gray-800 antialiased">

      <!-- Sidebar Overlay -->
      <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden" onclick="toggleSidebar()"></div>

      <!-- ===== SIDEBAR ===== -->
      <aside id="sidebar"
          class="fixed inset-y-0 left-0 z-50 flex min-h-screen w-[280px] flex-shrink-0 -translate-x-full transform flex-col bg-white shadow-md transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">

          <!-- Logo -->
          <div class="flex items-center gap-3 border-b border-gray-100 px-6 pb-6 pt-8">
              <img src="/gambar/logo.png" alt="Logo Equogreen" class="h-14 w-14 rounded-full object-cover" />
              <span class="text-2xl font-bold text-gray-800">Equogreen</span>
          </div>

          <!-- Nav Menu -->
          <nav class="flex flex-1 flex-col gap-1 px-4 py-6">

              <!-- Dashboard -->
              <a href="{{ route('procurement-dashboard') }}"
                  class="text-primary hover:bg-primary group flex items-center gap-3 rounded-xl bg-[#eef3ff] px-4 py-3 text-[17px] font-bold text-gray-700 transition-all duration-200 hover:text-white">
                  <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                      class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                  Dashboard
              </a>
              <div class="my-1 border-b border-gray-100"></div>

              <!-- Periksa Barang -->
              <a href="{{ route('procurement-batch_barang') }}"
                  class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                  <img src="/gambar/search-database.png" alt="Periksa Barang"
                      class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                  Batch Barang
              </a>
              <div class="my-1 border-b border-gray-100"></div>

              <!-- Daftar Vendor -->
              <a href="{{ route('procurement-notifikasi') }}"
                  class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                  <img src="/gambar/add-reminder.png" alt="Periksa Barang"
                      class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                  Daftar Vendor
              </a>
              <div class="my-1 border-b border-gray-100"></div>
              <!-- Validasi Vendor -->
              <a href="{{ route('procurement-validasi-vendor') }}"
                  class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                  <img src="/gambar/validasi.png" alt="Validasi Vendor"
                      class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                  Validasi Vendor
              </a>
              <div class="my-1 border-b border-gray-100"></div>


          </nav>

          <!-- Logout -->
          <div class="border-t border-gray-100 px-4 pb-8 pt-4">
              <form method="POST" action="{{ route('logout') }}" id="logout-form">
                  @csrf
                  <button type="submit"
                      class="group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-red-500 transition-all duration-200 hover:bg-red-50">
                      <img src="/gambar/logout.png" alt="Logout" class="h-7 w-7 object-contain" />
                      Logout
                  </button>
              </form>
          </div>
      </aside>

      <!-- ===== MAIN CONTENT ===== -->
      <main class="flex min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-4 md:p-6 lg:p-8">

          <!-- Top Header -->
          <header class="flex items-center justify-between">
              <div class="flex items-center gap-4">
                  <!-- Mobile Hamburger -->
                  <button onclick="toggleSidebar()"
                      class="hover:bg-primary hover:border-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white lg:hidden">
                      <img src="/gambar/garis3.png" alt="Menu"
                          class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
                  </button>
                  <div>
                      <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Dashboard</h1>
                      <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">Halo, ATK Corner!
                          Selamat datang
                          di website Equogreen</p>
                  </div>
              </div>

              <!-- Profile Section -->
              <div class="flex items-center gap-3">
                  <!-- Notification Bell -->
                  <button
                      class="hover:border-primary flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 bg-[#f0f5ff] shadow-sm transition-all duration-200">
                      <img src="/gambar/bell-black.png" alt="Notifikasi" class="h-6 w-6 object-contain" />
                  </button>

                  <!-- Profile -->

                  <a href="{{ route('profile_procurement') }}">
                      <img src="/gambar/profileup.png" alt="Profil">
                  </a>
                  <span class="hidden text-[17px] font-medium text-gray-700 md:block">Procurement</span>
              </div>
          </header>

          <!-- Announcement Banner (clickable) -->
          <section id="banner-pengumuman"
              class="flex cursor-pointer flex-col items-start justify-between gap-4 rounded-2xl border border-black bg-[#4039c9] px-6 py-5 shadow-md transition-all duration-200 hover:scale-[1.01] hover:shadow-lg active:scale-[0.995] md:flex-row md:items-center md:px-8 md:py-6">
              <div class="flex-1">
                  <p class="mb-1 text-sm font-bold uppercase tracking-widest text-white/70">PENGUMUMAN</p>
                  <h2 class="mb-2 text-xl font-bold text-white lg:text-2xl">Buat pengumuman untuk vendor</h2>
                  <p class="text-sm text-white/80 lg:text-base">Pastikan spesifikasi barang dan tenggat waktu sudah
                      sesuai</p>
              </div>
              <!-- Decorative icon area -->
              <div
                  class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-full bg-[#2d4ddd]/65 md:h-20 md:w-20">
                  <img src="/gambar/pengumuman.png" alt="banner icon"
                      class="h-10 w-10 rounded-full object-cover md:h-12 md:w-12" />
              </div>
          </section>

          <!-- Kategori Section -->
          <section class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
              <h2 class="mb-6 text-xl font-bold text-gray-800">Kategori</h2>

              <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 md:gap-4 lg:grid-cols-4">
                  @php
                      $categories = [
                          'ATK',
                          'Perangkat Lunak',
                          'APD',
                          'Generator Set',
                          'Elektronik',
                          'Pantry',
                          'Kemasan',
                          'Plumbing Set',
                          'Furniture',
                          'Alat Komunikasi',
                          'Peralatan Lab',
                          'Papan Informasi',
                          'Kesehatan',
                          'Suku Cadang',
                          'Keamanan Fisik',
                          'Kendaraan Logistik',
                          'Mesin Produksi',
                          'Bahan Penolong',
                          'Pemadam Api',
                          'K. Operasional',
                          'Perangkat IT',
                          'Bahan Baku Utama',
                          'Perangkat Listrik',
                          'Seragam Karyawan',
                      ];
                  @endphp

                  @foreach ($categories as $category)
                      <button type="button" onclick="toggleCategory(this)"
                          class="category-btn hover:border-primary hover:bg-primary/5 group flex items-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-left text-[15px] font-medium text-gray-700 transition-all duration-200 hover:shadow-sm">
                          <span class="truncate">{{ $category }}</span>
                      </button>
                  @endforeach
              </div>
          </section>

          <!-- Action Buttons -->
          <div class="flex flex-col gap-4 sm:flex-row">
              <button id="btn-pengaturan-waktu"
                  class="bg-accent flex-1 rounded-2xl px-6 py-3 text-base font-bold text-white shadow transition-all duration-200 hover:bg-[#0023cc] hover:shadow-lg active:scale-95 md:py-4 md:text-lg">
                  Pengaturan Waktu
              </button>
              <button
                  class="bg-accent flex-1 rounded-2xl px-6 py-3 text-base font-bold text-white shadow transition-all duration-200 hover:bg-[#0023cc] hover:shadow-lg active:scale-95 md:py-4 md:text-lg">
                  Kirim
              </button>
          </div>


      </main>

      <!-- ========== MODAL: Pengumuman ========== -->
      <div id="pengumuman-modal"
          class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 p-4 backdrop-blur-sm">

          <!-- Modal Content -->
          <div
              class="mx-auto flex w-full max-w-lg animate-[modalSlideUp_0.25s_ease-out] flex-col gap-5 rounded-2xl bg-[#eef0f5] p-5 shadow-2xl md:p-7">
              <!-- Header: Title + Action Buttons -->
              <div class="flex items-center justify-between gap-4">
                  <h2 class="text-2xl font-bold text-gray-900">Pengumuman</h2>
                  <div class="flex flex-shrink-0 items-center gap-2">
                      <!-- Edit Button -->
                      <button id="btn-edit-pengumuman"
                          class="hover:border-primary hover:text-primary inline-flex items-center gap-2 rounded-lg border-2 border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-700 shadow-sm transition-all duration-200">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                          </svg>
                          Edit
                      </button>
                      <!-- Hapus Button (Icon Only) -->
                      <button id="btn-hapus-pengumuman"
                          class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#1f2937] text-white shadow-sm transition-all duration-200 hover:bg-gray-800">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2">
                              <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                          </svg>
                      </button>
                      <!-- Close (X) Button -->
                      <button id="close-pengumuman-modal"
                          class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#ef4444] text-xl font-bold text-white shadow-sm transition-all duration-200 hover:bg-red-600 active:scale-90">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                              stroke="currentColor" stroke-width="2.5">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                      </button>
                  </div>
              </div>

              <!-- Textarea -->
              <textarea id="pengumuman-text" rows="10" disabled
                  class="focus:border-primary focus:ring-primary/20 w-full resize-none rounded-xl border border-gray-200 bg-white p-5 text-sm text-gray-700 outline-none transition-all duration-200 placeholder:text-gray-400 focus:ring-2 disabled:cursor-default disabled:opacity-60"
                  placeholder="Buatlah pengumuman untuk vendor"></textarea>

          </div>
      </div>

      <!-- ========== MODAL: Pengaturan Waktu ========== -->
      <div id="waktu-modal"
          class="fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 p-4 backdrop-blur-sm">

          <!-- Modal Content -->
          <div
              class="mx-auto w-full max-w-xl animate-[modalSlideUp_0.25s_ease-out] overflow-hidden rounded-[32px] bg-[#f0f5ff] shadow-2xl">

              <!-- Header -->
              <div class="flex items-center justify-between border-b border-gray-100 bg-white px-8 py-6">
                  <div>
                      <h2 class="text-2xl font-extrabold tracking-tight text-gray-900">Pengaturan Waktu</h2>
                      <p class="mt-0.5 text-base font-medium text-gray-500">Atur tenggat waktu pengumumuman</p>
                  </div>
                  <button id="close-waktu-modal"
                      class="flex h-12 w-12 items-center justify-center rounded-xl bg-[#ff4d4d] shadow-sm transition-all duration-200 hover:bg-red-600 active:scale-90">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none"
                          viewBox="0 0 24 24" stroke="currentColor" stroke-width="3.5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                  </button>
              </div>

              <!-- Body -->
              <div class="flex flex-col gap-5 p-8">

                  <!-- Row 1: Time -->
                  <div class="bg-primary flex items-center gap-6 rounded-2xl p-5">
                      <div class="flex flex-shrink-0 items-center justify-center border-r border-white/20 pr-6">
                          <svg width="42" height="42" viewBox="0 0 24 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <circle cx="12" cy="12" r="9" stroke="white" stroke-width="1.5" />
                              <path d="M12 7V12L15 13.5" stroke="white" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round" />
                              <circle cx="18.5" cy="18.5" r="4" fill="#4039c9" stroke="white"
                                  stroke-width="1.5" />
                              <path d="M18.5 17V18.5M18.5 20H18.51" stroke="white" stroke-width="2"
                                  stroke-linecap="round" />
                          </svg>
                      </div>
                      <div class="grid flex-1 grid-cols-2 gap-6">
                          <div class="flex flex-col gap-1.5">
                              <label class="ml-1 text-sm font-bold text-white">Start</label>
                              <input type="time"
                                  class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none"
                                  placeholder="--:--">
                          </div>
                          <div class="flex flex-col gap-1.5">
                              <label class="ml-1 text-sm font-bold text-white">End</label>
                              <input type="time"
                                  class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none"
                                  placeholder="--:--">
                          </div>
                      </div>
                  </div>

                  <!-- Row 2: Date -->
                  <div class="bg-primary flex items-center gap-6 rounded-2xl p-5">
                      <div class="flex flex-shrink-0 items-center justify-center border-r border-white/20 pr-6">
                          <svg width="42" height="42" viewBox="0 0 24 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M8 2V5M16 2V5M3 8.5H21M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                  stroke="white" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round" />
                              <circle cx="18.5" cy="18.5" r="4" fill="#4039c9" stroke="white"
                                  stroke-width="1.5" />
                              <circle cx="18.5" cy="18.5" r="2" stroke="white" stroke-width="1" />
                              <path d="M18.5 17.5V18.5L19.5 19" stroke="white" stroke-width="1"
                                  stroke-linecap="round" />
                          </svg>
                      </div>
                      <div class="grid flex-1 grid-cols-2 gap-6">
                          <div class="flex flex-col gap-1.5">
                              <label class="ml-1 text-sm font-bold text-white">Start</label>
                              <input type="date"
                                  class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none"
                                  placeholder="DD/MM/YYYY">
                          </div>
                          <div class="flex flex-col gap-1.5">
                              <label class="ml-1 text-sm font-bold text-white">End</label>
                              <input type="date"
                                  class="w-full rounded-xl bg-white px-4 py-2.5 text-gray-700 shadow-inner outline-none"
                                  placeholder="DD/MM/YYYY">
                          </div>
                      </div>
                  </div>

                  <!-- Submit Button -->
                  <button id="save-waktu-modal"
                      class="bg-accent mt-2 w-full rounded-xl py-4 text-lg font-bold text-white shadow-lg transition-all duration-200 hover:bg-blue-700 active:scale-[0.98]">
                      Simpan
                  </button>

              </div>
          </div>
      </div>

      <!-- ========== TOAST NOTIFICATION ========== -->
      <div id="toast"
          class="bg-primary pointer-events-none fixed bottom-6 right-6 z-[60] flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-bold text-white opacity-0 shadow-lg transition-all duration-300">
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
              editBtn.innerHTML =
                  `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
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
                  editBtn.innerHTML =
                      `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
                  editBtn.classList.remove('border-primary', 'text-primary');
                  showToast('Pengumuman berhasil disimpan!');
              } else {
                  // Enter edit mode
                  textarea.disabled = false;
                  textarea.focus();
                  editBtn.innerHTML =
                      `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg> Simpan`;
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
              editBtn.innerHTML =
                  `<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg> Edit`;
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
