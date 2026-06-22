<!DOCTYPE html>
<html lang="id">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta charset="utf-8" />
  <title>Validasi Vendor - Equogreen</title>
  <script src="https://cdn.tailwindcss.com"></script>
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

      <!-- Daftar Vendor -->
      <a href="{{ route('procurement-notifikasi') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Daftar Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>

      <!-- Validasi Vendor (ACTIVE) -->
      <a href="{{ route('procurement-validasi-vendor') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
        <img src="/gambar/validasi.png" alt="Validasi Vendor"
          class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
        Validasi Vendor
      </a>
      <div class="border-b border-gray-100 my-1"></div>


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
          <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Validasi Pendaftaran Vendor</h1>
          <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Periksa dan setujui akses vendor
            baru</p>
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

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 text-[14px] rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Vendor Table -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
      <table class="w-full border-collapse" id="vendor-table">
        <thead>
          <tr class="bg-[#002eff] text-white">
            <th class="px-5 py-3.5 text-left text-sm font-semibold border-r border-white/20 w-[22%]">Nama Vendor</th>
            <th class="px-5 py-3.5 text-left text-sm font-semibold border-r border-white/20 w-[18%]">Kategori</th>
            <th class="px-5 py-3.5 text-center text-sm font-semibold border-r border-white/20 w-[20%]">Tanggal Daftar
            </th>
            <th class="px-5 py-3.5 text-center text-sm font-semibold border-r border-white/20 w-[18%]">Portofolio</th>
            <th class="px-5 py-3.5 text-center text-sm font-semibold w-[22%]">Aksi</th>
          </tr>
        </thead>
        <tbody id="table-body">
        @forelse ($vendors as $vendor)
<tr class="border-b border-gray-100 hover:bg-[#f8f9ff] transition-colors duration-150">
    <td class="px-5 py-4 text-sm font-medium text-gray-800 border-r border-gray-100">
        {{ $vendor->nama_perusahaan }}
    </td>

    <td class="px-5 py-4 text-sm text-gray-600 border-r border-gray-100">
        {{ $vendor->kategori_vendor }}
    </td>

    <td class="px-5 py-4 text-sm text-gray-600 text-center border-r border-gray-100">
        {{ \Carbon\Carbon::parse($vendor->created_at)->format('d M Y') }}
    </td>

<td class="px-5 py-4 text-center border-r border-gray-100">
    <a href="{{ asset('storage/portofolio/' . $vendor->portofolio) }}"       
       target="_blank"
       class="text-accent font-semibold text-sm underline underline-offset-2 hover:text-primary transition-colors">

        Lihat
    </a>
</td>

    <td class="px-5 py-4">
        <div class="flex items-center justify-center gap-3">

            <form action="{{ route('approve.vendor', $vendor->id_vendor) }}" method="POST" class="inline">
                @csrf
                <button type="submit"
                    class="btn-approve w-9 h-9 rounded-lg bg-green-50 hover:bg-green-100 text-green-500 hover:text-green-600 flex items-center justify-center transition-all duration-200"
                    title="Setujui {{ $vendor->nama_perusahaan }}">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2.5">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7"/>
                    </svg>
                </button>
            </form>

            <form action="{{ route('reject.vendor', $vendor->id_vendor) }}" method="POST" class="inline">
                @csrf

                <button type="submit"
                    class="btn-reject w-9 h-9 rounded-lg bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-600 flex items-center justify-center transition-all duration-200 text-lg font-bold"
                    title="Tolak {{ $vendor->nama_perusahaan }}">

                    ✕
                </button>

            </form>
            

        </div>
    </td>
</tr>

@empty
<tr>
    <td colspan="5" class="text-center py-4">
        Tidak ada data
    </td>
</tr>
@endforelse
        </tbody>
      </table>
    </div>

  </main>

  <div id="portofolio-modal" class="fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm hidden">
    <div class="animate-modal-slide-up bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 p-7 flex flex-col gap-4">
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-gray-900">Portofolio Vendor</h2>
        <button id="close-portofolio-modal"
          class="w-9 h-9 rounded-lg bg-red-500 text-white flex items-center justify-center hover:bg-red-600 active:scale-90 transition-all duration-200 text-lg font-bold">
          ✕
        </button>
      </div>
      <hr class="border-gray-100" />
      <div class="flex items-center gap-4">
        <div
          class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xl"
          id="modal-avatar">A</div>
        <div>
          <p class="font-bold text-gray-800 text-lg" id="modal-nama">—</p>
          <span class="inline-block px-3 py-0.5 rounded-full bg-primary/10 text-primary text-xs font-semibold mt-1"
            id="modal-kategori">—</span>
        </div>
      </div>
      <div class="grid grid-cols-2 gap-3">
        <div class="bg-gray-50 rounded-lg p-3">
          <p class="text-xs text-gray-400 mb-0.5">Email</p>
          <p class="text-sm font-semibold text-gray-700" id="modal-email">—</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-3">
          <p class="text-xs text-gray-400 mb-0.5">Telepon</p>
          <p class="text-sm font-semibold text-gray-700" id="modal-phone">—</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-3">
          <p class="text-xs text-gray-400 mb-0.5">Tanggal Daftar</p>
          <p class="text-sm font-semibold text-gray-700" id="modal-tanggal">—</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-3">
          <p class="text-xs text-gray-400 mb-0.5">NPWP</p>
          <p class="text-sm font-semibold text-gray-700" id="modal-npwp">—</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-3 col-span-2">
          <p class="text-xs text-gray-400 mb-0.5">Alamat</p>
          <p class="text-sm font-semibold text-gray-700" id="modal-alamat">—</p>
        </div>
        <div class="bg-gray-50 rounded-lg p-3 col-span-2">
          <p class="text-xs text-gray-400 mb-0.5">Deskripsi</p>
          <p class="text-sm text-gray-600" id="modal-desc">—</p>
        </div>
      </div>
    </div>
  </div>

  <!-- ========== MODAL: Konfirmasi Aksi ========== -->
  <div id="confirm-modal" class="fixed inset-0 z-50 items-center justify-center bg-black/40 backdrop-blur-sm hidden">
    <div
      class="animate-modal-slide-up bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 p-7 flex flex-col gap-4 text-center">
      <div class="w-16 h-16 rounded-full mx-auto flex items-center justify-center text-3xl" id="confirm-icon-wrap">
        <span id="confirm-icon">✓</span>
      </div>
      <h2 class="text-lg font-bold text-gray-900" id="confirm-title">Setujui Vendor?</h2>
      <p class="text-sm text-gray-500" id="confirm-desc">Vendor <strong id="confirm-vendor-name">—</strong> akan
        disetujui aksesnya.</p>
      <div class="flex gap-3 mt-1">
        <button id="confirm-cancel"
          class="flex-1 py-2.5 rounded-xl border-2 border-gray-300 text-gray-700 font-bold text-sm hover:bg-gray-50 transition-all duration-200">
          Batal
        </button>
        <button id="confirm-ok"
          class="flex-1 py-2.5 rounded-xl text-white font-bold text-sm transition-all duration-200">
          Konfirmasi
        </button>
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
    // ---- Elements ----
    const tableBody = document.getElementById('table-body');

    // Portofolio modal
    const portofolioModal = document.getElementById('portofolio-modal');
    const closePortofolioModal = document.getElementById('close-portofolio-modal');

    // Confirm modal
    const confirmModal = document.getElementById('confirm-modal');
    const confirmCancel = document.getElementById('confirm-cancel');
    const confirmOk = document.getElementById('confirm-ok');

    let pendingAction = null; // { type: 'approve'|'reject', index: number }

    

    // =============================================
    // PORTOFOLIO MODAL
    // =============================================
    function openPortofolio(index) {
      const v = VENDORS[index];
      document.getElementById('modal-avatar').textContent = v.nama.charAt(0);
      document.getElementById('modal-nama').textContent = v.nama;
      document.getElementById('modal-kategori').textContent = v.kategori;
      document.getElementById('modal-email').textContent = v.email;
      document.getElementById('modal-phone').textContent = v.phone;
      document.getElementById('modal-tanggal').textContent = v.tanggal;
      document.getElementById('modal-npwp').textContent = v.npwp;
      document.getElementById('modal-alamat').textContent = v.alamat;
      document.getElementById('modal-desc').textContent = v.desc;
      portofolioModal.classList.remove('hidden');
      portofolioModal.classList.add('flex');
    }

    closePortofolioModal.addEventListener('click', () => {
      portofolioModal.classList.add('hidden');
      portofolioModal.classList.remove('flex');
    });
    portofolioModal.addEventListener('click', (e) => {
      if (e.target === portofolioModal) {
        portofolioModal.classList.add('hidden');
        portofolioModal.classList.remove('flex');
      }
    });

    // =============================================
    // CONFIRM MODAL (Setuju / Tolak)
    // =============================================
    function openConfirm(type, index) {
      const v = VENDORS[index];
      pendingAction = {
        type,
        index
      };

      const iconWrap = document.getElementById('confirm-icon-wrap');
      const icon = document.getElementById('confirm-icon');
      const title = document.getElementById('confirm-title');
      const desc = document.getElementById('confirm-desc');
      const okBtn = document.getElementById('confirm-ok');
      const vendorName = document.getElementById('confirm-vendor-name');

      vendorName.textContent = v.nama;

      if (type === 'approve') {
        iconWrap.className = 'w-16 h-16 rounded-full mx-auto flex items-center justify-center text-3xl bg-green-50 text-green-500';
        icon.textContent = '✓';
        title.textContent = 'Setujui Vendor?';
        desc.innerHTML = `Vendor <strong>${v.nama}</strong> akan disetujui dan mendapatkan akses.`;
        okBtn.className = 'flex-1 py-2.5 rounded-xl text-white font-bold text-sm transition-all duration-200 bg-green-500 hover:bg-green-600';
      } else {
        iconWrap.className = 'w-16 h-16 rounded-full mx-auto flex items-center justify-center text-3xl bg-red-50 text-red-500';
        icon.textContent = '✕';
        title.textContent = 'Tolak Vendor?';
        desc.innerHTML = `Vendor <strong>${v.nama}</strong> akan ditolak pendaftarannya.`;
        okBtn.className = 'flex-1 py-2.5 rounded-xl text-white font-bold text-sm transition-all duration-200 bg-red-500 hover:bg-red-600';
      }

      confirmModal.classList.remove('hidden');
      confirmModal.classList.add('flex');
    }

    confirmCancel.addEventListener('click', () => {
      confirmModal.classList.add('hidden');
      confirmModal.classList.remove('flex');
      pendingAction = null;
    });
    confirmModal.addEventListener('click', (e) => {
      if (e.target === confirmModal) {
        confirmModal.classList.add('hidden');
        confirmModal.classList.remove('flex');
        pendingAction = null;
      }
    });

    confirmOk.addEventListener('click', () => {
      if (!pendingAction) return;
      const {
        type,
        index
      } = pendingAction;
      const vendorNama = VENDORS[index].nama;

      // Hapus vendor dari array
      VENDORS.splice(index, 1);
      confirmModal.classList.add('hidden');
      confirmModal.classList.remove('flex');
      pendingAction = null;

      // Re-render table
      renderTable();

      if (type === 'approve') {
        showToast(`${vendorNama} berhasil disetujui!`);
      } else {
        showToast(`${vendorNama} berhasil ditolak.`);
      }
    });

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
