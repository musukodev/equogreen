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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
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
                <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Daftar Vendor
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Validasi Vendor (ACTIVE) -->
            <a href="{{ route('procurement-validasi-vendor') }}"
                class="text-primary hover:bg-primary group flex items-center gap-3 rounded-xl bg-[#eef3ff] px-4 py-3 text-[17px] font-bold text-gray-700 transition-all duration-200 hover:text-white">
                <img src="/gambar/validasi.png" alt="Validasi Vendor"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Validasi Vendor
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Riwayat PO -->
            <a href="{{ route('procurement-riwayat-po') }}"
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                <img src="/gambar/riwayat.png" alt="Riwayat PO"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Riwayat PO
            </a>
            <div class="my-1 border-b border-gray-100"></div>


        </nav>

        <!-- Logout -->
        <div class="border-t border-gray-100 px-4 pb-8 pt-4">
            <a href="#"
                class="group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-red-500 transition-all duration-200 hover:bg-red-50">
                <img src="/gambar/logout.png" alt="Logout" class="h-7 w-7 object-contain" />
                Logout
            </a>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex h-full min-w-0 flex-1 flex-col gap-6 overflow-y-auto p-6 lg:p-8">

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
                    <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Validasi Pendaftaran Vendor</h1>
                    <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">Periksa dan setujui
                        akses vendor
                        baru</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
            </button>
                <a href="{{ route('profile_procurement') }}"> <img src="/gambar/profileup.png" alt="Profil"
                        class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" /></a>
                <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
                <span class="hidden text-[17px] font-medium text-gray-700 md:block">Procurement</span>
            </div>
        </header>

        @if (session('success'))
            <div class="mb-4 rounded-xl border border-green-400 bg-green-100 p-3 text-[14px] text-green-700 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Vendor Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="w-full border-collapse" id="vendor-table">
                <thead>
                    <tr class="bg-[#002eff] text-white">
                        <th class="w-[22%] border-r border-white/20 px-5 py-3.5 text-left text-sm font-semibold">Nama
                            Vendor</th>
                        <th class="w-[18%] border-r border-white/20 px-5 py-3.5 text-left text-sm font-semibold">
                            Kategori</th>
                        <th class="w-[20%] border-r border-white/20 px-5 py-3.5 text-center text-sm font-semibold">
                            Tanggal Daftar
                        </th>
                        <th class="w-[18%] border-r border-white/20 px-5 py-3.5 text-center text-sm font-semibold">
                            Portofolio</th>
                        <th class="w-[22%] px-5 py-3.5 text-center text-sm font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    @forelse ($vendors as $vendor)
                        <tr class="border-b border-gray-100 transition-colors duration-150 hover:bg-[#f8f9ff]">
                            <td class="border-r border-gray-100 px-5 py-4 text-sm font-medium text-gray-800">
                                {{ $vendor->nama_perusahaan }}
                            </td>

                            <td class="border-r border-gray-100 px-5 py-4 text-sm text-gray-600">
                                {{ $vendor->kategori_vendor }}
                            </td>

                            <td class="border-r border-gray-100 px-5 py-4 text-center text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($vendor->created_at)->format('d M Y') }}
                            </td>

                            <td class="border-r border-gray-100 px-5 py-4 text-center">
                                <a href="{{ asset('storage/portofolio/' . $vendor->portofolio) }}" target="_blank"
                                    class="text-accent hover:text-primary text-sm font-semibold underline underline-offset-2 transition-colors">

                                    Lihat
                                </a>
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-3">

                                    <form action="{{ route('approve.vendor', $vendor->id_vendor) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn-approve flex h-9 w-9 items-center justify-center rounded-lg bg-green-50 text-green-500 transition-all duration-200 hover:bg-green-100 hover:text-green-600"
                                            title="Setujui {{ $vendor->nama_perusahaan }}">

                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">

                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('reject.vendor', $vendor->id_vendor) }}" method="POST"
                                        class="inline">
                                        @csrf

                                        <button type="submit"
                                            class="btn-reject flex h-9 w-9 items-center justify-center rounded-lg bg-red-50 text-lg font-bold text-red-500 transition-all duration-200 hover:bg-red-100 hover:text-red-600"
                                            title="Tolak {{ $vendor->nama_perusahaan }}">

                                            ✕
                                        </button>

                                    </form>


                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

    <div id="portofolio-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div
            class="animate-modal-slide-up mx-4 flex w-full max-w-lg flex-col gap-4 rounded-2xl bg-white p-7 shadow-2xl">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Portofolio Vendor</h2>
                <button id="close-portofolio-modal"
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-500 text-lg font-bold text-white transition-all duration-200 hover:bg-red-600 active:scale-90">
                    ✕
                </button>
            </div>
            <hr class="border-gray-100" />
            <div class="flex items-center gap-4">
                <div class="bg-primary/10 text-primary flex h-14 w-14 items-center justify-center rounded-full text-xl font-bold"
                    id="modal-avatar">A</div>
                <div>
                    <p class="text-lg font-bold text-gray-800" id="modal-nama">—</p>
                    <span
                        class="bg-primary/10 text-primary mt-1 inline-block rounded-full px-3 py-0.5 text-xs font-semibold"
                        id="modal-kategori">—</span>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-lg bg-gray-50 p-3">
                    <p class="mb-0.5 text-xs text-gray-400">Email</p>
                    <p class="text-sm font-semibold text-gray-700" id="modal-email">—</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-3">
                    <p class="mb-0.5 text-xs text-gray-400">Telepon</p>
                    <p class="text-sm font-semibold text-gray-700" id="modal-phone">—</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-3">
                    <p class="mb-0.5 text-xs text-gray-400">Tanggal Daftar</p>
                    <p class="text-sm font-semibold text-gray-700" id="modal-tanggal">—</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-3">
                    <p class="mb-0.5 text-xs text-gray-400">NPWP</p>
                    <p class="text-sm font-semibold text-gray-700" id="modal-npwp">—</p>
                </div>
                <div class="col-span-2 rounded-lg bg-gray-50 p-3">
                    <p class="mb-0.5 text-xs text-gray-400">Alamat</p>
                    <p class="text-sm font-semibold text-gray-700" id="modal-alamat">—</p>
                </div>
                <div class="col-span-2 rounded-lg bg-gray-50 p-3">
                    <p class="mb-0.5 text-xs text-gray-400">Deskripsi</p>
                    <p class="text-sm text-gray-600" id="modal-desc">—</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== MODAL: Konfirmasi Aksi ========== -->
    <div id="confirm-modal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div
            class="animate-modal-slide-up mx-4 flex w-full max-w-sm flex-col gap-4 rounded-2xl bg-white p-7 text-center shadow-2xl">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full text-3xl"
                id="confirm-icon-wrap">
                <span id="confirm-icon">✓</span>
            </div>
            <h2 class="text-lg font-bold text-gray-900" id="confirm-title">Setujui Vendor?</h2>
            <p class="text-sm text-gray-500" id="confirm-desc">Vendor <strong id="confirm-vendor-name">—</strong>
                akan
                disetujui aksesnya.</p>
            <div class="mt-1 flex gap-3">
                <button id="confirm-cancel"
                    class="flex-1 rounded-xl border-2 border-gray-300 py-2.5 text-sm font-bold text-gray-700 transition-all duration-200 hover:bg-gray-50">
                    Batal
                </button>
                <button id="confirm-ok"
                    class="flex-1 rounded-xl py-2.5 text-sm font-bold text-white transition-all duration-200">
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>

    <!-- ========== TOAST ========== -->
    <div id="toast"
        class="bg-primary pointer-events-none fixed bottom-6 right-6 z-[60] flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-bold text-white opacity-0 shadow-lg transition-all duration-300">
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
                iconWrap.className =
                    'w-16 h-16 rounded-full mx-auto flex items-center justify-center text-3xl bg-green-50 text-green-500';
                icon.textContent = '✓';
                title.textContent = 'Setujui Vendor?';
                desc.innerHTML = `Vendor <strong>${v.nama}</strong> akan disetujui dan mendapatkan akses.`;
                okBtn.className =
                    'flex-1 py-2.5 rounded-xl text-white font-bold text-sm transition-all duration-200 bg-green-500 hover:bg-green-600';
            } else {
                iconWrap.className =
                    'w-16 h-16 rounded-full mx-auto flex items-center justify-center text-3xl bg-red-50 text-red-500';
                icon.textContent = '✕';
                title.textContent = 'Tolak Vendor?';
                desc.innerHTML = `Vendor <strong>${v.nama}</strong> akan ditolak pendaftarannya.`;
                okBtn.className =
                    'flex-1 py-2.5 rounded-xl text-white font-bold text-sm transition-all duration-200 bg-red-500 hover:bg-red-600';
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
