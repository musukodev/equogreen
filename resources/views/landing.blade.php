<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Equogreen</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white text-black antialiased">

    <!-- Header / Navbar -->
    <header class="bg-white border-b-2 border-gray-100 sticky top-0 z-50 backdrop-blur-md bg-white/95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-[90px] lg:h-[123px]">
                <!-- Logo & Brand Name -->
                <a href="#" class="flex items-center gap-3 group">
                    <img class="w-16 h-16 lg:w-[100px] lg:h-[100px] object-cover transition-transform duration-300 group-hover:rotate-6" src="{{ asset('gambar/logo-cokelat.png') }}"
                        alt="Logo Equogreen" />
                    <span class="font-sans font-bold text-2xl lg:text-[35px] tracking-tight text-black transition-colors duration-300 group-hover:text-primary">Equogreen</span>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-8" aria-label="Navigasi utama">
                    <a href="#" class="font-normal text-black text-2xl hover:text-primary hover:scale-105 transition-all duration-200">Beranda</a>
                    <a href="#" class="font-normal text-black text-2xl hover:text-primary hover:scale-105 transition-all duration-200">Registrasi Vendor</a>
                    <a href="#" class="font-normal text-black text-2xl hover:text-primary hover:scale-105 transition-all duration-200">Produk</a>
                    <a href="#" class="font-normal text-black text-2xl hover:text-primary hover:scale-105 transition-all duration-200">Developer</a>
                </nav>

                <!-- Login Button & Mobile Menu Toggle -->
                <div class="flex items-center gap-4">
                    <a href="/login"
                        class="hidden sm:flex items-center justify-center w-[160px] lg:w-[225px] h-[45px] bg-[#002eff] hover:bg-blue-700 text-white text-xl lg:text-2xl font-normal rounded-xl transition-all duration-300 shadow-md hover:shadow-blue-500/20 transform hover:-translate-y-0.5">
                        Login
                    </a>

                    <!-- Hamburger Button -->
                    <button id="menu-btn" type="button"
                        class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none transition-colors"
                        aria-expanded="false">
                        <span class="sr-only">Buka menu utama</span>
                        <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (Hidden by default) -->
        <div id="mobile-menu" class="hidden lg:hidden border-t border-gray-100 bg-white">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#"
                    class="block py-2 text-xl font-normal text-black hover:text-primary hover:pl-2 transition-all duration-200">Beranda</a>
                <a href="#"
                    class="block py-2 text-xl font-normal text-black hover:text-primary hover:pl-2 transition-all duration-200">Registrasi Vendor</a>
                <a href="#"
                    class="block py-2 text-xl font-normal text-black hover:text-primary hover:pl-2 transition-all duration-200">Produk</a>
                <a href="#"
                    class="block py-2 text-xl font-normal text-black hover:text-primary hover:pl-2 transition-all duration-200">Developer</a>
                <a href="/login"
                    class="block w-full text-center mt-4 py-3 bg-[#002eff] text-white text-xl font-normal rounded-xl hover:bg-blue-700 transition-colors">Login</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Hero Section -->
        <section class="relative bg-white py-16 lg:py-24 overflow-hidden" aria-labelledby="hero-title">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                    <!-- Hero Content -->
                    <div class="lg:col-span-7 space-y-8 text-left z-10">
                        <h1 id="hero-title"
                            class="text-[45px] sm:text-[75px] lg:text-[90px] font-normal text-black tracking-tight leading-[1.1]">
                            Kenapa harus pilih <br />
                            <span class="font-serif font-bold text-black">Equogreen?</span>
                        </h1>
                        <p
                            class="text-xl sm:text-[28px] lg:text-[34px] text-black leading-relaxed font-sans max-w-3xl">
                            <span class="font-bold">Equogreen</span> adalah website quotation Ecogreen yang
                            <span class="font-bold">terpercaya, fleksibel, serta membawa perubahan baru</span>
                            pada dunia quotation di era digital ini.
                        </p>
                    </div>
                    <!-- Hero Image -->
                    <div class="lg:col-span-5 flex justify-center">
                        <img class="w-full max-w-[400px] lg:max-w-none h-auto object-contain mt-8 lg:mt-0 lg:absolute lg:right-0 lg:top-20 lg:w-[800px] transition-transform duration-500 hover:scale-[1.02]"
                            src="{{ asset('gambar/landing.png') }}" alt="Ilustrasi abstrak Equogreen" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Fitur Unggulan Section -->
        <section class="bg-black text-white py-20 lg:py-24" aria-labelledby="fitur-unggulan-title">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center space-y-6 mb-16">
                    <h2 id="fitur-unggulan-title" class="text-[35px] lg:text-[45px] font-bold tracking-tight">Fitur
                        Unggulan</h2>
                    <p class="text-lg sm:text-2xl lg:text-3xl text-white leading-relaxed max-w-6xl mx-auto">
                        <span class="font-bold">Equogreen</span> menghadirkan berbagai fitur unggulan yang dirancang
                        untuk mempermudah dan mempercepat proses quotation Anda. Sistem ini tidak hanya modern, tetapi
                        juga intuitif dan mudah digunakan oleh siapa saja.
                    </p>
                </div>

                <!-- Features Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Card 1 (Mudah digunakan) -->
                    <article
                        class="bg-[#4039c9] hover:bg-[#342da8] p-6 rounded-2xl shadow-lg relative min-h-[230px] flex flex-col justify-between transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/20 group cursor-pointer">
                        <div>
                            <div class="flex items-start gap-4">
                                <img class="w-[65px] h-[68px] object-contain transition-transform duration-300 group-hover:scale-110" src="{{ asset('gambar/user.png') }}"
                                    alt="" aria-hidden="true" />
                                <h3 class="text-white font-bold text-xl lg:text-[25px] leading-tight pt-1">Mudah <br />digunakan
                                </h3>
                            </div>
                            <p class="text-white text-lg lg:text-[22px] text-center mt-8 leading-normal">Aplikasi ini ramah untuk
                                semua kalangan umur</p>
                        </div>
                    </article>

                    <!-- Card 2 (Aman dan Terpercaya) -->
                    <article
                        class="bg-[#4039c9] hover:bg-[#342da8] p-6 rounded-2xl shadow-lg relative min-h-[230px] flex flex-col justify-between transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/20 group cursor-pointer">
                        <div>
                            <div class="flex items-start gap-4">
                                <img class="w-[65px] h-[68px] object-contain transition-transform duration-300 group-hover:scale-110" src="{{ asset('gambar/lock.png') }}"
                                    alt="" aria-hidden="true" />
                                <h3 class="text-white font-bold text-xl lg:text-[25px] leading-tight pt-1">Aman dan
                                    <br />Terpercaya
                                </h3>
                            </div>
                            <p class="text-white text-lg lg:text-[22px] text-center mt-8 leading-normal">Data terlindungi dan
                                sistem dapat diandalkan.</p>
                        </div>
                    </article>

                    <!-- Card 3 (Notifikasi Real-time) -->
                    <article
                        class="bg-[#4039c9] hover:bg-[#342da8] p-6 rounded-2xl shadow-lg relative min-h-[230px] flex flex-col justify-between transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/20 group cursor-pointer">
                        <div>
                            <div class="flex items-start gap-4">
                                <img class="w-[65px] h-[68px] object-contain transition-transform duration-300 group-hover:scale-110" src="{{ asset('gambar/lonceng.png') }}"
                                    alt="" aria-hidden="true" />
                                <h3 class="text-white font-bold text-xl lg:text-[25px] leading-tight pt-1">Notifikasi
                                    <br />Real-time
                                </h3>
                            </div>
                            <p class="text-white text-lg lg:text-[22px] text-center mt-8 leading-normal">Pemberitahuan langsung
                                saat ada penawaran baru.</p>
                        </div>
                    </article>

                    <!-- Card 4 (Arsip Digital) -->
                    <article
                        class="bg-[#4039c9] hover:bg-[#342da8] p-6 rounded-2xl shadow-lg relative min-h-[230px] flex flex-col justify-between transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl hover:shadow-indigo-500/20 group cursor-pointer">
                        <div>
                            <div class="flex items-start gap-4">
                                <img class="w-[65px] h-[68px] object-contain transition-transform duration-300 group-hover:scale-110" src="{{ asset('gambar/cari.png') }}"
                                    alt="" aria-hidden="true" />
                                <h3 class="text-white font-bold text-xl lg:text-[25px] leading-tight pt-1">Arsip <br />Digital</h3>
                            </div>
                            <p class="text-white text-lg lg:text-[22px] text-center mt-8 leading-normal">Semua data quotation
                                tersimpan rapi dan mudah dicari kembali.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Tata Cara Penggunaan & Testimonial Section -->
        <section class="bg-black text-white py-16 lg:py-20 border-t border-white/10" aria-labelledby="tata-cara-title">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Tata Cara Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-24">
                    <!-- Text & Download -->
                    <div class="space-y-6">
                        <h2 id="tata-cara-title" class="text-[35px] lg:text-[45px] font-bold tracking-tight">Tata Cara
                            Penggunaan</h2>
                        <p class="text-lg sm:text-xl lg:text-2xl text-white leading-relaxed max-w-xl">
                            Untuk menjalankan proses quotation, unduh lah file di bawah ini dan ikuti langkah langkahnya
                            dengan cermat
                        </p>
                        <div class="pt-4">
                            <button type="button"
                                class="inline-flex items-center justify-center px-8 py-4 bg-[#002eff] hover:bg-blue-700 text-white font-bold text-lg rounded shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-500/35 cursor-pointer">
                                <span>Download</span>
                            </button>
                        </div>
                    </div>
                    <!-- Illustration -->
                    <div class="flex justify-center lg:justify-end">
                        <img class="w-full max-w-[400px] lg:max-w-[450px] h-auto object-contain transition-transform duration-500 hover:scale-105" src="{{ asset('gambar/lamp.png') }}"
                            alt="Ilustrasi Tata Cara Penggunaan" />
                    </div>
                </div>

                <!-- TESTIMONI -->
                <section class="bg-black pb-24">
                    <div class="max-w-7xl mx-auto px-6">

                        <div class="bg-zinc-900 rounded-2xl p-8 transition-transform duration-300 hover:scale-[1.01]">

                            <h2 class="text-white text-3xl mb-2">
                                What's happening.
                            </h2>

                            <p class="text-gray-300 mb-8">
                                Apa saja tanggapan para pengguna
                            </p>

                            <!-- Wrapper Slider -->
                            <div class="relative">

                                <!-- Tombol Kiri -->
                                <button
                                    class="absolute left-0 top-1/2 -translate-y-1/2 z-10 text-white hover:text-gray-300 hover:scale-115 transition-transform duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>

                                <!-- Slider -->
                                <div
                                    class="mx-16 h-[400px] rounded-xl bg-zinc-700 flex items-center justify-center text-gray-300 font-bold text-2xl">
                                    TESTIMONIAL / SLIDER
                                </div>

                                <!-- Tombol Kanan -->
                                <button
                                    class="absolute right-0 top-1/2 -translate-y-1/2 z-10 text-white hover:text-gray-300 hover:scale-115 transition-transform duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                            </div>

                        </div>

                    </div>
                </section>
            </div>
        </section>
        <!-- CTA Section -->
        <section class="bg-white py-20 lg:py-24" aria-labelledby="cta-title">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <!-- CTA Content -->
                    <div class="lg:col-span-7 space-y-8 text-left">
                        <h2 id="cta-title"
                            class="text-[35px] sm:text-[45px] lg:text-[50px] font-bold text-accent tracking-tight leading-tight">
                            Mari bergabung dengan Equogreen,
                        </h2>
                        <p class="text-xl sm:text-2xl lg:text-[32px] text-black leading-relaxed max-w-2xl">
                            Apakah anda siap untuk menjalin kerjasama bersama Ecogreen melalui Equogreen?
                        </p>
                        <div class="pt-4">
                            <a href="#"
                                class="inline-flex items-center justify-center w-[220px] lg:w-[285px] h-[67px] bg-[#002eff] hover:bg-blue-700 text-white text-xl lg:text-[28px] rounded-xl shadow-md transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-blue-500/20">
                                Kunjungi website
                            </a>
                        </div>
                    </div>
                    <!-- CTA Image -->
                    <div class="lg:col-span-5 flex justify-center">
                        <img class="w-full max-w-[380px] lg:max-w-[473px] h-auto object-contain transition-transform duration-500 hover:scale-105" src="{{ asset('gambar/mac.png') }}"
                            alt="Ilustrasi Mac" />
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white pt-16 pb-12 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 pb-12">
                <!-- Brand / Logo Col -->
                <div class="md:col-span-6 space-y-6 flex flex-col md:flex-row items-start gap-4 lg:gap-8">
                    <!-- Logo Label -->
                    <div class="text-2xl lg:text-[30px] font-bold text-white pt-16">Logo</div>

                    <!-- Text Details -->
                    <div class="space-y-4">
                        <div class="text-2xl lg:text-[30px] font-bold text-white">Equogreen</div>
                        <p class="text-xl lg:text-[30px] text-white">Aplikasi e-quotation terpercaya</p>
                        <p class="text-xl lg:text-[30px] text-white opacity-60">Platform quotation pilihan milik
                            ecogreen</p>
                    </div>
                </div>

                <!-- Features Col -->
                <div class="md:col-span-3 space-y-4">
                    <h3 class="font-bold text-2xl lg:text-[30px] text-white">Fitur</h3>
                    <ul class="space-y-2 text-white text-lg lg:text-[24px]">
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all duration-200 inline-block">Registrasi vendor</a></li>
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all duration-200 inline-block">Pemberitahuan real-time</a></li>
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all duration-200 inline-block">Pengajuan barang</a></li>
                    </ul>
                </div>

                <!-- Bantuan Col -->
                <div class="md:col-span-3 space-y-4">
                    <h3 class="font-bold text-2xl lg:text-[30px] text-white">Bantuan</h3>
                    <ul class="space-y-2 text-white text-lg lg:text-[24px]">
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all duration-200 inline-block">Kontak Support</a></li>
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all duration-200 inline-block">FAQ</a></li>
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all duration-200 inline-block">Privasi dan
                                <br />Keamanan</a></li>
                    </ul>
                </div>
            </div>

            <!-- Separator Line -->
            <div class="border-t border-white/20 my-8"></div>

            <!-- Bottom Section -->
            <div class="flex flex-col items-center justify-center text-center">
                <p class="text-lg sm:text-xl lg:text-[24px] text-white/80">
                    &copy; 2026 Equogreen. Platform quotation terpercaya milik Ecogreen.
                </p>
            </div>
        </div>
    </footer>

    <!-- Script for mobile menu -->
    <script>
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>