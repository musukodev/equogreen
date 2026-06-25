<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Equogreen Procurement</title>
    <meta name="description" content="Masuk ke platform Equogreen untuk mengelola quotation dan pengadaan vendor Anda.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            blue: '#1d4ed8',
                        }
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                        'blob-delay': 'blob 9s infinite 2s',
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.5s ease-out forwards',
                    },
                    keyframes: {
                        blob: {
                            '0%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                            '33%': {
                                transform: 'translate(30px, -50px) scale(1.1)'
                            },
                            '66%': {
                                transform: 'translate(-20px, 20px) scale(0.9)'
                            },
                            '100%': {
                                transform: 'translate(0px, 0px) scale(1)'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            },
                        },
                        fadeInUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(30px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="font-inter flex min-h-screen bg-slate-50 antialiased">

    <!-- Full-screen split layout -->
    <div class="relative z-10 flex min-h-screen w-full flex-col md:flex-row">

        <!-- Left panel (full on desktop, stacked on mobile) -->
        <div
            class="relative flex w-full flex-col overflow-hidden bg-blue-700 p-6 text-white md:min-h-screen md:w-[45%] md:p-8 lg:p-10 xl:p-12">

            <!-- Background decorations -->
            <div class="pointer-events-none absolute inset-0 opacity-10"
                style="background-image: radial-gradient(white 1.5px, transparent 1.5px); background-size: 24px 24px;">
            </div>
            <!-- Gradient overlay at bottom -->
            <div class="pointer-events-none absolute bottom-0 left-0 right-0 h-64"
                style="background: linear-gradient(to top, rgba(17,53,148,0.5), transparent);"></div>
            <!-- Decorative circles -->
            <div
                class="pointer-events-none absolute -bottom-24 -right-24 h-72 w-72 rounded-full border border-white/10">
            </div>
            <div
                class="pointer-events-none absolute -bottom-16 -right-16 h-52 w-52 rounded-full border border-white/10">
            </div>
            <div class="pointer-events-none absolute -right-32 top-1/2 h-64 w-64 rounded-full bg-blue-600/40"></div>

            <div class="relative z-10 flex h-full flex-col">
                <!-- Logo Header -->
                <div class="animate-fade-in-up mb-4 flex items-center gap-3 opacity-0 md:mb-5 md:gap-3 lg:mb-6"
                    style="animation-delay: 50ms;">
                    <img src="{{ asset('gambar/logo-putih.png') }}" alt="Equogreen Logo"
                        class="h-10 w-auto object-contain drop-shadow-sm md:h-12 lg:h-14">
                    <span
                        class="text-2xl font-bold leading-none tracking-wide text-white md:text-2xl lg:text-3xl">Equogreen</span>
                </div>

                <!-- Main Copy -->
                <div class="animate-fade-in-up mb-4 opacity-0 md:mb-5 lg:mb-6" style="animation-delay: 150ms;">
                    <span
                        class="mb-2.5 inline-block rounded-full border border-white/20 bg-white/15 px-3 py-1 text-[10px] font-semibold uppercase tracking-widest text-blue-100 md:mb-3 md:text-xs">E-Quotation
                        Platform</span>
                    <h1
                        class="mb-2 text-[1.8rem] font-bold leading-tight md:text-[2.2rem] lg:text-[2.5rem] xl:text-[2.8rem]">
                        Kelola Quotation<br>& Vendor dalam<br>Satu Platform
                    </h1>
                    <p class="pr-2 text-sm leading-relaxed text-blue-100 opacity-95 md:pr-4 md:text-xs lg:text-sm">
                        Kirim RFQ, terima penawaran vendor, evaluasi harga, dan setujui PO — semua digital.
                    </p>
                </div>


                <!-- Steps List -->
                <div class="animate-fade-in-up space-y-2 opacity-0 md:space-y-3" style="animation-delay: 250ms;">
                    <!-- Step 1 -->
                    <div
                        class="bg-white/8 flex items-center gap-3 rounded-xl border border-white/10 p-3 backdrop-blur-sm md:p-3 lg:p-3.5">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500 text-sm font-bold md:h-8 md:w-8 lg:h-9 lg:w-9 lg:text-base">
                            1</div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold lg:text-base">Buat & Kirim RFQ</p>
                            <p class="mt-0.5 truncate text-xs text-blue-200 md:text-[11px] lg:text-xs">Request for
                                Quotation ke vendor</p>
                        </div>
                        <i class="ph ph-arrow-right text-sm text-blue-300"></i>
                    </div>
                    <!-- Step 2 -->
                    <div
                        class="bg-white/8 flex items-center gap-3 rounded-xl border border-white/10 p-3 backdrop-blur-sm md:p-3 lg:p-3.5">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500 text-sm font-bold md:h-8 md:w-8 lg:h-9 lg:w-9 lg:text-base">
                            2</div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold lg:text-base">Terima Penawaran</p>
                            <p class="mt-0.5 truncate text-xs text-blue-200 md:text-[11px] lg:text-xs">Vendor submit
                                quotation online</p>
                        </div>
                        <i class="ph ph-arrow-right text-sm text-blue-300"></i>
                    </div>
                    <!-- Step 3 -->
                    <div
                        class="bg-white/8 flex items-center gap-3 rounded-xl border border-white/10 p-3 backdrop-blur-sm md:p-3 lg:p-3.5">
                        <div
                            class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500 text-sm font-bold md:h-8 md:w-8 lg:h-9 lg:w-9 lg:text-base">
                            3</div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold lg:text-base">Evaluasi & Setujui PO</p>
                            <p class="mt-0.5 truncate text-xs text-blue-200 md:text-[11px] lg:text-xs">Bandingkan harga,
                                approve Purchase Order</p>
                        </div>
                        <i class="ph ph-arrow-right text-sm text-blue-300"></i>
                    </div>
                </div>
            </div>
        </div>

        <!--RIGHT COLUMN — Login Form -->
        <div
            class="relative flex min-h-0 w-full flex-1 items-center justify-center overflow-hidden bg-slate-50 p-6 sm:p-10 md:min-h-screen md:w-[55%] md:p-12 lg:px-14">

            <!-- Form Card -->
            <div class="animate-fade-in-up relative w-full max-w-[460px] rounded-3xl border border-white/80 bg-white/90 p-6 opacity-0 shadow-[0_15px_50px_rgba(29,78,216,0.08)] backdrop-blur-md sm:p-8 md:p-10"
                style="animation-delay: 350ms;">

                <!-- Heading -->
                <div class="mb-6 pt-0 md:mb-7">
                    <h2 class="mb-2 text-2xl font-bold leading-tight text-gray-900 md:text-[2rem]">
                        Selamat datang
                    </h2>
                    <p class="text-sm text-gray-500 md:text-base">Masuk untuk lanjut ke dashboard</p>
                </div>

                <!-- Error Alert -->
                @if ($errors->any())
                    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-3">
                        @foreach ($errors->all() as $error)
                            <p class="mb-1 flex items-center gap-1.5 text-xs text-red-600 last:mb-0">
                                <i class="ph-fill ph-warning-circle"></i> {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <!-- Form -->
                <form class="md:space-y-4.5 space-y-4" wire:submit="login">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="username" class="mb-1.5 block text-sm font-medium text-gray-700">Username</label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 md:pl-4">
                                <i class="ph ph-envelope text-lg text-gray-400 md:text-xl"></i>
                            </div>
                            <input type="text" wire:model="username"
                                class="h-[44px] w-full rounded-xl border border-gray-200 bg-white/70 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600/20 md:h-[48px] md:pl-11"
                                placeholder="Masukkan username Anda" required autofocus>
                            @error('username')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="mb-1.5">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        </div>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 md:pl-4">
                                <i class="ph ph-lock text-lg text-gray-400 md:text-xl"></i>
                            </div>
                            <input type="password" wire:model="password"
                                class="h-[44px] w-full rounded-xl border border-gray-200 bg-white/70 pl-10 pr-4 text-sm text-gray-900 placeholder-gray-400 transition-colors focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600/20 md:h-[48px] md:pl-11"
                                placeholder="Masukkan password Anda" required>
                        </div>
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="pt-1.5 md:pt-2">
                        <button type="submit"
                            class="flex h-[44px] w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 text-sm font-semibold text-white shadow-md shadow-blue-200 transition-all hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 md:h-[48px] md:text-base">
                            <span wire:loading.remove wire:target="login">Log In</span>
                            <span wire:loading wire:target="login">Memproses...</span>
                        </button>
                    </div>
                </form>

                <!-- Divider -->
                <div class="relative my-4 md:my-5">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-3 text-xs text-gray-400">atau</span>
                    </div>
                </div>

                <!-- Register -->
                <div>
                    <a href="{{ route('registrasi') }}"
                        class="flex h-[44px] w-full items-center justify-center gap-2 rounded-xl border border-blue-600 bg-white/70 text-sm font-semibold text-blue-600 transition-colors hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 md:h-[48px] md:text-base">
                        <i class="ph ph-user-plus text-lg"></i>
                        Daftar Akun Baru
                    </a>
                </div>



            </div>
        </div>
    </div>

    <script>
        // Loading state on submit
        const loginBtn = document.getElementById('loginBtn');
        document.querySelector('form').addEventListener('submit', () => {
            loginBtn.innerHTML = `
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
            </svg>
            Memproses...`;
            loginBtn.disabled = true;
            loginBtn.classList.add('opacity-80', 'cursor-not-allowed');
        });
    </script>
</body>

</html>
