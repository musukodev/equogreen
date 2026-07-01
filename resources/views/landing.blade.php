<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Equogreen</title>

    <!-- Google Fonts representing Figma fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Playfair+Display:wght@700&family=Noto+Sans:wght@400;700&family=Source+Sans+Pro:wght@400;700&family=Abhaya+Libre:wght@800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    boxShadow: {
                        "drop-shadow": "0px 4px 4px rgba(0, 0, 0, 0.25)",
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        /* Color transparent so transparent PNG assets show cleanly */
        img {
            color: transparent;
        }
        img[src=""] {
            opacity: 0;
        }
    </style>
</head>

<body class="bg-white text-black antialiased overflow-x-hidden">

    <!-- Header / Navbar -->
    <header class="sticky top-0 w-full bg-white z-50 border-b border-slate-100 shadow-sm">
        <nav class="max-w-[1440px] mx-auto h-[107px] px-6 md:px-12 flex items-center justify-between relative" aria-label="Navigasi utama">
            <!-- Logo & Brand Name -->
            <a href="#" class="flex items-center gap-3 relative hover:opacity-90 transition-opacity" aria-label="Equogreen beranda">
                <img class="w-[107px] h-[107px] aspect-[1] object-contain" src="{{ asset('gambar/logo.png') }}" alt="Logo Equogreen" />
                <span class="font-['Abhaya_Libre',serif] font-extrabold text-[35px] text-black tracking-[0] leading-[normal] whitespace-nowrap">
                    Equo<span class="text-[#2c7616]">green</span>
                </span>
            </a>

            <!-- Desktop Links -->
            <ul class="hidden lg:flex items-center gap-12 list-none m-0 p-0">
                <li><a href="#" class="font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:scale-105 transition-all">Beranda</a></li>
                <li><a href="#" class="font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:scale-105 transition-all">Registrasi Vendor</a></li>
                <li><a href="#" class="font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:scale-105 transition-all">Produk</a></li>
                <li><a href="#" class="font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:scale-105 transition-all">Developer</a></li>
            </ul>

            <!-- Desktop Login & Menu Toggle -->
            <div class="flex items-center gap-4">
                <a href="#" class="hidden lg:flex items-center justify-center w-[147px] h-[41px] bg-[#002eff] rounded-[10px] text-white font-['Inter',sans-serif] text-lg hover:bg-blue-700 hover:scale-[1.03] hover:shadow-lg transition-all duration-300" aria-label="Login">
                    Login
                </a>
                
                <!-- Hamburger Button for mobile -->
                <button id="menu-btn" type="button" class="lg:hidden p-2 rounded-lg text-black hover:bg-slate-50 transition-colors" aria-expanded="false">
                    <span class="sr-only">Buka menu utama</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-slate-100 bg-white px-6 py-4 shadow-lg absolute w-full left-0 z-40">
            <nav class="flex flex-col gap-3">
                <a href="#" class="block py-2 px-3 font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:bg-slate-50 rounded-lg transition-colors">Beranda</a>
                <a href="#" class="block py-2 px-3 font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:bg-slate-50 rounded-lg transition-colors">Registrasi Vendor</a>
                <a href="#" class="block py-2 px-3 font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:bg-slate-50 rounded-lg transition-colors">Produk</a>
                <a href="#" class="block py-2 px-3 font-['Inter',sans-serif] font-normal text-black text-lg hover:text-[#0946da] hover:bg-slate-50 rounded-lg transition-colors">Developer</a>
                <a href="#" class="block w-full text-center mt-2 py-2.5 bg-[#002eff] text-white rounded-[10px] font-['Inter',sans-serif] text-lg hover:bg-blue-700 transition-colors">Login</a>
            </nav>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="max-w-[1440px] mx-auto px-6 md:px-12 py-12 md:py-20 lg:py-24 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center" aria-labelledby="hero-title">
            <!-- Hero Content -->
            <div class="lg:col-span-7 space-y-8 text-left">
                <h1 id="hero-title" class="font-['Inter',sans-serif] font-bold text-black text-4xl md:text-5xl lg:text-[55px] leading-tight tracking-tight">
                    Kenapa harus pilih <br/>
                    <span class="font-['Playfair_Display',serif] font-bold text-[#0845d9]">Equogreen?</span>
                </h1>
                <p class="font-['Playfair_Display',serif] font-normal text-black text-lg md:text-xl lg:text-[22px] leading-relaxed max-w-[679px]">
                    <span class="font-bold">Equogreen</span>
                    <span class="font-['Inter',sans-serif] text-black"> adalah platform e-quotation Ecogreen <br/>yang </span>
                    <span class="font-['Inter',sans-serif] font-bold text-[#002eff]">terpercaya, fleksibel, serta membawa <br/>perubahan baru</span>
                    <span class="font-['Inter',sans-serif] text-black"> pada dunia quotation di era digital ini.</span>
                </p>

                <!-- Hero Features Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2" aria-label="Keunggulan utama">
                    <!-- Feature Card 1 -->
                    <article class="flex gap-3 p-4 bg-white rounded-[10px] border border-solid border-[#00000063] shadow-[4px_4px_4px_#00000040] hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                        <img class="w-[33px] h-[34px] object-contain flex-shrink-0" src="{{ asset('gambar/aman-biru.png') }}" alt="" />
                        <div>
                            <h4 class="font-['Playfair_Display',serif] font-bold text-black text-[15px] leading-snug">Aman dan Terpercaya</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[13px] mt-1 leading-normal">keamanan data menjadi prioritas kami</p>
                        </div>
                    </article>

                    <!-- Feature Card 2 -->
                    <article class="flex gap-3 p-4 bg-white rounded-[10px] border border-solid border-[#00000063] shadow-[4px_4px_4px_#00000040] hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                        <img class="w-[33px] h-[34px] object-contain flex-shrink-0" src="{{ asset('gambar/proses-biru.png') }}" alt="" />
                        <div>
                            <h4 class="font-['Playfair_Display',serif] font-bold text-black text-[15px] leading-snug">Proses Lebih Cepat</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[13px] mt-1 leading-normal">Buat, kirim dan kelola quotation dengan efisien</p>
                        </div>
                    </article>

                    <!-- Feature Card 3 -->
                    <article class="flex gap-3 p-4 bg-white rounded-[10px] border border-solid border-[#00000063] shadow-[4px_4px_4px_#00000040] hover:-translate-y-1 hover:shadow-lg transition-all duration-300">
                        <img class="w-[33px] h-[34px] object-contain flex-shrink-0" src="{{ asset('gambar/users-biru.png') }}" alt="" />
                        <div>
                            <h4 class="font-['Playfair_Display',serif] font-bold text-black text-[15px] leading-snug">Untuk Semua</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[13px] mt-1 leading-normal">Cocok untuk bisnis kecil hingga enterprise</p>
                        </div>
                    </article>
                </div>

                <!-- Pelajari Lebih Lanjut CTA Button -->
                <div class="pt-4">
                    <a href="#" class="inline-flex items-center justify-between w-[260px] h-[50px] bg-[#0946da] hover:bg-blue-700 text-white rounded-[10px] pl-[22px] pr-[20px] transition-all duration-300 hover:scale-[1.02] hover:shadow-lg relative group" aria-label="Pelajari lebih lanjut tentang Equogreen">
                        <span class="font-['Inter',sans-serif] font-medium text-lg">Pelajari Lebih Lanjut</span>
                        <!-- Custom SVG arrow -->
                        <svg class="w-[21px] h-[15px] text-white fill-none stroke-current stroke-[2.5] group-hover:translate-x-1.5 transition-transform duration-300" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Right Column Hero Illustration -->
            <div class="lg:col-span-5 flex justify-center">
                <img class="w-full max-w-[456px] h-auto object-contain hover:scale-105 transition-transform duration-500" src="{{ asset('gambar/main-biru.png') }}" alt="Ilustrasi dashboard dan fitur Equogreen" />
            </div>
        </section>

        <!-- Fitur Unggulan Section -->
        <section class="py-20 text-white relative overflow-hidden" style="background: linear-gradient(90deg, rgba(9,70,218,1) 0%, rgba(5,37,116,1) 100%);" aria-labelledby="fitur-title">
            <div class="max-w-[1440px] mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- Left Details -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#0946da] rounded-[15px] border border-solid border-[#ffffff8f]">
                        <div class="w-3 h-3 bg-[#d9d9d9] rounded-full"></div>
                        <div class="font-['Inter',sans-serif] font-medium text-xs tracking-wider">FITUR UNGGULAN</div>
                    </div>
                    <h2 id="fitur-title" class="font-['Inter',sans-serif] font-bold text-white text-[28px] leading-tight">
                        Fitur lengkap untuk quotation yang lebih efisien
                    </h2>
                    <p class="font-['Inter',sans-serif] font-normal text-white text-[15px] leading-relaxed">
                        <span class="font-bold">Equogreen</span> menghadirkan berbagai fitur unggulan yang dirancang untuk mempermudah dan mempercepat proses quotation Anda. Sistem ini tidak hanya modern, tetapi juga intuitif dan mudah digunakan oleh siapa saja.
                    </p>
                </div>

                <!-- Right Feature Cards Grid -->
                <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Feature Card 1 -->
                    <article class="bg-white p-6 rounded-[15px] shadow-[7px_8px_6px_#0000004a] text-center text-black flex flex-col justify-between min-h-[256px] hover:-translate-y-2 hover:shadow-[7px_12px_15px_#00000030] transition-all duration-300 cursor-pointer">
                        <img class="w-[68px] h-[49px] object-contain mx-auto" src="{{ asset('gambar/users-putih.png') }}" alt="" />
                        <div class="mt-6 flex-grow flex flex-col justify-center">
                            <h3 class="font-['Noto_Sans',sans-serif] font-bold text-[17px]">Mudah Digunakan</h3>
                            <p class="font-['Noto_Sans',sans-serif] font-normal text-slate-600 text-[15px] mt-4 leading-snug">Aplikasi ini ramah untuk semua kalangan umur</p>
                        </div>
                    </article>

                    <!-- Feature Card 2 -->
                    <article class="bg-white p-6 rounded-[15px] shadow-[7px_8px_6px_#0000004a] text-center text-black flex flex-col justify-between min-h-[256px] hover:-translate-y-2 hover:shadow-[7px_12px_15px_#00000030] transition-all duration-300 cursor-pointer">
                        <img class="w-[51px] h-[50px] object-contain mx-auto" src="{{ asset('gambar/aman-putih.png') }}" alt="" />
                        <div class="mt-6 flex-grow flex flex-col justify-center">
                            <h3 class="font-['Noto_Sans',sans-serif] font-bold text-[17px]">Aman dan Terpercaya</h3>
                            <p class="font-['Noto_Sans',sans-serif] font-normal text-slate-600 text-[15px] mt-4 leading-snug">Data terlindungi dan sistem dapat diandalkan.</p>
                        </div>
                    </article>

                    <!-- Feature Card 3 -->
                    <article class="bg-white p-6 rounded-[15px] shadow-[7px_8px_6px_#0000004a] text-center text-black flex flex-col justify-between min-h-[256px] hover:-translate-y-2 hover:shadow-[7px_12px_15px_#00000030] transition-all duration-300 cursor-pointer">
                        <img class="w-[50px] h-[51px] object-contain mx-auto" src="{{ asset('gambar/bell-putih.png') }}" alt="" />
                        <div class="mt-6 flex-grow flex flex-col justify-center">
                            <h3 class="font-['Noto_Sans',sans-serif] font-bold text-[17px]">Notifikasi real-time</h3>
                            <p class="font-['Noto_Sans',sans-serif] font-normal text-slate-600 text-[15px] mt-4 leading-snug">Pemberitahuan langsung saat ada penawaran baru.</p>
                        </div>
                    </article>

                    <!-- Feature Card 4 (Mudah Digunakan - Duplicated copy matches figma exactly) -->
                    <article class="bg-white p-6 rounded-[15px] shadow-[7px_8px_6px_#0000004a] text-center text-black flex flex-col justify-between min-h-[256px] hover:-translate-y-2 hover:shadow-[7px_12px_15px_#00000030] transition-all duration-300 cursor-pointer">
                        <img class="w-[60px] h-[50px] object-contain mx-auto" src="{{ asset('gambar/file-putih.png') }}" alt="" />
                        <div class="mt-6 flex-grow flex flex-col justify-center">
                            <h3 class="font-['Noto_Sans',sans-serif] font-bold text-[17px]">Mudah Digunakan</h3>
                            <p class="font-['Noto_Sans',sans-serif] font-normal text-slate-600 text-[15px] mt-4 leading-snug">Aplikasi ini ramah untuk semua kalangan umur</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Tata Cara Penggunaan Section -->
        <section class="max-w-[1440px] mx-auto px-6 md:px-12 py-20 lg:py-28" aria-labelledby="cara-penggunaan-title">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <!-- Left Details -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#0946da] rounded-[15px] text-white">
                        <div class="w-3 h-3 bg-[#d9d9d9] rounded-full"></div>
                        <div class="font-['Inter',sans-serif] font-medium text-xs tracking-wider">TATA CARA PENGGUNAAN</div>
                    </div>
                    <h2 id="cara-penggunaan-title" class="font-['Inter',sans-serif] font-bold text-3xl md:text-4xl text-black leading-tight">
                        Buat Quotation dalam<br/>
                        <span class="text-[#0946da]">Hitungan Menit</span>
                    </h2>
                    <p class="font-['Inter',sans-serif] font-normal text-black text-[15px] leading-relaxed">
                        Untuk menjalankan proses quotation, unduh lah file <br/>di bawah ini dan ikuti langkah langkahnya <br/>dengan cermat.
                    </p>
                    <div class="pt-2">
                        <a href="#" class="inline-flex items-center justify-between w-[263px] h-[50px] bg-[#0946da] hover:bg-blue-700 hover:scale-[1.02] hover:shadow-md text-white rounded-[10px] pl-[21px] pr-[15px] transition-all duration-300 relative group" aria-label="Download panduan penggunaan">
                            <span class="font-['Inter',sans-serif] font-normal text-lg">Download Panduan</span>
                            <img class="w-[26px] h-[23px] object-contain bg-transparent" src="{{ asset('gambar/download-biru.png') }}" alt="" />
                        </a>
                    </div>
                    
                    <!-- Puzzle Illustration -->
                    <div class="pt-8">
                        <img class="w-[230px] h-[183px] object-contain rounded-xl hover:scale-105 transition-transform duration-300" src="{{ asset('gambar/lamp.png') }}" alt="Ilustrasi panduan quotation" />
                    </div>
                </div>

                <!-- Right Steps Horizontal Flow -->
                <div class="lg:col-span-8 flex flex-col justify-center h-full">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 md:gap-4 relative w-full pt-8">
                        <!-- Step 1 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <!-- Badge Number -->
                            <div class="absolute -top-4 w-[35px] h-[35px] bg-[#0946da] rounded-full flex items-center justify-center text-white font-['Inter',sans-serif] font-bold text-[15px] z-20 group-hover:scale-110 transition-transform">1</div>
                            <!-- Circle Background -->
                            <div class="mt-4 w-[125px] h-[125px] bg-[#f1f5fe] rounded-full flex items-center justify-center relative overflow-hidden shadow-inner hover:scale-105 transition-transform duration-300">
                                <img class="w-[87px] h-[66px] object-contain bg-transparent" src="{{ asset('gambar/cloud-biru.png') }}" alt="" />
                            </div>
                            <!-- Text Details -->
                            <h4 class="font-['Noto_Sans',sans-serif] font-bold text-black text-[17px] mt-6">Unduh File</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[15px] mt-2 leading-relaxed max-w-[140px]">Download template atau dokumen yang diperlukan.</p>
                            
                            <!-- Custom SVG Arrow to Step 2 -->
                            <div class="hidden md:flex items-center justify-center absolute top-[62px] -right-[15px] -translate-y-1/2 w-6 h-6 z-30 pointer-events-none group-hover:translate-x-1 transition-transform duration-300">
                                <svg class="w-6 h-6 text-[#0946da]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <!-- Badge Number -->
                            <div class="absolute -top-4 w-[35px] h-[35px] bg-[#0946da] rounded-full flex items-center justify-center text-white font-['Inter',sans-serif] font-bold text-[15px] z-20 group-hover:scale-110 transition-transform">2</div>
                            <!-- Circle Background -->
                            <div class="mt-4 w-[125px] h-[125px] bg-[#f1f5fe] rounded-full flex items-center justify-center relative overflow-hidden shadow-inner hover:scale-105 transition-transform duration-300">
                                <img class="w-[61px] h-[68px] object-contain bg-transparent" src="{{ asset('gambar/file-biru.png') }}" alt="" />
                            </div>
                            <!-- Text Details -->
                            <h4 class="font-['Noto_Sans',sans-serif] font-bold text-black text-[17px] mt-6">Isi Data</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[15px] mt-2 leading-relaxed max-w-[140px]">Lengkapi data quotation dengan informasi yang sesuai.</p>
                            
                            <!-- Custom SVG Arrow to Step 3 -->
                            <div class="hidden md:flex items-center justify-center absolute top-[62px] -right-[15px] -translate-y-1/2 w-6 h-6 z-30 pointer-events-none group-hover:translate-x-1 transition-transform duration-300">
                                <svg class="w-6 h-6 text-[#0946da]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <!-- Badge Number -->
                            <div class="absolute -top-4 w-[35px] h-[35px] bg-[#0946da] rounded-full flex items-center justify-center text-white font-['Inter',sans-serif] font-bold text-[15px] z-20 group-hover:scale-110 transition-transform">3</div>
                            <!-- Circle Background -->
                            <div class="mt-4 w-[125px] h-[125px] bg-[#f1f5fe] rounded-full flex items-center justify-center relative overflow-hidden shadow-inner hover:scale-105 transition-transform duration-300">
                                <img class="w-[87px] h-[78px] object-contain bg-transparent" src="{{ asset('gambar/pesawat-biru.png') }}" alt="" />
                            </div>
                            <!-- Text Details -->
                            <h4 class="font-['Noto_Sans',sans-serif] font-bold text-black text-[17px] mt-6">Kirim</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[15px] mt-2 leading-relaxed max-w-[140px]">Kirim quotation ke klien anda dengan sekali klik</p>
                            
                            <!-- Custom SVG Arrow to Step 4 -->
                            <div class="hidden md:flex items-center justify-center absolute top-[62px] -right-[15px] -translate-y-1/2 w-6 h-6 z-30 pointer-events-none group-hover:translate-x-1 transition-transform duration-300">
                                <svg class="w-6 h-6 text-[#0946da]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex flex-col items-center text-center relative group">
                            <!-- Badge Number -->
                            <div class="absolute -top-4 w-[35px] h-[35px] bg-[#0946da] rounded-full flex items-center justify-center text-white font-['Inter',sans-serif] font-bold text-[15px] z-20 group-hover:scale-110 transition-transform">4</div>
                            <!-- Circle Background -->
                            <div class="mt-4 w-[125px] h-[125px] bg-[#f1f5fe] rounded-full flex items-center justify-center relative overflow-hidden shadow-inner hover:scale-105 transition-transform duration-300">
                                <img class="w-[90px] h-[79px] object-contain bg-transparent" src="{{ asset('gambar/centang-biru.png') }}" alt="" />
                            </div>
                            <!-- Text Details -->
                            <h4 class="font-['Noto_Sans',sans-serif] font-bold text-black text-[17px] mt-6">Kelola dan Pantau</h4>
                            <p class="font-['Inter',sans-serif] font-medium text-slate-600 text-[15px] mt-2 leading-relaxed max-w-[140px]">Pantau status dan kelola dengan mudah</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimoni Section -->
        <section class="bg-black text-white py-20 relative overflow-hidden" aria-labelledby="testimonial-title">
            <div class="max-w-[1440px] mx-auto px-6 md:px-12">
                <!-- Header -->
                <div class="space-y-6 mb-16">
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-[#002eff] rounded-[15px] border border-solid border-white/80 opacity-80">
                        <div class="w-3 h-3 bg-white rounded-full"></div>
                        <div class="font-['Inter',sans-serif] font-medium text-xs">APA KATA MEREKA?</div>
                    </div>
                    <h2 id="testimonial-title" class="font-['Inter',sans-serif] font-bold text-3xl md:text-4xl text-transparent bg-clip-text bg-gradient-to-r from-[#58aafc] to-white leading-tight">
                        What’s happening. <span class="text-white block mt-1 text-2xl md:text-3xl font-medium font-['Inter',sans-serif]">Apa saja tanggapan para pengguna</span>
                    </h2>
                </div>

                <!-- Testimonial Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="testimonials-container">
                    <!-- Testimonial Card 1 -->
                    <article class="bg-[#1c1b2b] p-8 rounded-[20px] relative min-h-[250px] flex flex-col justify-between testimonial-item border border-white/5 hover:-translate-y-1.5 hover:shadow-2xl hover:border-white/10 transition-all duration-300 cursor-pointer">
                        <div>
                            <!-- Checkmark Badge Image -->
                            <img class="absolute top-[5px] left-3 w-[47px] h-[42px] object-contain bg-transparent" src="{{ asset('gambar/verifikasi.png') }}" alt="" />
                            <p class="font-['Inter',sans-serif] font-normal text-white text-[17px] mt-6 leading-relaxed italic">
                                Equogreen sangat membantu tim kami dalam membuat quotation lebih cepat dan rapi. Sistem nya mudah digunakan dan fiturnya lengkap
                            </p>
                        </div>
                        <!-- Profile -->
                        <div class="mt-8 flex items-center gap-4">
                            <img class="w-[50px] h-[52px] object-cover rounded-full bg-slate-800" src="{{ asset('gambar/pengguna.png') }}" alt="Foto pengguna Achel Silitonga" />
                            <div>
                                <h4 class="font-['Playfair_Display',serif] font-bold text-white text-[15px]">Achel Silitonga</h4>
                                <p class="font-['Inter',sans-serif] font-normal text-white/60 text-[13px]">Manager umum, PT jongsong park</p>
                            </div>
                        </div>
                    </article>

                    <!-- Testimonial Card 2 -->
                    <article class="bg-[#1c1b2b] p-8 rounded-[20px] relative min-h-[250px] flex flex-col justify-between testimonial-item border border-white/5 hover:-translate-y-1.5 hover:shadow-2xl hover:border-white/10 transition-all duration-300 cursor-pointer">
                        <div>
                            <img class="absolute top-[5px] left-3 w-[47px] h-[42px] object-contain bg-transparent" src="{{ asset('gambar/verifikasi.png') }}" alt="" />
                            <p class="font-['Inter',sans-serif] font-normal text-white text-[17px] mt-6 leading-relaxed italic">
                                Equogreen sangat membantu tim kami dalam membuat quotation lebih cepat dan rapi. Sistem nya mudah digunakan dan fiturnya lengkap
                            </p>
                        </div>
                        <div class="mt-8 flex items-center gap-4">
                            <img class="w-[50px] h-[52px] object-cover rounded-full bg-slate-800" src="{{ asset('gambar/pengguna.png') }}" alt="Foto pengguna Achel Silitonga" />
                            <div>
                                <h4 class="font-['Playfair_Display',serif] font-bold text-white text-[15px]">Achel Silitonga</h4>
                                <p class="font-['Inter',sans-serif] font-normal text-white/60 text-[13px]">Manager umum, PT jongsong park</p>
                            </div>
                        </div>
                    </article>

                    <!-- Testimonial Card 3 -->
                    <article class="bg-[#1c1b2b] p-8 rounded-[20px] relative min-h-[250px] flex flex-col justify-between testimonial-item border border-white/5 hover:-translate-y-1.5 hover:shadow-2xl hover:border-white/10 transition-all duration-300 cursor-pointer">
                        <div>
                            <img class="absolute top-[5px] left-3 w-[47px] h-[42px] object-contain bg-transparent" src="{{ asset('gambar/verifikasi.png') }}" alt="" />
                            <p class="font-['Inter',sans-serif] font-normal text-white text-[17px] mt-6 leading-relaxed italic">
                                Equogreen sangat membantu tim kami dalam membuat quotation lebih cepat dan rapi. Sistem nya mudah digunakan dan fiturnya lengkap
                            </p>
                        </div>
                        <div class="mt-8 flex items-center gap-4">
                            <img class="w-[50px] h-[52px] object-cover rounded-full bg-slate-800" src="{{ asset('gambar/pengguna.png') }}" alt="Foto pengguna Achel Silitonga" />
                            <div>
                                <h4 class="font-['Playfair_Display',serif] font-bold text-white text-[15px]">Achel Silitonga</h4>
                                <p class="font-['Inter',sans-serif] font-normal text-white/60 text-[13px]">Manager umum, PT jongsong park</p>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Testimonial Slider Indicators -->
                <div class="flex justify-center gap-6 mt-12" id="testimonial-slider-dots">
                    <span class="w-[11px] h-[11px] rounded-full bg-[#d9d9d9] cursor-pointer" data-index="0"></span>
                    <span class="w-[11px] h-[11px] rounded-full bg-[#4039c9] cursor-pointer" data-index="1"></span>
                    <span class="w-[11px] h-[11px] rounded-full bg-[#d9d9d9] cursor-pointer" data-index="2"></span>
                    <span class="w-[11px] h-[11px] rounded-full bg-[#d9d9d9] opacity-70 cursor-pointer" data-index="3"></span>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="max-w-[1440px] mx-auto px-6 md:px-12 py-20 lg:py-28" aria-labelledby="cta-title">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <!-- CTA Content -->
                <div class="lg:col-span-6 space-y-6">
                    <h2 id="cta-title" class="font-['Inter',sans-serif] font-bold text-3xl md:text-4xl lg:text-[32px] text-black leading-tight">
                        Mari bergabung <br/>dengan 
                        <span class="text-[#0946da]"> Equogreen</span>
                    </h2>
                    <p class="font-['Inter',sans-serif] font-normal text-black text-[15px] leading-relaxed max-w-[306px]">
                        Apakah anda siap untuk menjalin kerjasama<br/>bersama Ecogreen melalui Equogreen?
                    </p>
                    <div class="pt-4">
                        <a href="#" class="inline-flex items-center justify-between w-[245px] h-[50px] bg-[#0946da] hover:bg-blue-700 hover:scale-[1.02] hover:shadow-md text-white rounded-[10px] pl-[21px] pr-[10px] transition-all duration-300 group" aria-label="Kunjungi website Equogreen">
                            <span class="font-['Inter',sans-serif] font-normal text-lg">Kunjungi Website</span>
                            <img class="w-[37px] h-[35px] object-contain bg-transparent" src="{{ asset('gambar/website-biru.png') }}" alt="" />
                        </a>
                    </div>
                </div>  

                <!-- Right Column Laptop Illustration -->
                <div class="lg:col-span-6 flex justify-center lg:justify-end">
                    <img class="w-full max-w-[690px] h-auto object-contain hover:scale-[1.02] transition-transform duration-500" src="{{ asset('gambar/semimain.png') }}" alt="Ilustrasi Equogreen dan dashboard quotation" />
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white pt-16 pb-12" role="contentinfo">
        <div class="max-w-[1440px] mx-auto px-6 md:px-12">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
                <!-- Brand / Logo Info Column -->
                <div class="md:col-span-6 space-y-4">
                    <div class="font-['Inter',sans-serif] font-bold text-white text-[17px]">Logo</div>
                    <p class="font-['Inter',sans-serif] font-normal text-white text-[17px] leading-snug">Aplikasi e-quotation terpercaya</p>
                    <p class="font-['Inter',sans-serif] font-normal text-white/60 text-[17px] leading-snug">Platform quotation pilihan milik ecogreen</p>
                </div>

                <!-- Features Links Column -->
                <div class="md:col-span-3 space-y-4">
                    <h3 class="font-['Inter',sans-serif] font-bold text-white text-[17px]">Fitur</h3>
                    <ul class="space-y-2 text-slate-400 font-['Inter',sans-serif] text-[15px] list-none p-0 m-0 animate-pulse">
                        <li>Registrasi vendor</li>
                        <li>Pemberitahuan real-time</li>
                        <li>Pengajuan barang</li>
                    </ul>
                </div>

                <!-- Bantuan Links Column -->
                <div class="md:col-span-3 space-y-4">
                    <h3 class="font-['Inter',sans-serif] font-bold text-white text-[17px]">Bantuan</h3>
                    <ul class="space-y-2 text-slate-400 font-['Inter',sans-serif] text-[15px] list-none p-0 m-0">
                        <li>Kontak Support</li>
                        <li>FAQ</li>
                        <li>Privasi dan</li>
                        <li>Keamanan</li>
                    </ul>
                </div>
            </div>

            <!-- Footer Divider Line -->
            <div class="w-full my-8 border-t border-slate-800"></div>

            <!-- Copyright Notice -->
            <p class="text-center md:text-left text-slate-500 font-['Source_Sans_Pro',sans-serif] text-base">
                &copy; 2026 Equogreen. Platform quotation terpercaya milik Ecogreen.
            </p>
        </div>
    </footer>

    <!-- Hamburger dropdown menu interactive JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            // Simple responsive slider functionality
            const dots = document.querySelectorAll('#testimonial-slider-dots span');
            const items = document.querySelectorAll('.testimonial-item');

            function updateSlider(activeIndex) {
                dots.forEach((dot, index) => {
                    if (index === activeIndex) {
                        dot.classList.remove('bg-[#d9d9d9]');
                        dot.classList.add('bg-[#4039c9]');
                    } else {
                        dot.classList.remove('bg-[#4039c9]');
                        dot.classList.add('bg-[#d9d9d9]');
                    }
                });

                if (window.innerWidth < 768) {
                    items.forEach((item, index) => {
                        if (index === activeIndex % items.length) {
                            item.style.display = 'flex';
                            item.style.opacity = '1';
                        } else {
                            item.style.display = 'none';
                            item.style.opacity = '0';
                        }
                    });
                } else {
                    items.forEach((item) => {
                        item.style.display = 'flex';
                        item.style.opacity = '1';
                    });
                }
            }

            dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    updateSlider(index);
                });
            });

            window.addEventListener('resize', () => {
                const activeDot = document.querySelector('#testimonial-slider-dots .bg-[#4039c9]');
                const activeIndex = activeDot ? parseInt(activeDot.getAttribute('data-index')) : 1;
                updateSlider(activeIndex);
            });

            // Init slider to index 1 (default active in Figma reference layout)
            updateSlider(1);
        });
    </script>
</body>

</html>