<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Vendor - Equogreen</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-brand-bg flex h-screen overflow-hidden font-sans text-gray-800 antialiased">

    <!-- ===== SIDEBAR ===== -->
    <!-- Sidebar Overlay -->
    <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/50 lg:hidden" onclick="toggleSidebar()"></div>
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 flex min-h-screen w-[280px] flex-shrink-0 -translate-x-full transform flex-col bg-white shadow-md transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0">
        <!-- Logo -->
        <div class="flex items-center gap-3 border-b border-gray-100 px-6 pb-6 pt-8">
            <img src="/gambar/logo.png" alt="Logo Equogreen" class="h-14 w-14 rounded-full object-cover" />
            <span class="text-2xl font-bold text-gray-800">Equogreen</span>
        </div>

        <nav class="flex flex-1 flex-col gap-1 px-4 py-6">
            <a href="{{ route('vendor-dashboard') }}"
                class="hover:bg-primary group flex items-center gap-3 rounded-xl px-4 py-3 text-[17px] font-bold text-gray-600 transition-all duration-200 hover:text-white">
                <img src="/gambar/dashboard-layout.png" alt="Dashboard"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Dashboard
            </a>
            <div class="my-1 border-b border-gray-100"></div>
            <a href="{{ route('vendor-riwayat') }}"
                class="text-primary hover:bg-primary group flex items-center gap-3 rounded-xl bg-[#eef3ff] px-4 py-3 text-[17px] font-bold text-gray-700 transition-all duration-200 hover:text-white">
                <img src="/gambar/riwayat.png" alt="Riwayat"
                    class="h-7 w-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Riwayat
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
                    <h1 class="text-2xl font-bold text-[#111827] md:text-[36px]">Riwayat</h1>
                    <p class="mt-0.5 text-xs text-gray-400 md:mt-1 md:text-base md:text-gray-500">Periksa
                        kembali quotation yang Anda kirim</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3" x-data="{ openNotifications: false }">
                <!-- Notification Bell -->
                <div class="relative">
                    <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
                    @if (count($notifications) > 0)
                        <span
                            class="absolute -right-1 -top-1 flex h-5 w-5 animate-pulse items-center justify-center rounded-full bg-red-500 text-[10px] font-extrabold text-white">
                            {{ count($notifications) }}
                        </span>
                    @endif
            </button>

                    <!-- Dropdown List Notifikasi -->
                    <div x-show="openNotifications" @click.away="openNotifications = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 z-50 mt-2 flex w-80 flex-col gap-3 rounded-2xl border border-gray-200 bg-white p-4 shadow-xl"
                        style="display: none;" x-cloak>
                        <h4 class="flex items-center justify-between border-b pb-2 text-sm font-bold text-gray-800">
                            <span>Notifikasi</span>
                            <span class="text-xs font-normal text-gray-400">Terbaru</span>
                        </h4>
                        <div class="flex max-h-60 flex-col gap-2.5 overflow-y-auto pr-1">
                            @forelse($notifications as $notif)
                                <div
                                    class="flex flex-col gap-1 rounded-xl border border-gray-100 bg-gray-50 p-3 text-left transition duration-150 hover:bg-gray-100">
                                    <p class="text-xs font-medium leading-relaxed text-gray-700">{{ $notif->isi }}
                                    </p>
                                    <span
                                        class="self-end text-[9px] font-bold text-gray-400">{{ $notif->created_at ? $notif->created_at->diffForHumans() : '-' }}</span>
                                </div>
                            @empty
                                <div class="flex flex-col items-center gap-2 py-6 text-center">
                                    <i class="ph ph-bell-slash text-2xl text-gray-300"></i>
                                    <p class="text-xs font-medium text-gray-400">Tidak ada notifikasi baru</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <a href="{{ route('vendor_profile') }}">
                    <img src="/gambar/profileup.png" alt="Profil"
                        class="hover:border-primary h-12 w-12 cursor-pointer rounded-full border-2 border-gray-200 object-cover transition-all duration-200" />
                </a>
                <div class="hidden h-10 w-px bg-gray-200 md:block"></div>
                <span
                    class="hidden text-[17px] font-medium text-gray-700 md:block">{{ Auth::user()->vendor->nama_perusahaan ?? 'Vendor' }}</span>
            </div>
        </header>

        <!-- Search Bar -->
        <div class="relative">
            <input type="text" placeholder="Search"
                class="focus:border-primary w-full rounded-xl border border-gray-300 bg-white px-6 py-4 text-base font-medium text-gray-700 shadow-sm outline-none transition-all duration-200 placeholder:text-gray-400" />
        </div>

        <!-- Table Card -->
        <div class="overflow-hidden rounded-[32px] border border-gray-100 bg-white shadow-sm">
            <table class="w-full border-collapse text-left">
                <thead class="bg-primary">
                    <tr>
                        <th class="border-r border-white/10 px-8 py-5 text-center text-lg font-bold text-white">
                            Tanggal</th>
                        <th class="px-8 py-5 text-center text-lg font-bold text-white">Quotation</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($history as $key => $data)
                        <tr class="transition-colors duration-150 hover:bg-gray-50">
                            <td class="border-r border-gray-100 px-8 py-6 text-center font-semibold text-gray-700">
                                {{ $data['waktu'] }} <br>
                                <span class="text-sm font-normal text-gray-400">Batch:
                                    {{ $data['batch_id'] }}</span>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <a href="javascript:void(0)" onclick="openModal('{{ $key }}')"
                                    class="font-bold text-blue-500 decoration-2 underline-offset-4 hover:underline">Lihat
                                    Rincian</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-8 py-6 text-center text-gray-500">Belum ada riwayat
                                quotation.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </main>

    <script>
        function openModal(key) {
            const modal = document.getElementById('modal-rincian-' + key);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }
        }

        function closeModal(key) {
            const modal = document.getElementById('modal-rincian-' + key);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-container')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
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
    </script>

    <!-- ========== MODAL: Rincian Item ========== -->
    @foreach ($history as $key => $data)
        <div id="modal-rincian-{{ $key }}"
            class="modal-container fixed inset-0 z-[60] hidden items-center justify-center bg-black/40 p-4 backdrop-blur-sm">
            <div
                class="mx-auto w-full max-w-7xl animate-[modalSlideUp_0.25s_ease-out] overflow-hidden rounded-2xl bg-white shadow-2xl">
                <!-- Header -->
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-5">
                    <div>
                        <h2 class="text-sm font-bold uppercase tracking-widest text-gray-400">RINCIAN LENGKAP QUOTATION
                        </h2>
                        <p class="mt-1 text-xs text-gray-500">Upload: {{ $data['waktu'] }} | Batch:
                            {{ $data['batch_id'] }}</p>
                    </div>
                    <button onclick="closeModal('{{ $key }}')"
                        class="flex h-10 w-10 items-center justify-center rounded-full transition-colors hover:bg-gray-100">
                        <i class="ph-bold ph-x text-2xl text-gray-400"></i>
                    </button>
                </div>

                <!-- Table Body -->
                <div class="p-6">
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full border-collapse text-left">
                            <thead class="bg-primary">
                                <tr class="whitespace-nowrap text-xs font-bold text-white md:text-sm">
                                    <th class="w-12 border-r border-white/10 px-4 py-4 text-center">#</th>
                                    <th class="border-r border-white/10 px-4 py-4">Coll No.</th>
                                    <th class="border-r border-white/10 px-4 py-4">RFQ No.</th>
                                    <th class="border-r border-white/10 px-4 py-4">Material No.</th>
                                    <th class="min-w-[200px] border-r border-white/10 px-4 py-4">Description</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">Qty</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">UoM</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">Currency</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-right">Net Price</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-right">Total Price</th>
                                    <th class="border-r border-white/10 px-4 py-4">Incoterm</th>
                                    <th class="border-r border-white/10 px-4 py-4">Destination</th>
                                    <th class="min-w-[150px] border-r border-white/10 px-4 py-4">Remark 1</th>
                                    <th class="min-w-[150px] border-r border-white/10 px-4 py-4">Remark 2</th>
                                    <th class="border-r border-white/10 px-4 py-4">Payment Term</th>
                                    <th class="border-r border-white/10 px-4 py-4 text-center">Lead Time (Wks)</th>
                                    <th class="px-4 py-4">Quotation Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">

                                @foreach ($data['items'] as $index => $item)
                                    <tr
                                        class="whitespace-nowrap text-xs text-gray-700 transition-colors hover:bg-gray-50 md:text-sm">
                                        <td
                                            class="border-r border-gray-50 px-4 py-4 text-center font-medium text-gray-300">
                                            {{ $index + 1 }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['coll_no'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['rfq_no'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 font-mono text-gray-600">
                                            {{ $item['material_no'] }}</td>
                                        <td class="max-w-xs truncate border-r border-gray-50 px-4 py-4 font-semibold"
                                            title="{{ $item['description'] }}">{{ $item['description'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center font-medium">
                                            {{ $item['qty'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center text-gray-500">
                                            {{ $item['uom'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center text-gray-500">
                                            {{ $item['currency'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-right text-gray-500">
                                            {{ number_format((float) $item['net_price'], 0, ',', '.') }}</td>
                                        <td
                                            class="border-r border-gray-50 px-4 py-4 text-right font-extrabold text-black">
                                            {{ number_format((float) ($item['qty'] * $item['net_price']), 0, ',', '.') }}
                                        </td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['incoterm'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['destination'] }}</td>
                                        <td class="max-w-[150px] truncate border-r border-gray-50 px-4 py-4 text-gray-500"
                                            title="{{ $item['remark_1'] }}">{{ $item['remark_1'] }}</td>
                                        <td class="max-w-[150px] truncate border-r border-gray-50 px-4 py-4 text-gray-500"
                                            title="{{ $item['remark_2'] }}">{{ $item['remark_2'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-gray-500">
                                            {{ $item['payment_term'] }}</td>
                                        <td class="border-r border-gray-50 px-4 py-4 text-center text-gray-500">
                                            {{ $item['lead_time_weeks'] }}</td>
                                        <td class="px-4 py-4 text-gray-500">
                                            {{ $item['quotation_date'] ? date('d M Y', strtotime($item['quotation_date'])) : '-' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
