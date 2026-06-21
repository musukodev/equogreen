<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Equogreen' }}</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @livewireStyles
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

            @if(auth()->check() && strtolower(auth()->user()->role) === 'procurement')
                <!-- Procurement Links -->
                <a href="{{ route('procurement-dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-[17px] transition-all duration-200 group {{ request()->routeIs('procurement-dashboard') ? 'bg-[#eef3ff] text-primary' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                        class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert {{ request()->routeIs('procurement-dashboard') ? '' : 'brightness-0 opacity-60' }}" />
                    Dashboard
                </a>
                <div class="border-b border-gray-100 my-1"></div>

                <a href="{{ route('procurement-batch_barang') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-[17px] transition-all duration-200 group {{ request()->routeIs('procurement-batch_barang') || request()->routeIs('procurement-batch_barang') ? 'bg-[#eef3ff] text-primary' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    <img src="/gambar/search-database.png" alt="Periksa Barang"
                        class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert {{ request()->routeIs('procurement-batch_barang') || request()->routeIs('procurement-batch_barang') ? '' : 'brightness-0 opacity-60' }}" />
                    Batch Barang
                </a>
                <div class="border-b border-gray-100 my-1"></div>

                <a href="{{ route('procurement-notifikasi') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-[17px] transition-all duration-200 group {{ request()->routeIs('procurement-notifikasi') ? 'bg-[#eef3ff] text-primary' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
                        class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert {{ request()->routeIs('procurement-notifikasi') ? '' : 'brightness-0 opacity-60' }}" />
                    Daftar Vendor
                </a>
                <div class="border-b border-gray-100 my-1"></div>

                <a href="{{ route('procurement-validasi-vendor') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-[17px] transition-all duration-200 group {{ request()->routeIs('procurement-validasi-vendor') ? 'bg-[#eef3ff] text-primary' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    <img src="/gambar/validasi.png" alt="Validasi Vendor"
                        class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert {{ request()->routeIs('procurement-validasi-vendor') ? '' : 'brightness-0 opacity-60' }}" />
                    Validasi Vendor
                </a>
                <div class="border-b border-gray-100 my-1"></div>

            @elseif(auth()->check() && strtolower(auth()->user()->role) === 'vendor')
                <!-- Vendor Links -->
                <a href="{{ route('vendor-dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-[17px] transition-all duration-200 group {{ request()->routeIs('vendor-dashboard') ? 'bg-[#eef3ff] text-primary' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                        class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert {{ request()->routeIs('vendor-dashboard') ? '' : 'brightness-0 opacity-60' }}" />
                    Dashboard
                </a>
                <div class="border-b border-gray-100 my-1"></div>

                <a href="{{ route('vendor-riwayat') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-[17px] transition-all duration-200 group {{ request()->routeIs('vendor-riwayat') ? 'bg-[#eef3ff] text-primary' : 'text-gray-700 hover:bg-primary hover:text-white' }}">
                    <img src="/gambar/riwayat.png" alt="Riwayat"
                        class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert {{ request()->routeIs('vendor-riwayat') ? '' : 'brightness-0 opacity-60' }}" />
                    Riwayat
                </a>
                <div class="border-b border-gray-100 my-1"></div>
            @endif

        </nav>

        <!-- Logout -->
        <div class="px-4 pb-8 border-t border-gray-100 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
                    <img src="/gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT SLOT ===== -->
    {{ $slot }}

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
    
    @livewireScripts
</body>

</html>
