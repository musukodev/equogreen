<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Vendor - Equogreen</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        <header class="flex items-center justify-between p-4 md:p-6 lg:px-8 lg:pt-8 lg:pb-4">
            <div class="flex items-center gap-4">
                <!-- Back Button -->
                <button onclick="history.back()"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:border-primary transition-all duration-200 shadow-sm group flex-shrink-0">
                    <img src="gambar/Back Arrow.png" alt="Back" class="w-6 h-6 object-contain brightness-0 group-hover:brightness-0 group-hover:invert" />
                </button>
                <div>
                    <h1 class="text-2xl md:text-[32px] font-bold text-[#111827]">Profile</h1>
                    <p class="text-gray-700 text-sm md:text-[15px] mt-0.5">Silahkan ubah data profile apabila ada perubahan</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <button class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:border-primary transition-all duration-200 shadow-sm">
                <img src="/gambar/bell-black.png" alt="Notifikasi"
                    class="w-6 h-6 object-contain" />
            </button>

                <!-- Profile -->
                <a href="{{ route('vendor_profile') }}">
                    <img src="gambar/Profileup.png" alt="Profil"
                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                </a>
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <span class="hidden md:block font-medium text-gray-700 text-[17px]">Vendor</span>
            </div>
        </header>

        <!-- Main Form Wrapper -->
        <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:px-8 lg:pb-8 pt-0">
            <div class="bg-white rounded-lg p-6 md:p-8 shadow-sm border border-gray-200">
                <form class="flex flex-col gap-6">
                    <!-- Row 1 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-medium text-gray-800 text-[15px]">Nama Perusahaan</label>
                            <input type="text" class="border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="{{ auth()->user()->vendor?->nama_perusahaan }}">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-medium text-gray-800 text-[15px]">Nama Penanggung jawab</label>
                            <input type="text" class="border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="{{ auth()->user()->vendor?->penanggung_jawab }}">
                        </div>
                    </div>
                    
                    <!-- Row 2 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <div class="flex flex-col gap-1.5">
                            <label class="font-medium text-gray-800 text-[15px]">Email Perusahaan</label>
                            <input type="email" class="border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="{{ auth()->user()->vendor?->email_perusahaan }}">
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label class="font-medium text-gray-800 text-[15px]">No. Handphone Perusahaan</label>
                            <input type="text" class="border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="{{ auth()->user()->vendor?->no_hp }}">
                        </div>
                    </div>

                    <!-- Row 3 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-medium text-gray-800 text-[15px]">Deskripsi Perusahaan</label>
                                <textarea class="border border-gray-400 rounded-md px-4 py-3 h-[120px] resize-none text-gray-700 focus:outline-none focus:border-primary leading-relaxed">{{ auth()->user()->vendor?->deskripsi }}</textarea>
                            </div>
                            
                            <div class="relative">
                                <select class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 appearance-none focus:outline-none focus:border-primary" value="">
                                    <option>{{ auth()->user()->vendor?->kategori_vendor}}</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                    <i class="fa-solid fa-chevron-down text-sm"></i>
                                </div>
                            </div>
                            
                            <div>
                                <input type="text" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="{{ auth()->user()->vendor?->kode_pos}} ">
                            </div>
                        </div>

                        <div class="flex flex-col gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="font-medium text-gray-800 text-[15px]">Alamat Perusahaan</label>
                                <textarea class="border border-gray-400 rounded-md px-4 py-3 h-[120px] resize-none text-gray-700 focus:outline-none focus:border-primary leading-relaxed">{{ auth()->user()->vendor?->alamat }}</textarea>
                            </div>
                            
                            <div>
                                <input type="text" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="{{ auth()->user()->vendor?->provinsi }}">
                            </div>

                            <div>
                                <input type="text" class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 focus:outline-none focus:border-primary" value="Batam"{{ auth()->user()->vendor?->kota }}>
                            </div>
                        </div>
                    </div>

                    <!-- Portofolio -->
                    <div class="flex flex-col gap-1.5 mt-2">
                        <label class="font-medium text-gray-800 text-[15px]">Portofolio</label>
                        <div class="border border-gray-400 rounded-md px-4 py-4 flex items-center bg-white">
                            <i class="fa-solid fa-file-arrow-up text-gray-500 text-xl mr-3"></i>
                            <a href="{{ asset('storage/portofolio/' . auth()->user()->vendor?->portofolio) }}" target="_blank" class="text-[#002eff] underline font-medium text-[15px]">{{ auth()->user()->vendor?->portofolio }}</a>
                        </div>
                        <div class="flex justify-end gap-3 mt-3">
                            <button type="button" class="border border-gray-400 rounded-md px-5 py-2 flex items-center gap-2 text-sm font-bold text-gray-800 hover:bg-gray-800 transition">
                                <i class="fa-regular fa-pen-to-square"></i> Edit
                            </button>
                            <button type="button" class="bg-black text-white rounded-md px-5 py-2 flex items-center gap-2 text-sm font-bold hover:bg-red-500 transition">
                                <i class="fa-regular fa-trash-can"></i> Delete
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="w-full bg-[#002eff] text-white rounded-xl py-3.5 font-semibold text-lg hover:bg-blue-600 transition shadow-sm">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
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
