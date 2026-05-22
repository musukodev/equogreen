<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Quotation - Equogreen</title>
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

        <nav class="flex-1 px-4 py-6 flex flex-col gap-1">
            <a href="{{ route('vendor-dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 font-bold text-[17px] bg-[#eef3ff] text-primary transition-all duration-200 hover:bg-primary hover:text-white group">
                <img src="gambar/dashboard-layout.png" alt="Dashboard"
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
        <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 gap-6 overflow-y-auto relative">

            <!-- Top Header -->
            <header class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <!-- Mobile Hamburger -->
                    <button onclick="toggleSidebar()"
                        class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                        <img src="gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                    </button>
                    <!-- Back Button -->
                    <a href="{{ route('vendor-dashboard') }}"
                        class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm">
                        <img src="gambar/back-arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0" />
                    </a>
                    <div>
                        <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Buat Quotation</h1>
                        <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Isi quotation sesuai ketentuan yang berlaku</p>
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
                    <img src="gambar/profileup.png" alt="Profil"
                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                    <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                    <span class="hidden md:block font-medium text-gray-700 text-[17px]">Vendor</span>
                </div>
            </header>

            <!-- Form Workspace -->
            

    <!-- Topic Card -->
                    <div class="bg-white rounded-xl border border-gray-400 shadow-sm p-4 mb-6 flex items-center gap-3 md:gap-4 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                        <div class="w-[42px] h-[42px] md:w-[50px] md:h-[50px] rounded-full bg-[#4a40ce] flex items-center justify-center flex-shrink-0">
                            <i class="fa-solid fa-box-open text-white text-lg md:text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-base md:text-lg font-bold text-black mb-0.5">Pengadaan Barang ATK</h2>
                            <p class="text-gray-500 text-xs md:text-[15px]">ATK</p>
                        </div>
                    </div>

                    <!-- Form Card: Mengubah <div> menjadi <form> dan menambahkan method, action, serta enctype -->
                    <form action="{{ route('fastexcel.import') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl border border-gray-400 p-6 shadow-sm flex flex-col transition-all duration-300 hover:scale-[1.005] hover:shadow-md">
                        @csrf                        <!-- Deadline Box -->
                        <div class="bg-[#ebeaef] rounded-md px-4 pt-3 pb-1 mb-6">
                            <p class="text-black text-[13px] md:text-[15px]"><span class="font-bold">Tenggat Waktu:</span>
                                Selasa, 12 Februari 2026, 11:20</p>
                            <div class="h-px bg-gray-500 w-full mt-2.5"></div>
                        </div>

                        <!-- Description Area -->
                        <div class="flex items-start gap-4 mb-6 pt-1">
                            <!-- Icon outline box -->
                            <i class="fa-solid fa-box text-[24px] md:text-[28px] text-black"></i>
                            <div>
                                <h3 class="text-[15px] md:text-[16px] font-bold text-black mb-0.5">Deskripsi Spesifikasi Barang</h3>
                                <p class="text-[14px] text-gray-500">Perhatikan spesifikasi barang dengan baik</p>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="w-full mb-8 overflow-x-auto">
                            <table class="w-full border-collapse border border-gray-400 min-w-[500px]">
                                <thead>
                                    <tr class="bg-[#3a3fe0] text-white text-[15px]">
                                        <th class="border border-gray-400 py-2.5 font-normal w-1/3 text-center">Nama Barang</th>
                                        <th class="border border-gray-400 py-2.5 font-normal w-1/3 text-center">Spesifikasi detail</th>
                                        <th class="border border-gray-400 py-2.5 font-normal w-1/3 text-center">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                    </tr>
                                    <tr>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                        <td class="border border-gray-400 h-[40px]"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Action Buttons -->
                        <div class="space-y-3 w-full">
                            <button type="button" class="w-full bg-black text-white text-center text-[15px] py-3.5 rounded-lg hover:bg-gray-800 transition">
                                Download Template
                            </button>
                            <button type="button" class="w-full bg-black text-white text-center text-[15px] py-3.5 rounded-lg hover:bg-gray-800 transition">
                                Upload File
                            </button>
                            
                            <!-- MODIFIKASI UPLOAD BOX DISINI -->
                            <div class="w-full pt-1 pb-1">
                                <!-- Mengubah div menjadi label agar clickable, 'for' harus sama dengan 'id' pada input -->
                                <label for="file-upload" class="border-[1.5px] border-gray-400 rounded-lg py-7 flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition w-full">
                                    <i class="fa-solid fa-arrow-up-from-bracket text-[#a0a0a0] mb-2 text-lg"></i>
                                    <span class="text-[#a0a0a0] text-[15px]">Upload File</span>
                                    <!-- Input file disembunyikan menggunakan class 'hidden' -->
                                    <input id="file-upload" name="file" type="file" class="hidden" />
                                </label>
                                <p class="text-[#a0a0a0] text-[13px] mt-1.5 ml-1">Accepted files: All file types</p>
                            </div>

                            <!-- Tombol submit -->
                            <button type="submit" class="w-full bg-[#1e40ff] text-white text-center text-[15px] py-3.5 rounded-lg hover:bg-blue-700 transition relative">
                                Kirim
                            </button>
                        </div>

                        <!-- Footer Link -->
                        <div class="mt-5 text-[14px] text-black">
                            Tata cara quotation <a href="#" class="text-[#1e40ff]">Unduh</a>
                        </div>
                    </form>

                </div>

            </div>

        </main>
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

</body>

</html>