<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equogreen Landing Page</title>
    <!-- Using Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            main: '#2a5a3b', /* Dark Green */
                            accent: '#FACC15', /* Yellow */
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
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-bg {
            background-image: linear-gradient(rgba(240,245,240,0.8), rgba(240,245,240,0.8)), url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
        }
        .cta-bg {
            background-color: #FBBF24;
            overflow: hidden;
        }
        .pattern-bg {
            background-image: radial-gradient(#FBBF24 2px, transparent 2px);
            background-size: 20px 20px;
        }
        
        .leaf-svg {
            position: absolute;
            opacity: 0.15;
            color: #d97706;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar -->
    <nav class="bg-white/95 backdrop-blur-md border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <img src="logo.png" alt="Equogreen Logo" class="h-12 w-auto object-contain">
                    <span class="font-extrabold text-2xl text-[#3d2c23] tracking-tight">Equogreen</span>
                </div>
                <!-- Links -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#" class="text-gray-600 hover:text-brand-main font-semibold text-sm transition-colors">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-brand-main font-semibold text-sm transition-colors">Registrasi Vendor</a>
                    <a href="#" class="bg-brand-main hover:bg-green-800 text-white px-8 py-2.5 rounded-md font-semibold transition duration-150 ease-in-out text-sm shadow-md">Login</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-bg py-24 lg:py-32 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="md:w-3/5">
                <h1 class="text-4xl md:text-5xl lg:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    Kenapa harus pilih<br>Equo<span class="text-brand-main">green</span>?
                </h1>
                <p class="text-lg md:text-xl text-gray-800 leading-relaxed font-medium md:w-5/6">
                    Karena <span class="font-bold">Equo<span class="text-brand-main">green</span></span> adalah website quotation Ecogreen yang terpercaya, fleksibel, serta membawa perubahan baru pada dunia quotation di era digital ini.
                </p>
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan Section -->
    <section class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-16 max-w-3xl mx-auto">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-brand-main mb-6">Fitur Unggulan</h2>
                <p class="text-gray-600 leading-relaxed text-lg">
                    <span class="font-bold text-gray-900">Equo<span class="text-brand-main">green</span></span> menghadirkan berbagai fitur unggulan yang dirancang untuk mempermudah dan mempercepat proses quotation Anda. Sistem ini tidak hanya modern, tetapi juga intuitif dan mudah digunakan oleh siapa saja.
                </p>
            </div>

            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-16">
                <!-- Illustration Left -->
                <div class="md:w-5/12 relative">
                    <div class="absolute inset-0 pattern-bg opacity-40 transform -translate-x-6 translate-y-6 rounded-lg -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1550989460-0adf9ea622e2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Illustration" class="rounded-2xl shadow-xl w-full object-cover h-[28rem]">
                </div>
                
                <!-- 4 Cards Right -->
                <div class="md:w-7/12 grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-brand-main text-white p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <i class="fa-solid fa-users text-3xl"></i>
                            <h3 class="font-extrabold text-xl leading-tight">Mudah<br>digunakan</h3>
                        </div>
                        <p class="text-sm text-green-50/90 font-medium">Aplikasi ini ramah untuk semua kalangan umur.</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-brand-main text-white p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <i class="fa-solid fa-lock text-3xl"></i>
                            <h3 class="font-extrabold text-xl leading-tight">Aman dan<br>Terpercaya</h3>
                        </div>
                        <p class="text-sm text-green-50/90 font-medium">Data terlindungi dan sistem dapat diandalkan.</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-brand-main text-white p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <i class="fa-solid fa-bell text-3xl"></i>
                            <h3 class="font-extrabold text-xl leading-tight">Notifikasi<br>Real-time</h3>
                        </div>
                        <p class="text-sm text-green-50/90 font-medium">Pemberitahuan langsung saat ada penawaran baru atau perubahan status.</p>
                    </div>
                    <!-- Card 4 -->
                    <div class="bg-brand-main text-white p-6 lg:p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <i class="fa-solid fa-folder-open text-3xl"></i>
                            <h3 class="font-extrabold text-xl leading-tight">Arsip<br>Digital</h3>
                        </div>
                        <p class="text-sm text-green-50/90 font-medium">Semua data quotation tersimpan rapi dan mudah dicari kembali.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tata Cara Penggunaan Section -->
    <section class="py-24 bg-gray-50/50 overflow-hidden">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col md:flex-row items-center gap-12 lg:gap-16">
                <!-- Content Left -->
                <div class="md:w-5/12 order-2 md:order-1 relative z-10">
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-brand-main mb-6">Tata Cara Penggunaan</h2>
                    <p class="text-gray-700 leading-relaxed mb-8 text-lg font-medium">
                        Untuk menjalankan proses quotation, unduh lah file di bawah ini dan ikuti langkah langkahnya dengan cermat
                    </p>
                    <button class="bg-brand-main hover:bg-green-800 text-white px-10 py-3.5 rounded-md font-bold transition duration-150 ease-in-out shadow-lg mb-3">
                        Unduh
                    </button>
                    <p class="text-sm text-gray-500 font-medium">Unduh Tata Cara Penggunaan</p>
                </div>
                
                <!-- Illustration Right -->
                <div class="md:w-7/12 order-1 md:order-2 relative">
                    <div class="absolute inset-0 pattern-bg opacity-40 transform translate-x-6 -translate-y-6 rounded-lg -z-10"></div>
                    <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Tata Cara" class="rounded-2xl shadow-xl w-full object-cover h-[28rem]">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-bg py-24 relative text-center">
        <!-- SVG Leaves placeholders -->
        <svg class="leaf-svg top-0 left-0 w-80 h-80 -translate-x-1/2 -translate-y-1/4" viewBox="0 0 100 100" fill="currentColor">
            <path d="M50 0 C70 0 90 20 90 50 C90 80 70 100 50 100 C30 100 10 80 10 50 C10 20 30 0 50 0 Z" />
        </svg>
        <svg class="leaf-svg bottom-0 right-0 w-[400px] h-[400px] translate-x-1/4 translate-y-[10%]" viewBox="0 0 100 100" fill="currentColor">
            <path d="M50 0 C70 0 90 20 90 50 C90 80 70 100 50 100 C30 100 10 80 10 50 C10 20 30 0 50 0 Z" />
        </svg>

        <div class="max-w-4xl mx-auto px-4 relative z-10 space-y-8">
            <h2 class="text-3xl md:text-5xl font-extrabold text-brand-main mb-2">
                Mari bergabung dengan Equo<span class="text-white">green</span>,
            </h2>
            <p class="text-xl md:text-2xl text-white font-semibold mb-8">
                Apakah anda siap untuk menjalin kerjasama<br>bersama Ecogreen melalui Equogreen?
            </p>
            <button class="bg-brand-main hover:bg-green-800 text-white px-8 py-4 rounded-md font-bold transition duration-150 ease-in-out shadow-lg flex items-center justify-center gap-3 mx-auto text-lg mt-8">
                Kunjungi website <i class="fa-solid fa-chevron-right text-sm"></i>
            </button>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white pt-20 pb-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                <!-- Column 1: Logo & Info -->
                <div class="md:col-span-5 space-y-6">
                    <div class="flex items-center gap-3 mb-2">
                        <img src="logo.png" alt="Logo Footer" class="h-12 w-auto object-contain bg-white rounded-lg p-1">
                        <span class="font-extrabold text-2xl text-white tracking-tight">Equogreen</span>
                    </div>
                    <div class="space-y-1">
                        <p class="text-gray-300 font-medium">Aplikasi e-quotation terpercaya</p>
                        <p class="text-gray-300 font-medium">Platform quotation pilihan milik ecogreen</p>
                    </div>
                </div>
                <!-- Column 2: Fitur -->
                <div class="md:col-span-3 space-y-6">
                    <h4 class="font-bold text-lg">Fitur</h4>
                    <ul class="space-y-4 text-sm text-gray-300 font-medium">
                        <li><a href="#" class="hover:text-white transition">Registrasi vendor</a></li>
                        <li><a href="#" class="hover:text-white transition">Pemberitahuan real-time</a></li>
                        <li><a href="#" class="hover:text-white transition">Pengadaan barang</a></li>
                    </ul>
                </div>
                <!-- Column 3: Bantuan -->
                <div class="md:col-span-4 space-y-6">
                    <h4 class="font-bold text-lg">Bantuan</h4>
                    <ul class="space-y-4 text-sm text-gray-300 font-medium">
                        <li><a href="#" class="hover:text-white transition">Kontak Support</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Privasi dan Keamanan</a></li>
                    </ul>
                </div>
            </div>
            
            <!-- Bottom Copyright -->
            <div class="border-t border-gray-800 pt-8 flex justify-center text-center">
                <p class="text-xs text-gray-500 font-medium tracking-wide">
                    &copy; 2024 Equogreen. Platform quotation terpercaya milik Ecogreen.
                </p>
            </div>
        </div>
    </footer>
</body>
</html>
