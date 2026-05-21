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
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/dashboard layout.png" alt="Dashboard"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Dashboard
            </a>
            <div class="border-b border-gray-100 my-1"></div>
            <a href="{{ route('vendor-riwayat') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/riwayat.png" alt="Riwayat"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Riwayat
            </a>
            <div class="border-b border-gray-100 my-1"></div>

        </nav>

        <!-- Logout -->
        <div class="px-4 pb-8 border-t border-gray-100 pt-4">
            <a href="#"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-red-500 font-bold text-[17px] transition-all duration-200 hover:bg-red-50 group">
                <img src="gambar/logout.png" alt="Logout" class="w-7 h-7 object-contain" />
                Logout
            </a>
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
                <div class="flex items-center gap-4">
                    <!-- Back Button (added for Riwayat page) -->
                    <a href="dashboard_vendor"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white transition-all duration-200 shadow-sm">
                        <img src="gambar/Back Arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                    </a>
                    <div>
                        <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Riwayat</h1>
                        <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Periksa kembali quotation yang Anda kirim</p>
                    </div>
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
        <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 gap-6">

            <!-- Search Bar -->
            <div class="relative">
                <input type="text" placeholder="Search"
                    class="w-full px-6 py-4 rounded-xl border border-gray-300 bg-white text-base text-gray-700 outline-none focus:border-primary transition-all duration-200 shadow-sm placeholder:text-gray-400 font-medium" />
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-[32px] shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-primary">
                        <tr>
                            <th class="px-8 py-5 text-white font-bold text-lg text-center border-r border-white/10">Tanggal</th>
                            <th class="px-8 py-5 text-white font-bold text-lg text-center">Quotation</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                        $history = [
                        ['21-02-2024', '#'],
                        ['13-03-2024', '#'],
                        ['26-12-2024', '#'],
                        ['05-01-2025', '#'],
                        ['10-01-2025', '#'],
                        ['25-02-2025', '#'],
                        ];
                        @endphp
                        @foreach($history as $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-8 py-6 text-gray-700 font-semibold text-center border-r border-gray-100">
                                {{ $item[0] }}
                            </td>
                            <td class="px-8 py-6 text-center">
                                <a href="javascript:void(0)" onclick="openModal()" class="text-blue-500 font-bold hover:underline underline-offset-4 decoration-2">Lihat</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </main>
    </div>

    <script>
        function openModal() {
            const modal = document.getElementById('modal-rincian');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('modal-rincian');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('modal-rincian');
            if (event.target == modal) {
                closeModal();
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
    <div id="modal-rincian" class="hidden fixed inset-0 z-[60] bg-black/40 backdrop-blur-sm items-center justify-center p-4">
        <div class="animate-[modalSlideUp_0.25s_ease-out] bg-white rounded-2xl shadow-2xl w-full max-w-7xl mx-auto overflow-hidden">
            <!-- Header -->
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest">RINCIAN LENGKAP QUOTATION</h2>
                <button onclick="closeModal()" class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 transition-colors">
                    <i class="ph-bold ph-x text-2xl text-gray-400"></i>
                </button>
            </div>

            <!-- Table Body -->
            <div class="p-6">
                <div class="overflow-x-auto rounded-xl border border-gray-100">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-primary">
                            <tr class="text-white text-xs md:text-sm font-bold whitespace-nowrap">
                                <th class="px-4 py-4 text-center w-12 border-r border-white/10">#</th>
                                <th class="px-4 py-4 border-r border-white/10">Coll No.</th>
                                <th class="px-4 py-4 border-r border-white/10">RFQ No.</th>
                                <th class="px-4 py-4 border-r border-white/10">Material No.</th>
                                <th class="px-4 py-4 border-r border-white/10 min-w-[200px]">Description</th>
                                <th class="px-4 py-4 text-center border-r border-white/10">Qty</th>
                                <th class="px-4 py-4 text-center border-r border-white/10">UoM</th>
                                <th class="px-4 py-4 text-center border-r border-white/10">Currency</th>
                                <th class="px-4 py-4 text-right border-r border-white/10">Net Price</th>
                                <th class="px-4 py-4 text-right border-r border-white/10">Total Price</th>
                                <th class="px-4 py-4 border-r border-white/10">Incoterm</th>
                                <th class="px-4 py-4 border-r border-white/10">Destination</th>
                                <th class="px-4 py-4 border-r border-white/10 min-w-[150px]">Remark 1</th>
                                <th class="px-4 py-4 border-r border-white/10 min-w-[150px]">Remark 2</th>
                                <th class="px-4 py-4 border-r border-white/10">Payment Term</th>
                                <th class="px-4 py-4 text-center border-r border-white/10">Lead Time (Wks)</th>
                                <th class="px-4 py-4">Quotation Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">

                            @foreach($quotations as $index => $item)
                            <tr class="text-xs md:text-sm text-gray-700 hover:bg-gray-50 transition-colors whitespace-nowrap">
                                <td class="px-4 py-4 text-center text-gray-300 font-medium border-r border-gray-50">{{ $index + 1 }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50">{{ $item['coll_no'] }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50">{{ $item['rfq_no'] }}</td>
                                <td class="px-4 py-4 font-mono text-gray-600 border-r border-gray-50">{{ $item['material_no'] }}</td>
                                <td class="px-4 py-4 font-semibold border-r border-gray-50 truncate max-w-xs" title="{{ $item['description'] }}">{{ $item['description'] }}</td>
                                <td class="px-4 py-4 text-center font-medium border-r border-gray-50">{{ $item['qty'] }}</td>
                                <td class="px-4 py-4 text-center text-gray-500 border-r border-gray-50">{{ $item['uom'] }}</td>
                                <td class="px-4 py-4 text-center text-gray-500 border-r border-gray-50">{{ $item['currency'] }}</td>
                                <td class="px-4 py-4 text-right text-gray-500 border-r border-gray-50">{{ number_format($item['net_price'], 0, ',', '.') }}</td>
                                <td class="px-4 py-4 text-right font-extrabold text-black border-r border-gray-50">{{ number_format($item['qty'] * $item['net_price'], 0, ',', '.') }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50">{{ $item['incoterm'] }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50">{{ $item['destination'] }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50 truncate max-w-[150px]" title="{{ $item['remark_1'] }}">{{ $item['remark_1'] }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50 truncate max-w-[150px]" title="{{ $item['remark_2'] }}">{{ $item['remark_2'] }}</td>
                                <td class="px-4 py-4 text-gray-500 border-r border-gray-50">{{ $item['payment_term'] }}</td>
                                <td class="px-4 py-4 text-center text-gray-500 border-r border-gray-50">{{ $item['lead_time_weeks'] }}</td>
                                <td class="px-4 py-4 text-gray-500">{{ date('d M Y', strtotime($item['quotation_date'])) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>