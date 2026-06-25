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
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
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

            <!-- Daftar Vendor (ACTIVE) -->
            <a href="{{ route('procurement-notifikasi') }}"
                class="text-primary hover:bg-primary group flex items-center gap-3 rounded-xl bg-[#eef3ff] px-4 py-3 text-[17px] font-bold text-gray-700 transition-all duration-200 hover:text-white">
                <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
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

            <!-- Riwayat PO -->
            <a href="{{ route('procurement-riwayat-po') }}"
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                <img src="/gambar/riwayat.png" alt="Riwayat PO"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Riwayat PO
            </a>
            <div class="my-1 border-b border-gray-100"></div>

            <!-- Pengaturan -->


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
                    <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Daftar Vendor</h1>
                    <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">Kelola dan lihat
                        informasi seluruh vendor yang terdaftar</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                <button
                    class="hover:bg-primary hover:border-primary group flex h-12 w-12 items-center justify-center rounded-full border border-gray-200 bg-[#f0f5ff] transition-all duration-200">
                    <img src="/gambar/bell-black.png" alt="Notifikasi"
                        class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <a href="{{ route('profile_procurement') }}"> <img src="/gambar/profileup.png" alt="Profil"
                        class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" /></a>
                <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
                <span class="hidden text-[17px] font-medium text-gray-700 md:block">Procurement</span>
            </div>
        </header>

        <!-- Filter Bar: Kategori Dropdown + Search -->
        <div class="flex flex-col items-center gap-4 md:flex-row">
            <!-- Kategori Dropdown -->
            <div class="relative w-full md:w-48">
                <select id="filter-kategori"
                    class="focus:border-primary focus:ring-primary/20 w-full cursor-pointer appearance-none rounded-xl border border-gray-800 bg-white px-4 py-3 pr-10 text-sm font-medium text-gray-800 outline-none transition-all duration-200 focus:ring-2">
                    <option value="semua">Kategori</option>
                    <option value="atk">ATK</option>
                    <option value="elektronik">Elektronik</option>
                    <option value="furniture">Furniture</option>
                    <option value="cleaning">Cleaning Supply</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
            </div>
            <!-- Search Input -->
            <div class="relative w-full md:flex-1">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input id="search-input" type="text" placeholder="Search"
                    class="focus:border-primary focus:ring-primary/20 w-full rounded-xl border border-gray-800 bg-white py-3 pl-12 pr-4 text-sm text-gray-700 outline-none transition-all duration-200 focus:ring-2" />
            </div>
        </div>

        <!-- Vendor Notification Table -->
        <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
            <table class="w-full border-collapse" id="notif-table">
                <thead>
                    <tr class="border-b border-gray-200 bg-blue-600">
                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-white md:px-5 md:text-sm">Nama
                            Vendor</th>
                        <th class="px-3 py-3.5 text-left text-xs font-semibold text-white md:px-5 md:text-sm">Kategori
                        </th>
                        <th class="px-3 py-3.5 text-center text-xs font-semibold text-white md:px-5 md:text-sm">Profile
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vendors as $vendor)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="px-3 py-3.5 text-sm text-gray-700 md:px-5">{{ $vendor->nama_perusahaan }}</td>
                            <td class="px-3 py-3.5 text-sm text-gray-700 md:px-5">{{ $vendor->kategori_vendor }}</td>
                            <td class="px-3 py-3.5 text-center md:px-5">
                                <button
                                    class="btn-profile text-accent hover:text-primary text-sm font-semibold underline underline-offset-2 transition-colors"
                                    data-nama="{{ $vendor->nama_perusahaan }}"
                                    data-kategori="{{ $vendor->kategori_vendor }}"
                                    data-email="{{ $vendor->email_perusahaan }}" data-phone="{{ $vendor->no_hp }}"
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
    <div id="profile-modal"
        class="animate-fade-in fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div
            class="animate-modal-slide-up mx-4 flex w-full max-w-md flex-col gap-4 rounded-2xl bg-white p-7 shadow-2xl">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Profil Vendor</h2>
                <button id="close-profile-modal"
                    class="flex h-9 w-9 items-center justify-center rounded-lg bg-red-500 text-lg font-bold text-white transition-all duration-200 hover:bg-red-600 active:scale-90">
                    ✕
                </button>
            </div>
            <hr class="border-gray-100" />
            <!-- Vendor Info -->
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-4">
                    <div class="bg-primary/10 text-primary flex h-14 w-14 items-center justify-center rounded-full text-xl font-bold"
                        id="modal-avatar">E</div>
                    <div>
                        <p class="text-lg font-bold text-gray-800" id="modal-vendor-name">—</p>
                        <span
                            class="bg-primary/10 text-primary mt-1 inline-block rounded-full px-3 py-0.5 text-xs font-semibold"
                            id="modal-vendor-kategori">—</span>
                    </div>
                </div>
                <div class="mt-2 grid grid-cols-2 gap-3">
                    <div class="rounded-lg bg-gray-50 p-3">
                        <p class="mb-0.5 text-xs text-gray-400">Email</p>
                        <p class="break-all text-sm font-semibold text-gray-700" id="modal-vendor-email"></p>
                    </div>
                    <div class="rounded-lg bg-gray-50 p-3">
                        <p class="mb-0.5 text-xs text-gray-400">Telepon</p>
                        <p class="text-sm font-semibold text-gray-700" id="modal-vendor-phone"></p>
                    </div>
                    <div class="col-span-2 rounded-lg bg-gray-50 p-3">
                        <p class="mb-0.5 text-xs text-gray-400">Alamat</p>
                        <p class="text-sm font-semibold text-gray-700" id="modal-vendor-alamat"></p>
                    </div>
                </div>
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
        const profileModal = document.getElementById('profile-modal');
        const emailModal = document.getElementById('email-modal');

        // Logic Modal Profile
        document.querySelectorAll('.btn-profile').forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('modal-avatar').textContent = this.dataset.nama ? this.dataset.nama
                    .charAt(0) : 'V';
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
