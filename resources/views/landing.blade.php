{{-- Hallmark · pre-emit critique: P4 H4 E4 S4 R5 V5 --}}
{{-- Hallmark · genre: playful · macrostructure: Marquee Hero · theme: Hum · enrichment: none · nav: N5 · footer: Ft5 --}}
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Equogreen — E-Quotation Platform</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            /* Hum tokens — Equogreen blue */
            --color-paper: oklch(97% 0.015 262);
            --color-paper-2: oklch(95% 0.02 262);
            --color-ink: oklch(22% 0.02 260);
            --color-ink-muted: oklch(50% 0.02 260);
            --color-accent: oklch(45% 0.28 262);
            --color-accent-soft: oklch(93% 0.06 262);
            --color-accent-hover: oklch(38% 0.30 262);
            --color-surface: oklch(99% 0.008 262);
            --color-border: oklch(91% 0.02 262);
            --color-focus: oklch(52% 0.26 262);

            /* Type */
            --font-display: 'Plus Jakarta Sans', system-ui, sans-serif;
            --font-body: 'Plus Jakarta Sans', system-ui, sans-serif;

            /* Space (4pt scale) */
            --space-xs: 4px;
            --space-sm: 8px;
            --space-md: 16px;
            --space-lg: 24px;
            --space-xl: 32px;
            --space-2xl: 48px;
            --space-3xl: 64px;
            --space-4xl: 96px;

            /* Type scale */
            --text-xs: 0.75rem;
            --text-sm: 0.875rem;
            --text-base: 1rem;
            --text-lg: 1.125rem;
            --text-xl: 1.25rem;
            --text-2xl: 1.5rem;
            --text-3xl: clamp(1.75rem, 2vw + 1rem, 2.25rem);
            --text-display: clamp(2.25rem, 4vw + 1rem, 3.5rem);

            /* Motion */
            --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
            --ease-in-out: cubic-bezier(0.65, 0, 0.35, 1);
            --dur-fast: 150ms;
            --dur-normal: 250ms;

            /* Radius */
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-pill: 999px;
        }

        html, body {
            overflow-x: clip;
        }

        * {
            font-family: var(--font-body);
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body style="background: var(--color-paper); color: var(--color-ink); margin: 0; -webkit-font-smoothing: antialiased;">

    {{-- ===== N5 FLOATING PILL NAV ===== --}}
    <nav id="floating-nav"
        style="position: fixed; top: var(--space-md); left: 50%; transform: translateX(-50%); z-index: 50;
               width: min(92%, 880px); padding: 10px var(--space-lg);
               background: oklch(99% 0.008 262 / 0.85); backdrop-filter: blur(16px) saturate(1.6);
               border: 1px solid var(--color-border); border-radius: var(--radius-pill);
               display: flex; align-items: center; justify-content: space-between;
               box-shadow: 0 4px 24px oklch(22% 0.02 260 / 0.06);">
        <a href="/" style="display: flex; align-items: center; gap: var(--space-sm); text-decoration: none;">
            <img src="{{ asset('gambar/logo.png') }}" alt="Equogreen" style="height: 36px; width: 36px; border-radius: 50%; object-fit: cover;">
            <span style="font-family: var(--font-display); font-weight: 800; font-size: var(--text-lg); color: var(--color-ink); letter-spacing: -0.02em;">Equogreen</span>
        </a>

        {{-- Desktop links --}}
        <div class="hidden lg:flex" style="align-items: center; gap: var(--space-xl);">
            <a href="#fitur" style="font-size: var(--text-sm); font-weight: 600; color: var(--color-ink-muted); text-decoration: none; transition: color var(--dur-fast) var(--ease-out);"
               onmouseover="this.style.color='var(--color-ink)'" onmouseout="this.style.color='var(--color-ink-muted)'">Fitur</a>
            <a href="#cara-kerja" style="font-size: var(--text-sm); font-weight: 600; color: var(--color-ink-muted); text-decoration: none; transition: color var(--dur-fast) var(--ease-out);"
               onmouseover="this.style.color='var(--color-ink)'" onmouseout="this.style.color='var(--color-ink-muted)'">Cara Kerja</a>
            <a href="{{ route('registrasi') }}" style="font-size: var(--text-sm); font-weight: 600; color: var(--color-ink-muted); text-decoration: none; transition: color var(--dur-fast) var(--ease-out);"
               onmouseover="this.style.color='var(--color-ink)'" onmouseout="this.style.color='var(--color-ink-muted)'">Registrasi Vendor</a>
        </div>

        <div style="display: flex; align-items: center; gap: var(--space-sm);">
            <a href="{{ route('login') }}"
               style="display: inline-flex; align-items: center; justify-content: center;
                      padding: 10px var(--space-lg); border-radius: var(--radius-pill);
                      background: var(--color-accent); color: white;
                      font-size: var(--text-sm); font-weight: 700; text-decoration: none;
                      transition: background var(--dur-fast) var(--ease-out), transform var(--dur-fast) var(--ease-out);"
               onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='translateY(-1px)'"
               onmouseout="this.style.background='var(--color-accent)'; this.style.transform='translateY(0)'">
                Masuk
            </a>

            {{-- Mobile hamburger --}}
            <button id="menu-btn" type="button" class="lg:hidden"
                    style="display: flex; align-items: center; justify-content: center;
                           width: 40px; height: 40px; border-radius: var(--radius-sm);
                           border: 1px solid var(--color-border); background: transparent; cursor: pointer;"
                    aria-expanded="false" aria-label="Buka menu">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
        </div>
    </nav>

    {{-- Mobile dropdown --}}
    <div id="mobile-menu" class="lg:hidden"
         style="display: none; position: fixed; top: 72px; left: 50%; transform: translateX(-50%); z-index: 49;
                width: min(92%, 880px); padding: var(--space-md);
                background: var(--color-surface); border: 1px solid var(--color-border);
                border-radius: var(--radius-md);
                box-shadow: 0 8px 32px oklch(22% 0.02 260 / 0.1);">
        <div style="display: flex; flex-direction: column; gap: var(--space-xs);">
            <a href="#fitur" style="display: block; padding: var(--space-sm) var(--space-md); border-radius: var(--radius-sm); font-size: var(--text-sm); font-weight: 600; color: var(--color-ink); text-decoration: none;">Fitur</a>
            <a href="#cara-kerja" style="display: block; padding: var(--space-sm) var(--space-md); border-radius: var(--radius-sm); font-size: var(--text-sm); font-weight: 600; color: var(--color-ink); text-decoration: none;">Cara Kerja</a>
            <a href="{{ route('registrasi') }}" style="display: block; padding: var(--space-sm) var(--space-md); border-radius: var(--radius-sm); font-size: var(--text-sm); font-weight: 600; color: var(--color-ink); text-decoration: none;">Registrasi Vendor</a>
        </div>
    </div>

    <main>
        {{-- ===== MARQUEE HERO ===== --}}
        <section style="min-height: 100vh; min-height: 100dvh; display: flex; align-items: center;
                        padding: calc(var(--space-4xl) + 40px) clamp(1rem, 5vw, 3rem) var(--space-3xl);">
            <div style="max-width: 1120px; margin: 0 auto; width: 100%;
                        display: grid; grid-template-columns: 1fr; gap: var(--space-2xl); align-items: center;"
                 class="lg:!grid-cols-[1.2fr_1fr]">
                {{-- Text --}}
                <div style="display: flex; flex-direction: column; gap: var(--space-lg);">
                    <span style="display: inline-flex; align-items: center; gap: var(--space-sm);
                                 background: var(--color-accent-soft); color: var(--color-accent);
                                 padding: 6px var(--space-md); border-radius: var(--radius-pill);
                                 font-size: var(--text-xs); font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase;
                                 width: fit-content;">
                        E-Quotation Platform
                    </span>

                    <h1 style="font-family: var(--font-display); font-size: var(--text-display); font-weight: 800;
                               line-height: 1.1; letter-spacing: -0.03em; color: var(--color-ink);
                               margin: 0; overflow-wrap: anywhere; min-width: 0;">
                        Kelola quotation dan vendor dalam satu platform
                    </h1>

                    <p style="font-size: var(--text-lg); line-height: 1.7; color: var(--color-ink-muted);
                              max-width: 520px; margin: 0;">
                        Equogreen mempermudah proses pengadaan barang. Kirim RFQ, terima penawaran, evaluasi harga, dan setujui purchase order — semua digital.
                    </p>

                    <div style="display: flex; flex-wrap: wrap; gap: var(--space-md); padding-top: var(--space-sm);">
                        <a href="{{ route('login') }}"
                           style="display: inline-flex; align-items: center; justify-content: center;
                                  padding: 14px var(--space-xl); border-radius: var(--radius-pill);
                                  background: var(--color-accent); color: white;
                                  font-size: var(--text-base); font-weight: 700; text-decoration: none;
                                  transition: background var(--dur-fast) var(--ease-out), transform var(--dur-fast) var(--ease-out);
                                  box-shadow: 0 4px 16px oklch(45% 0.28 262 / 0.25);"
                           onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='translateY(-2px)'"
                           onmouseout="this.style.background='var(--color-accent)'; this.style.transform='translateY(0)'">
                            Mulai Sekarang
                        </a>
                        <a href="{{ route('registrasi') }}"
                           style="display: inline-flex; align-items: center; justify-content: center;
                                  padding: 14px var(--space-xl); border-radius: var(--radius-pill);
                                  background: transparent; color: var(--color-accent);
                                  border: 1.5px solid var(--color-accent);
                                  font-size: var(--text-base); font-weight: 700; text-decoration: none;
                                  transition: background var(--dur-fast) var(--ease-out), transform var(--dur-fast) var(--ease-out);"
                           onmouseover="this.style.background='var(--color-accent-soft)'; this.style.transform='translateY(-1px)'"
                           onmouseout="this.style.background='transparent'; this.style.transform='translateY(0)'">
                            Daftar sebagai Vendor
                        </a>
                    </div>
                </div>

                {{-- Illustration --}}
                <div style="display: flex; justify-content: center;" class="hidden lg:!flex">
                    <img src="{{ asset('gambar/main-biru.png') }}" alt="Ilustrasi dashboard Equogreen"
                         style="width: 100%; max-width: 440px; height: auto; object-fit: contain;">
                </div>
            </div>
        </section>

        {{-- ===== FEATURES (3 compact cards) ===== --}}
        <section id="fitur" style="padding: var(--space-4xl) clamp(1rem, 5vw, 3rem); background: var(--color-paper-2);">
            <div style="max-width: 1120px; margin: 0 auto;">
                <div style="text-align: center; margin-bottom: var(--space-3xl); max-width: 560px; margin-left: auto; margin-right: auto;">
                    <h2 style="font-family: var(--font-display); font-size: var(--text-3xl); font-weight: 800;
                               line-height: 1.2; letter-spacing: -0.02em; color: var(--color-ink); margin: 0 0 var(--space-md);">
                        Fitur yang mempermudah pekerjaan anda
                    </h2>
                    <p style="font-size: var(--text-base); line-height: 1.7; color: var(--color-ink-muted); margin: 0;">
                        Dirancang untuk procurement dan vendor yang menghargai efisiensi.
                    </p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr)); gap: var(--space-lg);">
                    {{-- Card 1 --}}
                    <div style="background: var(--color-surface); border: 1px solid var(--color-border);
                                border-radius: var(--radius-md); padding: var(--space-xl);
                                transition: transform var(--dur-normal) var(--ease-out), box-shadow var(--dur-normal) var(--ease-out);"
                         onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px oklch(22% 0.02 260 / 0.08)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="width: 44px; height: 44px; border-radius: var(--radius-sm);
                                    background: var(--color-accent-soft); display: flex; align-items: center; justify-content: center;
                                    margin-bottom: var(--space-md);">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="var(--color-accent)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-lg); font-weight: 700;
                                   color: var(--color-ink); margin: 0 0 var(--space-sm);">Aman dan Terpercaya</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0;">
                            Keamanan data menjadi prioritas. Setiap transaksi terlindungi dan sistem dapat diandalkan.</p>
                    </div>

                    {{-- Card 2 --}}
                    <div style="background: var(--color-surface); border: 1px solid var(--color-border);
                                border-radius: var(--radius-md); padding: var(--space-xl);
                                transition: transform var(--dur-normal) var(--ease-out), box-shadow var(--dur-normal) var(--ease-out);"
                         onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px oklch(22% 0.02 260 / 0.08)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="width: 44px; height: 44px; border-radius: var(--radius-sm);
                                    background: var(--color-accent-soft); display: flex; align-items: center; justify-content: center;
                                    margin-bottom: var(--space-md);">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="var(--color-accent)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-lg); font-weight: 700;
                                   color: var(--color-ink); margin: 0 0 var(--space-sm);">Proses Lebih Cepat</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0;">
                            Buat, kirim, dan kelola quotation dengan efisien. Tidak perlu lagi bolak-balik dokumen fisik.</p>
                    </div>

                    {{-- Card 3 --}}
                    <div style="background: var(--color-surface); border: 1px solid var(--color-border);
                                border-radius: var(--radius-md); padding: var(--space-xl);
                                transition: transform var(--dur-normal) var(--ease-out), box-shadow var(--dur-normal) var(--ease-out);"
                         onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 24px oklch(22% 0.02 260 / 0.08)'"
                         onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        <div style="width: 44px; height: 44px; border-radius: var(--radius-sm);
                                    background: var(--color-accent-soft); display: flex; align-items: center; justify-content: center;
                                    margin-bottom: var(--space-md);">
                            <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="var(--color-accent)" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        </div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-lg); font-weight: 700;
                                   color: var(--color-ink); margin: 0 0 var(--space-sm);">Notifikasi Real-time</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0;">
                            Pemberitahuan langsung saat ada penawaran baru, perubahan status, atau tindakan yang diperlukan.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== HOW IT WORKS (Step sequence) ===== --}}
        <section id="cara-kerja" style="padding: var(--space-4xl) clamp(1rem, 5vw, 3rem);">
            <div style="max-width: 1120px; margin: 0 auto;">
                <div style="text-align: center; margin-bottom: var(--space-3xl); max-width: 520px; margin-left: auto; margin-right: auto;">
                    <h2 style="font-family: var(--font-display); font-size: var(--text-3xl); font-weight: 800;
                               line-height: 1.2; letter-spacing: -0.02em; color: var(--color-ink); margin: 0 0 var(--space-md);">
                        Buat quotation dalam hitungan menit
                    </h2>
                    <p style="font-size: var(--text-base); line-height: 1.7; color: var(--color-ink-muted); margin: 0;">
                        Empat langkah sederhana untuk memulai proses quotation digital.
                    </p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(220px, 100%), 1fr)); gap: var(--space-xl);">
                    {{-- Step 1 --}}
                    <div style="text-align: center; display: flex; flex-direction: column; align-items: center; gap: var(--space-md);">
                        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--color-accent);
                                    display: flex; align-items: center; justify-content: center;
                                    font-family: var(--font-display); font-size: var(--text-xl); font-weight: 800; color: white;">1</div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-base); font-weight: 700; color: var(--color-ink); margin: 0;">Unduh Template</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0; max-width: 200px;">
                            Download template quotation yang telah disediakan.</p>
                    </div>
                    {{-- Step 2 --}}
                    <div style="text-align: center; display: flex; flex-direction: column; align-items: center; gap: var(--space-md);">
                        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--color-accent);
                                    display: flex; align-items: center; justify-content: center;
                                    font-family: var(--font-display); font-size: var(--text-xl); font-weight: 800; color: white;">2</div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-base); font-weight: 700; color: var(--color-ink); margin: 0;">Isi Data</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0; max-width: 200px;">
                            Lengkapi informasi harga, kuantitas, dan deskripsi barang.</p>
                    </div>
                    {{-- Step 3 --}}
                    <div style="text-align: center; display: flex; flex-direction: column; align-items: center; gap: var(--space-md);">
                        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--color-accent);
                                    display: flex; align-items: center; justify-content: center;
                                    font-family: var(--font-display); font-size: var(--text-xl); font-weight: 800; color: white;">3</div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-base); font-weight: 700; color: var(--color-ink); margin: 0;">Kirim Penawaran</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0; max-width: 200px;">
                            Upload dan kirim quotation ke procurement dengan sekali klik.</p>
                    </div>
                    {{-- Step 4 --}}
                    <div style="text-align: center; display: flex; flex-direction: column; align-items: center; gap: var(--space-md);">
                        <div style="width: 56px; height: 56px; border-radius: 50%; background: var(--color-accent);
                                    display: flex; align-items: center; justify-content: center;
                                    font-family: var(--font-display); font-size: var(--text-xl); font-weight: 800; color: white;">4</div>
                        <h3 style="font-family: var(--font-display); font-size: var(--text-base); font-weight: 700; color: var(--color-ink); margin: 0;">Kelola dan Pantau</h3>
                        <p style="font-size: var(--text-sm); line-height: 1.65; color: var(--color-ink-muted); margin: 0; max-width: 200px;">
                            Pantau status penawaran dan kelola purchase order dengan mudah.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== TESTIMONIALS ===== --}}
        <section style="padding: var(--space-4xl) clamp(1rem, 5vw, 3rem); background: var(--color-paper-2);">
            <div style="max-width: 1120px; margin: 0 auto;">
                <div style="text-align: center; margin-bottom: var(--space-3xl); max-width: 520px; margin-left: auto; margin-right: auto;">
                    <h2 style="font-family: var(--font-display); font-size: var(--text-3xl); font-weight: 800;
                               line-height: 1.2; letter-spacing: -0.02em; color: var(--color-ink); margin: 0 0 var(--space-md);">
                        Apa kata pengguna kami
                    </h2>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr)); gap: var(--space-lg);">
                    {{-- Testimonial 1 --}}
                    <div style="background: var(--color-surface); border: 1px solid var(--color-border);
                                border-radius: var(--radius-md); padding: var(--space-xl);
                                display: flex; flex-direction: column; justify-content: space-between; gap: var(--space-lg);">
                        <p style="font-size: var(--text-base); line-height: 1.7; color: var(--color-ink); margin: 0;">
                            "Equogreen sangat membantu tim kami dalam membuat quotation lebih cepat dan rapi. Sistemnya mudah digunakan dan fiturnya lengkap."
                        </p>
                        <div style="display: flex; align-items: center; gap: var(--space-md);">
                            <img src="{{ asset('gambar/pengguna.png') }}" alt=""
                                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; background: var(--color-border);">
                            <div>
                                <div style="font-weight: 700; font-size: var(--text-sm); color: var(--color-ink);">Achel Silitonga</div>
                                <div style="font-size: var(--text-xs); color: var(--color-ink-muted);">Manager Umum, PT Jongsong Park</div>
                            </div>
                        </div>
                    </div>
                    {{-- Testimonial 2 --}}
                    <div style="background: var(--color-surface); border: 1px solid var(--color-border);
                                border-radius: var(--radius-md); padding: var(--space-xl);
                                display: flex; flex-direction: column; justify-content: space-between; gap: var(--space-lg);">
                        <p style="font-size: var(--text-base); line-height: 1.7; color: var(--color-ink); margin: 0;">
                            "Proses pengadaan yang dulunya memakan waktu berhari-hari, sekarang bisa selesai dalam hitungan jam berkat Equogreen."
                        </p>
                        <div style="display: flex; align-items: center; gap: var(--space-md);">
                            <img src="{{ asset('gambar/pengguna.png') }}" alt=""
                                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; background: var(--color-border);">
                            <div>
                                <div style="font-weight: 700; font-size: var(--text-sm); color: var(--color-ink);">Rina Marlina</div>
                                <div style="font-size: var(--text-xs); color: var(--color-ink-muted);">Procurement Lead, PT Samudera Jaya</div>
                            </div>
                        </div>
                    </div>
                    {{-- Testimonial 3 --}}
                    <div style="background: var(--color-surface); border: 1px solid var(--color-border);
                                border-radius: var(--radius-md); padding: var(--space-xl);
                                display: flex; flex-direction: column; justify-content: space-between; gap: var(--space-lg);">
                        <p style="font-size: var(--text-base); line-height: 1.7; color: var(--color-ink); margin: 0;">
                            "Notifikasi real-time membuat kami tidak pernah melewatkan deadline penawaran. Sangat membantu operasional sehari-hari."
                        </p>
                        <div style="display: flex; align-items: center; gap: var(--space-md);">
                            <img src="{{ asset('gambar/pengguna.png') }}" alt=""
                                 style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; background: var(--color-border);">
                            <div>
                                <div style="font-weight: 700; font-size: var(--text-sm); color: var(--color-ink);">Budi Hartono</div>
                                <div style="font-size: var(--text-xs); color: var(--color-ink-muted);">Supply Chain Manager, PT Nusantara Kimia</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===== CTA SECTION ===== --}}
        <section style="padding: var(--space-4xl) clamp(1rem, 5vw, 3rem);">
            <div style="max-width: 720px; margin: 0 auto; text-align: center;
                        display: flex; flex-direction: column; align-items: center; gap: var(--space-lg);">
                <h2 style="font-family: var(--font-display); font-size: var(--text-3xl); font-weight: 800;
                           line-height: 1.2; letter-spacing: -0.02em; color: var(--color-ink); margin: 0;">
                    Siap mendigitalkan proses pengadaan anda?
                </h2>
                <p style="font-size: var(--text-base); line-height: 1.7; color: var(--color-ink-muted); margin: 0; max-width: 480px;">
                    Bergabung dengan Equogreen dan mulai kelola quotation serta vendor dalam satu platform terpadu.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: var(--space-md); justify-content: center; padding-top: var(--space-sm);">
                    <a href="{{ route('login') }}"
                       style="display: inline-flex; align-items: center; justify-content: center;
                              padding: 14px var(--space-xl); border-radius: var(--radius-pill);
                              background: var(--color-accent); color: white;
                              font-size: var(--text-base); font-weight: 700; text-decoration: none;
                              transition: background var(--dur-fast) var(--ease-out), transform var(--dur-fast) var(--ease-out);
                              box-shadow: 0 4px 16px oklch(45% 0.28 262 / 0.25);"
                       onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='translateY(-2px)'"
                       onmouseout="this.style.background='var(--color-accent)'; this.style.transform='translateY(0)'">
                        Masuk ke Platform
                    </a>
                    <a href="{{ route('registrasi') }}"
                       style="display: inline-flex; align-items: center; justify-content: center;
                              padding: 14px var(--space-xl); border-radius: var(--radius-pill);
                              background: transparent; color: var(--color-accent);
                              border: 1.5px solid var(--color-accent);
                              font-size: var(--text-base); font-weight: 700; text-decoration: none;
                              transition: background var(--dur-fast) var(--ease-out);"
                       onmouseover="this.style.background='var(--color-accent-soft)'"
                       onmouseout="this.style.background='transparent'">
                        Daftar sebagai Vendor
                    </a>
                </div>
            </div>
        </section>
    </main>

    {{-- ===== Ft5 STATEMENT FOOTER ===== --}}
    <footer style="background: var(--color-ink); padding: var(--space-3xl) clamp(1rem, 5vw, 3rem) var(--space-xl);">
        <div style="max-width: 1120px; margin: 0 auto;">
            <p style="font-family: var(--font-display); font-size: var(--text-2xl); font-weight: 700;
                      line-height: 1.3; color: white; margin: 0 0 var(--space-3xl); max-width: 28ch;">
                Platform quotation terpercaya milik Ecogreen.
            </p>

            <div style="border-top: 1px solid oklch(40% 0.02 260); padding-top: var(--space-lg);
                        display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: var(--space-md);">
                <div style="display: flex; align-items: center; gap: var(--space-sm);">
                    <img src="{{ asset('gambar/logo.png') }}" alt="" style="height: 28px; width: 28px; border-radius: 50%; object-fit: cover; filter: brightness(1.2);">
                    <span style="font-weight: 700; font-size: var(--text-sm); color: oklch(70% 0.01 260);">Equogreen</span>
                </div>
                <div style="display: flex; flex-wrap: wrap; gap: var(--space-lg);">
                    <a href="#fitur" style="font-size: var(--text-xs); color: oklch(60% 0.01 260); text-decoration: none;">Fitur</a>
                    <a href="#cara-kerja" style="font-size: var(--text-xs); color: oklch(60% 0.01 260); text-decoration: none;">Cara Kerja</a>
                    <a href="{{ route('registrasi') }}" style="font-size: var(--text-xs); color: oklch(60% 0.01 260); text-decoration: none;">Registrasi</a>
                </div>
                <p style="font-size: var(--text-xs); color: oklch(45% 0.01 260); margin: 0; width: 100%;">
                    &copy; {{ date('Y') }} Equogreen. Hak cipta dilindungi.
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.getElementById('menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    const isOpen = mobileMenu.style.display !== 'none';
                    mobileMenu.style.display = isOpen ? 'none' : 'block';
                    menuBtn.setAttribute('aria-expanded', !isOpen);
                });
                // Close on link click
                mobileMenu.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        mobileMenu.style.display = 'none';
                        menuBtn.setAttribute('aria-expanded', 'false');
                    });
                });
            }
        });
    </script>

    {{-- Responsive overrides via Tailwind utility classes --}}
    <style>
        @media (min-width: 1024px) {
            .lg\:\!grid-cols-\[1\.2fr_1fr\] { grid-template-columns: 1.2fr 1fr !important; }
            .lg\:\!flex { display: flex !important; }
        }
    </style>
</body>

</html>
