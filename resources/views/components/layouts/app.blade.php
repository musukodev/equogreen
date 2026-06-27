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

            @if (auth()->check() && strtolower(auth()->user()->role) === 'procurement')
                <!-- Procurement Links -->
                <a href="{{ route('procurement-dashboard') }}"
                    class="{{ request()->routeIs('procurement-dashboard') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Dashboard
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('procurement-batch_barang') }}"
                    class="{{ request()->routeIs('procurement-batch_barang') || request()->routeIs('procurement-batch_barang') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/search-database.png" alt="Periksa Barang"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Batch Barang
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('procurement-notifikasi') }}"
                    class="{{ request()->routeIs('procurement-notifikasi') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/add-reminder.png" alt="Daftar Vendor"
                        class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                    Daftar Vendor
                </a>
                <div class="my-1 border-b border-gray-100"></div>

                <a href="{{ route('procurement-validasi-vendor') }}"
                    class="{{ request()->routeIs('procurement-validasi-vendor') ? 'bg-[#eef3ff] text-primary text-gray-700' : 'text-gray-600' }} hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold transition-all duration-200 hover:text-white">
                    <img src="/gambar/validasi.png" alt="Validasi Vendor"
                        class="h-10 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
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
    <div class="flex-1 flex flex-col min-w-0 h-full overflow-hidden">
        <!-- Top Header Global -->
        @if(isset($headerTitle))
        <header class="flex items-center justify-between p-6 lg:p-8 pb-0 flex-shrink-0">
            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger -->
                <button onclick="toggleSidebar()"
                    class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                    <img src="/gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                
                @if(isset($backUrl))
                <!-- Back Button -->
                <a href="{{ $backUrl }}"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm"
                    wire:navigate>
                    <img src="/gambar/back-arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                </a>
                @elseif(isset($backRoute))
                <!-- Back Button -->
                <a href="{{ route($backRoute) }}"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm"
                    wire:navigate>
                    <img src="/gambar/back-arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                </a>
                @endif

                <div>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827] leading-none">{{ $headerTitle }}</h1>
                    @if(isset($headerDescription))
                        <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-1.5">{{ $headerDescription }}</p>
                    @endif
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                @if(auth()->check())
                    @if(strtolower(auth()->user()->role) === 'procurement')
                        <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                            <img src="/gambar/bell-black.png" alt="Notifikasi" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                        </button>
                        <a href="{{ route('profile_procurement') }}">
                            <img src="/gambar/profileup.png" alt="Profil" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                        </a>
                        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                        <span class="hidden md:block font-medium text-gray-700 text-[17px]">Procurement</span>
                    @elseif(strtolower(auth()->user()->role) === 'vendor')
                        @php
                            $vendor = auth()->user()->vendor;
                            $notifications = \App\Models\Pengumuman::where('id_vendor', $vendor?->id_vendor)
                                ->orderBy('created_at', 'desc')
                                ->get();
                        @endphp
                        
                        <div class="relative" x-data="{ openNotifications: false }">
                            <button @click="openNotifications = !openNotifications"
                                class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                                <img src="/gambar/bell-black.png" alt="Notifikasi" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                                @if(count($notifications) > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-extrabold flex items-center justify-center rounded-full animate-pulse">
                                        {{ count($notifications) }}
                                    </span>
                                @endif
                            </button>

                            <!-- Dropdown List Notifikasi Vendor -->
                            <div x-show="openNotifications" 
                                 @click.away="openNotifications = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-80 bg-white border border-gray-200 rounded-2xl shadow-xl p-4 z-50 flex flex-col gap-3"
                                 style="display: none;" x-cloak>
                                <h4 class="font-bold text-gray-800 border-b pb-2 text-sm flex items-center justify-between">
                                    <span>Notifikasi</span>
                                    <span class="text-xs text-gray-400 font-normal">Terbaru</span>
                                </h4>
                                <div class="max-h-60 overflow-y-auto flex flex-col gap-2.5 pr-1">
                                    @forelse($notifications as $notif)
                                        <div class="p-3 rounded-xl bg-gray-50 border border-gray-100 hover:bg-gray-100 transition duration-150 flex flex-col gap-1 text-left">
                                            <p class="text-xs text-gray-700 leading-relaxed font-medium">{{ $notif->isi }}</p>
                                            <span class="text-[9px] text-gray-400 font-bold self-end">{{ $notif->created_at ? $notif->created_at->diffForHumans() : '-' }}</span>
                                        </div>
                                    @empty
                                        <div class="text-center py-6 flex flex-col items-center gap-2">
                                            <i class="ph ph-bell-slash text-2xl text-gray-300"></i>
                                            <p class="text-xs text-gray-400 font-medium">Tidak ada notifikasi baru</p>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('vendor_profile') }}">
                            <img src="/gambar/profileup.png" alt="Profil" class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                        </a>
                        <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                        <span class="hidden md:block font-medium text-gray-700 text-[17px]">{{ $vendor?->nama_perusahaan ?? 'Vendor' }}</span>
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
