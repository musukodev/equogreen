<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Barang - 2026</title>
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

    <!-- Sidebar -->
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

        <!-- Nav Menu -->
        <nav class="flex-1 px-4 py-6 flex flex-col gap-1">

            <!-- Dashboard -->
            <a href="{{ route('procurement-dashboard')}}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/dashboard layout.png" alt="Dashboard"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Dashboard
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Periksa Barang (ACTIVE) -->
            <a href="{{ route('procurement-batch-list') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/search database.png" alt="Periksa Barang"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Batch Barang
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <a href="{{ route('procurement-notifikasi') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/Add Reminder.png" alt="Kelola Notifikasi"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Kelola Notifikasi
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Validasi Vendor -->
            <a href="{{ route('procurement-validasi-vendor') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 font-bold text-[17px] transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/validasi.png" alt="Validasi Vendor"
                    class="w-7 h-7 object-contain group-hover:brightness-0 group-hover:invert" />
                Validasi Vendor
            </a>
            <div class="border-b border-gray-100 my-1"></div>

            <!-- Pengaturan -->
           

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



        <!-- Main Workspace Padding Wrapper -->
        <main class="flex-1 flex flex-col min-w-0 p-6 lg:p-8 gap-6 overflow-y-auto relative">

            <!-- Top Header -->
            <header class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center justify-between md:justify-start w-full md:w-auto gap-4">
                    <div class="flex items-center gap-3 md:gap-6">
                        <div class="flex items-center gap-2 md:gap-4">
                            <!-- Mobile Hamburger -->
                            <button onclick="toggleSidebar()"
                                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                                <img src="gambar/garis3.png" alt="Menu"
                                    class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                            </button>
                            <!-- Back Button -->
                            <a href="batch_barang.html"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary transition-all duration-200 shadow-sm">
                                <img src="gambar/Back Arrow.png" alt="Back"
                                    class="w-6 h-6 object-contain brightness-0" />
                            </a>
                            <h1 class="text-2xl md:text-[36px] font-bold text-[#111827] leading-none">2026</h1>
                        </div>

                        <!-- Tabs Section (Desktop) -->
                        <div class="hidden md:flex items-center gap-8 ml-2">
                            <a href="{{ route('procurement-batch_barang') }}"
                                class="text-[17px] font-medium text-gray-400 hover:text-primary transition-colors pb-1 whitespace-nowrap">
                                Buat Batch
                            </a>
                            <a href="{{ route('procurement-periksa_barang') }}"
                                class="text-[17px] font-bold text-black border-b-[3px] border-primary pb-1 whitespace-nowrap">
                                Periksa Barang
                            </a>
                        </div>
                    </div>

                    <!-- Right: Profile Section (Mobile Only) -->
                    <div class="flex md:hidden items-center gap-3">
                        <button
                            class="w-10 h-10 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200">
                            <img src="gambar/bell-black.png" alt="Notifikasi" class="w-5 h-5 object-contain" />
                        </button>
                        <img src="gambar/Profileup.png" alt="Profil"
                            class="w-10 h-10 rounded-full object-cover border border-gray-200" />
                    </div>
                </div>

                <!-- Tabs Section (Mobile Only) -->
                <div class="flex md:hidden items-center gap-6 px-1">
                    <a href="{{ route('procurement-batch_barang') }}"
                        class="text-[15px] font-medium text-gray-400 hover:text-primary transition-colors pb-1 whitespace-nowrap">
                        Buat Batch
                    </a>
                    <a href="{{ route('procurement-periksa_barang') }}"
                        class="text-[15px] font-bold text-black border-b-2 border-primary pb-1 whitespace-nowrap">
                        Periksa Barang
                    </a>
                </div>

                <!-- Right: Profile Section (Desktop Only) — DIUBAH sesuai gambar -->
                <div class="hidden md:flex items-center gap-3">
                    <button
                        class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group shadow-sm">
                        <img src="gambar/bell-black.png" alt="Notifikasi"
                            class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>
                    <img src="gambar/Profileup.png" alt="Profil"
                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                    <div class="w-px h-10 bg-gray-200"></div>
                    <span class="font-medium text-gray-700 text-[17px]">Procurement</span>
                </div>
            </header>

            <!-- Content Card -->
            <div class="w-full">
                <div class="bg-white rounded-lg border border-gray-400 p-6 shadow-sm w-full">

                    <!-- Search Input -->
                    <div class="mb-4">
                        <input type="text" placeholder="Search"
                            class="w-full px-4 py-2 border border-black rounded-md outline-none focus:ring-1 focus:ring-black transition text-[15px]">
                    </div>

                    <!-- Dropdowns -->
                    <div class="flex flex-wrap items-center gap-4 mb-6">
                        <div class="relative min-w-[120px]">
                            <select
                                class="w-full appearance-none px-3 py-2 pr-10 border border-black rounded-md outline-none focus:border-black focus:ring-1 focus:ring-black bg-white shadow-sm cursor-pointer text-[15px]">
                                <option>Batch 1</option>
                                <option>Batch 2</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-gray-700 font-bold">
                                <i class="ph-bold ph-caret-down"></i>
                            </div>
                        </div>
                        <div class="relative min-w-[120px]">
                            <select
                                class="w-full appearance-none px-3 py-2 pr-10 border border-black rounded-md outline-none focus:border-black focus:ring-1 focus:ring-black bg-white shadow-sm cursor-pointer text-[15px]">
                                <option>ATK</option>
                                <option>Lainnya</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-gray-700 font-bold">
                                <i class="ph-bold ph-caret-down"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="overflow-x-auto border border-black rounded-sm">
                        <table class="w-full border-collapse min-w-[600px] text-center">
                            <thead>
                                <tr class="bg-[#423ec7] text-white">
                                    <th
                                        class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/3">
                                        Nama Vendor</th>
                                    <th
                                        class="py-4 px-4 font-normal text-[14px] border-r border-[#26245f] border-b border-black w-1/3">
                                        Quotation</th>
                                    <th class="py-4 px-4 font-normal text-[14px] border-b border-black w-1/3">Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Row 1 -->
                                <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                                    <td class="py-4 px-4 text-black border-r border-black">ATK Corp.</td>
                                    <td class="py-4 px-4 border-r border-black">
                                        <a href="#" onclick="openRincianModal(event)"
                                            class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">Cek</a>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-5">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 2 -->
                                <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                                    <td class="py-4 px-4 text-black border-r border-black">Pusat ATK</td>
                                    <td class="py-4 px-4 border-r border-black">
                                        <a href="#" onclick="openRincianModal(event)"
                                            class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">Cek</a>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-5">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 3 -->
                                <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                                    <td class="py-4 px-4 text-black border-r border-black">ATK Corner</td>
                                    <td class="py-4 px-4 border-r border-black">
                                        <a href="#" onclick="openRincianModal(event)"
                                            class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">Cek</a>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-5">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 4 -->
                                <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                                    <td class="py-4 px-4 text-black border-r border-black">Elektro Site</td>
                                    <td class="py-4 px-4 border-r border-black">
                                        <a href="#" onclick="openRincianModal(event)"
                                            class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">Cek</a>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-5">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 5 -->
                                <tr class="border-b border-black hover:bg-gray-50 transition text-[14px]">
                                    <td class="py-4 px-4 text-black border-r border-black">ATKKita</td>
                                    <td class="py-4 px-4 border-r border-black">
                                        <a href="#" onclick="openRincianModal(event)"
                                            class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">Cek</a>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-5">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Row 6 -->
                                <tr class="hover:bg-gray-50 transition text-[14px]">
                                    <td class="py-4 px-4 text-black border-r border-black">Fur&Ture</td>
                                    <td class="py-4 px-4 border-r border-black">
                                        <a href="#" onclick="openRincianModal(event)"
                                            class="text-[#435ae7] underline underline-offset-2 hover:text-blue-800">Cek</a>
                                    </td>
                                    <td class="py-4 px-4 text-center">
                                        <div class="flex items-center justify-center gap-5">
                                            <i class="ph ph-check text-[#4adb49] text-xl font-bold"></i>
                                            <i class="ph ph-x text-[#f52b2b] text-xl font-bold"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <!-- Modal Backdrop -->
            <div id="rincianModalBackdrop"
                class="fixed inset-0 bg-black/40 z-[60] hidden opacity-0 transition-opacity duration-300"
                onclick="closeRincianModal()"></div>

            <!-- Modal Container -->
            <div id="rincianModal"
                class="fixed inset-0 z-[70] hidden items-center justify-center pointer-events-none px-4 py-6 sm:py-10">
                <div class="bg-white rounded-2xl shadow-xl w-full max-w-[1200px] max-h-full flex flex-col pointer-events-auto transform scale-95 opacity-0 transition-all duration-300 overflow-hidden"
                    id="rincianModalContent">

                    <!-- Header Modal -->
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-6 sm:px-8 py-5 border-b border-gray-100 gap-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-14 h-14 rounded-full bg-[#f0e6ff] text-[#3833a6] font-bold flex items-center justify-center text-xl">
                                AC
                            </div>
                            <div class="flex flex-col sm:flex-row sm:items-center gap-3">
                                <div>
                                    <h2 class="text-[22px] font-bold text-black leading-tight">ATK Corp.</h2>
                                    <p class="text-[14px] text-gray-400 mt-1">QT-2026-0318 &middot; Batch 1 &middot; ATK</p>
                                </div>
                                <!-- Badge Disetujui -->
                                <div class="flex items-center gap-2 px-3 py-1 bg-[#e8f8e8] text-[#2d8a2d] rounded-full text-[13px] font-semibold border border-[#d1f0d1] h-fit">
                                    <div class="w-2 h-2 rounded-full bg-[#2d8a2d]"></div>
                                    Disetujui
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 self-end sm:self-auto">

                            <button onclick="closeRincianModal()"
                                class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition">
                                <i class="ph ph-x text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Content scrollable -->
                    <div class="flex-1 overflow-y-auto px-6 sm:px-8 py-8 custom-scrollbar">
                        <!-- Info Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-y-7 gap-x-8 mb-8 pb-8 border-b border-gray-100">
                            <div>
                                <p class="text-[14px] text-gray-400 mb-1.5">Kontak PIC</p>
                                <p class="text-[16px] text-black font-medium">Budi Santoso</p>
                            </div>
                            <div>
                                <p class="text-[14px] text-gray-400 mb-1.5">Telepon</p>
                                <p class="text-[16px] text-black font-medium">0812-3456-7890</p>
                            </div>
                            <div>
                                <p class="text-[14px] text-gray-400 mb-1.5">Email</p>
                                <p class="text-[16px] text-black font-medium">budi@atkcorp.co.id</p>
                            </div>

                            <div>
                                <p class="text-[14px] text-gray-400 mb-1.5">Tgl Penawaran</p>
                                <p class="text-[16px] text-black font-medium">28 Mar 2026</p>
                            </div>
                            <div>
                                <p class="text-[14px] text-gray-400 mb-1.5">Berlaku Hingga</p>
                                <p class="text-[16px] text-black font-medium">28 Apr 2026</p>
                            </div>
                            <div>
                                <p class="text-[14px] text-gray-400 mb-1.5">Termin</p>
                                <p class="text-[16px] text-black font-medium">Net 14 hari</p>
                            </div>
                        </div>

                        <!-- Section Title -->
                        <h3 class="text-[14px] font-bold text-gray-400 uppercase tracking-widest mb-4">Rincian Item</h3>

                        <!-- Table Excel Columns -->
                        <div class="overflow-x-auto w-full border-2 border-gray-250 rounded-lg">
                            <table class="w-full text-left whitespace-nowrap border-collapse">
                                <thead class="bg-[#423ec7] text-white">
                                    <tr>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Coll No.</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            RFQ No.</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Vendor</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            No. Item</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Material No.</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Description</th>
                                        <th
                                            class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">
                                            Qty</th>
                                        <th
                                            class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">
                                            UoM</th>
                                        <th
                                            class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">
                                            Currency</th>
                                        <th
                                            class="py-3.5 px-4 font-semibold text-[13px] text-right border-r-2 border-[#2825a8]">
                                            Net Price</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Incoterm</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Destination</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Remark 1</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Remark 2</th>
                                        <th
                                            class="py-3.5 px-4 font-semibold text-[13px] text-center border-r-2 border-[#2825a8]">
                                            Lead Time(Weeks)</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px] border-r-2 border-[#2825a8]">
                                            Payment Term</th>
                                        <th class="py-3.5 px-4 font-semibold text-[13px]">Quotation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Row 1 -->
                                    <tr class="border-b-2 border-gray-400 bg-white text-[13.5px]">
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">EMS11</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">6000010111</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">16000501</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">10</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">13005620</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">MONITOR, COLOR,
                                            LCD 20"/21", WIDESCREEN, AC100-240V, 50/60 Hz</td>
                                        <td class="py-3.5 px-4 text-gray-800 text-center border-r-2 border-gray-400">
                                            2.000</td>
                                        <td class="py-3.5 px-4 text-gray-800 text-center border-r-2 border-gray-400">UNT
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-800 text-right border-r-2 border-gray-400">0.00
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 text-center border-r-2 border-gray-400">—
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400">—</td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr class="border-b-2 border-gray-400 bg-[#f8f9ff] text-[13.5px]">
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">EMS11</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">6000010111</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">16000501</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">20</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">13005625</td>
                                        <td class="py-3.5 px-4 text-gray-800 border-r-2 border-gray-400">KEYBOARD AND
                                            MOUSE WIRELESS COMBO</td>
                                        <td class="py-3.5 px-4 text-gray-800 text-center border-r-2 border-gray-400">
                                            5.000</td>
                                        <td class="py-3.5 px-4 text-gray-800 text-center border-r-2 border-gray-400">SET
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-800 text-right border-r-2 border-gray-400">0.00
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400 text-center border-r-2 border-gray-400">—
                                        </td>
                                        <td class="py-3.5 px-4 text-gray-400 border-r-2 border-gray-400">—</td>
                                        <td class="py-3.5 px-4 text-gray-400">—</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openRincianModal(e) {
            if (e) e.preventDefault();
            const backdrop = document.getElementById('rincianModalBackdrop');
            const modal = document.getElementById('rincianModal');
            const content = document.getElementById('rincianModalContent');

            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');
            modal.classList.add('flex');

            // force reflow
            void modal.offsetWidth;

            backdrop.classList.remove('opacity-0');
            content.classList.remove('opacity-0', 'scale-95');
        }

        function closeRincianModal() {
            const backdrop = document.getElementById('rincianModalBackdrop');
            const modal = document.getElementById('rincianModal');
            const content = document.getElementById('rincianModalContent');

            backdrop.classList.add('opacity-0');
            content.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                backdrop.classList.add('hidden');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
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