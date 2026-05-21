<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Vendor - Equogreen</title>
    <!-- Using Tailwind CSS via CDN -->
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="flex h-screen overflow-hidden antialiased text-gray-800 bg-brand-bg font-sans">

    <!-- ===== SIDEBAR ===== -->
    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 w-[280px] min-h-screen bg-white flex-shrink-0 flex flex-col shadow-md">
        <!-- Logo -->
        <div class="flex items-center gap-3 px-6 pt-8 pb-6 border-b border-gray-100">
            <img src="gambar/logo.png" alt="Logo Equogreen" class="w-14 h-14 rounded-full object-cover" />
            <span class="text-2xl font-bold text-gray-800">Equogreen</span>
        </div>

        <nav class="flex-1 px-4 py-6 flex flex-col gap-1">
            <a href="{{ route('vendor-dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/dashboard layout.png" alt="Dashboard"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Dashboard
            </a>
            <div class="border-b border-gray-100 my-1"></div>
            <a href="{{ route('vendor-riwayat') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/riwayat.png" alt="Riwayat"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Riwayat
            </a>
            <div class="border-b border-gray-100 my-1"></div>
           
        </nav>

        <!-- Logout -->
        <div class="px-4 pb-8 border-t border-gray-100 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
                    <img src="gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto w-full">

        <!-- Top Header -->
        <header class="flex items-center justify-between p-4 md:p-6 lg:px-8 lg:pt-8 lg:pb-0">
            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger (Circle Style like Back Button) -->
                <button onclick="toggleSidebar()"
                    class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                    <img src="gambar/garis3.png" alt="Menu"
                        class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <div>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Dashboard</h1>
                    <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Kelola semua quotation
                        Anda dalam satu tempat</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <button
                    class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                    <img src="gambar/bell-black.png" alt="Notifikasi"
                        class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>

                <!-- Profile -->
                <img src="gambar/Profileup.png" alt="Profil"
                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <span class="hidden md:block font-medium text-gray-700 text-[17px]">Vendor</span>
            </div>
        </header>

        <!-- Main Workspace Padding Wrapper -->
        <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 pt-0 gap-2">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5 mb-4 mt-0">
                <!-- Card 1 -->
                <div
                    class="bg-white rounded-2xl p-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] flex items-center gap-4 border border-gray-100 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                    <div
                        class="w-[52px] h-[52px] rounded-xl bg-[#c5d5ca] flex items-center justify-center text-gray-600 transition-transform group-hover:rotate-3">
                        <i class="fa-solid fa-file-invoice text-2xl opacity-70"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-black leading-tight mb-0.5">2</h3>
                        <p class="text-gray-500 font-medium text-sm">Quotation aktif</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div
                    class="bg-white rounded-2xl p-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] flex items-center gap-4 border border-gray-100 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                    <div
                        class="w-[52px] h-[52px] rounded-xl bg-[#fce5be] flex items-center justify-center transition-transform group-hover:rotate-3">
                        <i class="fa-solid fa-hourglass-half text-2xl text-[#d97706] opacity-70"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-black leading-tight mb-0.5">0</h3>
                        <p class="text-gray-500 font-medium text-sm">Menunggu review</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div
                    class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] flex items-center gap-5 border border-gray-100 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                    <div
                        class="w-[52px] h-[52px] rounded-xl bg-[#f6b4b4] flex items-center justify-center transition-transform group-hover:rotate-3">
                        <i class="fa-solid fa-circle-check text-2xl text-[#dc2626] opacity-70"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-black leading-tight mb-0.5">1</h3>
                        <p class="text-gray-500 font-medium text-sm">Selesai</p>
                    </div>
                </div>
            </div>

            <!-- Pengumuman Card -->
            <div
                class="bg-[#4039c9] rounded-2xl p-6 md:p-7 lg:p-8 mb-4 text-white relative overflow-hidden shadow-lg min-h-[140px] md:min-h-[160px] flex items-center transition-all duration-300 hover:scale-[1.01] hover:shadow-xl cursor-pointer group">
                <div class="relative z-10 w-full md:w-3/4">
                    <p
                        class="text-[10px] md:text-[11px] font-black uppercase tracking-widest mb-2 md:mb-3 text-white/70">
                        PENGUMUMAN</p>
                    <h2 class="text-lg md:text-2xl lg:text-[30px] font-bold mb-3 md:mb-4 leading-tight tracking-tight">
                        Ketuk untuk melihat
                        Pengumuman<br class="hidden sm:block">Pengadaan Barang hari ini</h2>
                    <p class="text-white/80 text-xs md:text-sm lg:text-base font-medium">Pastikan semua dokumen
                        quotation telah
                        dilengkapi sebelum batas waktu</p>
                </div>
                <!-- Decorative Circles -->
                <div
                    class="hidden md:block absolute right-[-5%] top-[-10%] w-64 h-64 bg-white/5 rounded-full mix-blend-overlay">
                </div>
                <!-- Banner Icon Area -->
                <div
                    class="hidden md:flex absolute right-12 lg:right-20 top-1/2 transform -translate-y-1/2 w-24 h-24 lg:w-32 lg:h-32 bg-[#2d4ddd]/65 rounded-full items-center justify-center">
                    <img src="gambar/pengumuman.png" alt="Banner Icon" class="w-16 h-16 object-contain" />
                </div>
            </div>

            <!-- Daftar Quotation Header -->
            <div class="mb-3 mt-0">
                <div class="inline-flex items-center gap-3 bg-[#d7dfec] px-4 py-2.5 rounded-xl shadow-sm">
                    <div class="w-8 h-8 rounded-full border-[1.5px] border-black flex items-center justify-center">
                        <i class="fa-regular fa-file-lines text-black text-sm"></i>
                    </div>
                    <h2 class="text-lg font-bold text-black pr-2">Daftar Quotation</h2>
                </div>
            </div>

            <!-- Quotation Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5 pb-20">
                <!-- Item 1 -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-[1.01] hover:shadow-xl hover:border-gray-300 cursor-pointer">
                    <div class="h-[120px] bg-[#e4e9e5] flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-pen-nib text-[80px] text-[#609966] -rotate-12"></i>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-[15px] font-bold text-black mb-3 leading-tight tracking-tight mt-1">Pengadaan
                            Barang ATK</h3>

                        <div class="bg-[#faebca] border border-[#ecd5a0] rounded-md p-2.5 mb-4 shadow-sm w-full">
                            <p class="text-[9px] font-extrabold text-[#7a5712] mb-0.5 tracking-wider">BATAS WAKTU</p>
                            <p class="text-xs font-bold text-[#7a5712]">20 April 2026, 17.00 WIB</p>
                        </div>

                        <p id="timer1" class="text-[#d71919] font-extrabold text-[11px] mb-5"></p>
                        <a href="buat_quotation"
                            class="mt-auto block w-full bg-[#1e40ff] text-white text-center font-bold text-sm py-3 rounded-lg hover:bg-blue-700 transition">
                            Buka Quotation
                        </a>
                    </div>
                </div>

                <!-- Item 2 -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-[1.01] hover:shadow-xl hover:border-gray-300 cursor-pointer">
                    <div class="h-[120px] bg-[#fbf0dc] flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-couch text-[85px] text-[#e5b83b]"></i>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-[15px] font-bold text-black mb-3 leading-tight tracking-tight mt-1">Pengadaan
                            Barang Furniture</h3>

                        <div class="bg-[#faebca] border border-[#ecd5a0] rounded-md p-2.5 mb-4 shadow-sm w-full">
                            <p class="text-[9px] font-extrabold text-[#7a5712] mb-0.5 tracking-wider">BATAS WAKTU</p>
                            <p class="text-xs font-bold text-[#7a5712]">12 April 2026, 17.00 WIB</p>
                        </div>

                        <p id="timer2" class="text-[#d71919] font-extrabold text-[11px] mb-5"></p>
                        <a href="buat_quotation.html"
                            class="mt-auto block w-full bg-[#1e40ff] text-white text-center font-bold text-sm py-3 rounded-lg hover:bg-blue-700 transition">
                            Buka Quotation
                        </a>
                    </div>
                </div>

                <!-- Item 3 -->
                <div
                    class="bg-white rounded-2xl overflow-hidden shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-[1.01] hover:shadow-xl hover:border-gray-300 cursor-pointer">
                    <div class="h-[120px] bg-[#fbd4d4] flex items-center justify-center relative overflow-hidden">
                        <i class="fa-solid fa-mobile-screen text-[85px] text-[#ce3030]"></i>
                    </div>
                    <div class="p-5 flex flex-col flex-grow">
                        <h3 class="text-[15px] font-bold text-black mb-3 leading-tight tracking-tight mt-1">Pengadaan
                            Barang Elektronik</h3>

                        <div class="bg-[#faebca] border border-[#ecd5a0] rounded-md p-2.5 mb-4 shadow-sm w-full">
                            <p class="text-[9px] font-extrabold text-[#7a5712] mb-0.5 tracking-wider">BATAS WAKTU</p>
                            <p class="text-xs font-bold text-[#7a5712]">12 April 2026, 17.00 WIB</p>
                        </div>

                        <p class="text-[#d71919] font-extrabold text-[11px] mb-5">2d : 3h : 14m : 3s</p>

                        <a href="buat_quotation.html"
                            class="mt-auto block w-full bg-[#1e40ff] text-white text-center font-bold text-sm py-3 rounded-lg hover:bg-blue-700 transition">
                            Buka Quotation
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </div>
    <script>
        const timers = [
            { id: 'timer1', deadline: '2026-04-20T17:00:00' },
            { id: 'timer2', deadline: '2026-04-12T17:00:00' },
            { id: 'timer3', deadline: '2026-04-12T17:00:00' },
        ];

        function updateTimers() {
            const now = new Date();

            timers.forEach(({ id, deadline }) => {
                const el = document.getElementById(id);
                if (!el) return;

                const diff = new Date(deadline) - now;

                if (diff <= 0) {
                    el.textContent = 'Waktu habis!';
                    el.classList.remove('text-[#d71919]');
                    el.classList.add('text-gray-400');
                    return;
                }

                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);

                el.textContent = `${d}d : ${h}h : ${m}m : ${s}s`;
            });
        }

        updateTimers();
        setInterval(updateTimers, 1000);
    </script>

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
    </script>

</body>

</html>