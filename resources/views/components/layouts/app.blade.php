<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>{{ $title ?? 'Equogreen' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    @livewireStyles
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

            @if (auth()->check() && in_array(strtolower(auth()->user()->role), ['procurement', 'superadmin']))
                <!-- Procurement Links -->
                <a href="{{ route('procurement-dashboard') }}"
                    class="{{ request()->routeIs('procurement-dashboard') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Dashboard
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                @if (strtolower(auth()->user()->role) === 'superadmin')
                    <!-- Kelola Admin (Superadmin Only) -->
                    <a href="{{ route('procurement-kelola-admin') }}"
                        class="{{ request()->routeIs('procurement-kelola-admin') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                        <i
                            class="ph-bold ph-shield-check {{ request()->routeIs('procurement-kelola-admin') ? 'text-primary' : 'text-gray-400' }} text-2xl group-hover:text-white"></i>
                        Kelola Admin
                    </a>
                    <div class="my-1 border-b border-gray-100"></div>
                @endif

                <a href="{{ route('procurement-batch_barang') }}"
                    class="{{ request()->routeIs('procurement-batch_barang') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/search-database.png" alt="Periksa Barang"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Batch Barang
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('procurement-notifikasi') }}"
                    class="{{ request()->routeIs('procurement-notifikasi') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/vendor-sidebar.png" alt="Daftar Vendor"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Daftar Vendor
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('procurement-validasi-vendor') }}"
                    class="{{ request()->routeIs('procurement-validasi-vendor') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/validasi.png" alt="Validasi Vendor"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Validasi Vendor
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('procurement-riwayat-po') }}"
                    class="{{ request()->routeIs('procurement-riwayat-po') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/riwayat.png" alt="Riwayat PO"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Riwayat PO
                </a>
                <div class="my-1 border-b border-gray-100"></div>
            @elseif(auth()->check() && strtolower(auth()->user()->role) === 'vendor')
                <!-- Vendor Links -->
                <a href="{{ route('vendor-dashboard') }}"
                    class="{{ request()->routeIs('vendor-dashboard') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Dashboard
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('vendor-riwayat') }}"
                    class="{{ request()->routeIs('vendor-riwayat') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/riwayat.png" alt="Riwayat"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Riwayat
                </a>
                <div class="my-1 border-b border-gray-100"></div>
            @endif

        </nav>

        <!-- Logout -->
        <div class="border-t border-gray-100 px-4 pb-8 pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="group flex w-full items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-red-500 transition-all duration-200 hover:bg-red-50">
                    <img src="/gambar/logout.png" alt="Logout" class="h-7 w-7 object-contain" />
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT SLOT ===== -->
    <div class="flex h-full min-w-0 flex-1 flex-col overflow-hidden">
        <!-- Top Header Global -->
        @if (isset($headerTitle))
            <header class="flex flex-shrink-0 items-center justify-between p-6 pb-0 lg:p-8">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button onclick="toggleSidebar()"
                        class="hover:bg-primary hover:border-primary group flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white lg:hidden">
                        <img src="/gambar/garis3.png" alt="Menu"
                            class="h-6 w-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>

                    @if (isset($backUrl))
                        <!-- Back Button -->
                        <a href="{{ $backUrl }}"
                            class="hover:bg-primary hover:border-primary flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white"
                            wire:navigate>
                            <img src="/gambar/back-arrow.png" alt="Back"
                                class="h-6 w-6 object-contain brightness-0" />
                        </a>
                    @elseif(isset($backRoute))
                        <!-- Back Button -->
                        <a href="{{ route($backRoute) }}"
                            class="hover:bg-primary hover:border-primary flex h-10 w-10 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 shadow-sm transition-all duration-200 hover:text-white"
                            wire:navigate>
                            <img src="/gambar/back-arrow.png" alt="Back"
                                class="h-6 w-6 object-contain brightness-0" />
                        </a>
                    @endif

                    <div>
                        <h1 class="text-2xl font-bold leading-none text-[#111827] md:text-[36px]">{{ $headerTitle }}
                        </h1>
                        @if (isset($headerDescription))
                            <p class="mt-1.5 text-xs text-gray-400 md:text-base md:text-gray-500">
                                {{ $headerDescription }}</p>
                        @endif
                    </div>
                </div>

                <!-- Profile Section -->
                <div class="flex items-center gap-3">
                    @if (auth()->check())
                        <livewire:notification-bell />

                        @if (in_array(strtolower(auth()->user()->role), ['procurement', 'superadmin']))
                            <a href="{{ route('profile_procurement') }}">
                                <img src="/gambar/profileup.png" alt="Profil"
                                    class="hover:border-primary hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
                            </a>
                            <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
                            <span class="hidden text-[17px] font-medium text-gray-700 md:block">
                                {{ auth()->user()->procurement?->nama_procurement ?? 'Procurement' }}
                            </span>
                        @elseif(strtolower(auth()->user()->role) === 'vendor')
                            @php
                                $vendor = auth()->user()->vendor;
                            @endphp
                            <a href="{{ route('vendor_profile') }}">
                                <img src="/gambar/profileup.png" alt="Profil"
                                    class="hover:border-primary hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
                            </a>
                            <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
                            <span
                                class="hidden text-[17px] font-medium text-gray-700 md:block">{{ $vendor?->nama_perusahaan ?? 'Vendor' }}</span>
                        @endif
                    @endif
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <div class="flex-1 overflow-y-auto">
            {{ $slot }}
        </div>
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
    </script>

    @livewireScripts
</body>

</html>
