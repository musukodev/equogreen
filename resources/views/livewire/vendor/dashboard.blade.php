<div class="flex-1 flex flex-col h-screen overflow-y-auto w-full">
    <!-- Main Workspace Padding Wrapper -->
    <main class="flex-1 flex flex-col min-w-0 p-4 md:p-6 lg:p-8 pt-0 gap-2 mt-6">

        <!-- Top Header (If not provided by layout) -->
        <header class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger -->
                <button onclick="toggleSidebar()"
                    class="lg:hidden w-10 h-10 flex items-center justify-center rounded-full bg-white border border-gray-200 text-gray-500 hover:bg-primary hover:text-white hover:border-primary transition-all duration-200 shadow-sm flex-shrink-0 group">
                    <img src="/gambar/garis3.png" alt="Menu" class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>
                <div>
                    <h1 class="text-2xl md:text-[36px] font-bold text-[#111827]">Dashboard</h1>
                    <p class="text-gray-400 md:text-gray-500 text-xs md:text-base mt-0.5 md:mt-1">Akses semua quotation
                        Anda dalam satu tempat</p>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="flex items-center gap-3">
                <!-- Notification Bell -->
                <button
                    class="w-12 h-12 flex items-center justify-center bg-[#f0f5ff] rounded-full border border-gray-200 hover:bg-primary hover:border-primary transition-all duration-200 group">
                    <img src="/gambar/bell-black.png" alt="Notifikasi"
                        class="w-6 h-6 object-contain group-hover:brightness-0 group-hover:invert" />
                </button>

                <!-- Profile -->
                <img src="/gambar/profileup.png" alt="Profil"
                    class="w-12 h-12 rounded-full object-cover border-2 border-gray-200 hover:border-primary transition-all duration-200 cursor-pointer" />
                <div class="hidden md:block w-px h-10 bg-gray-200"></div>
                <span class="hidden md:block font-medium text-gray-700 text-[17px]">{{ Auth::user()->vendor->nama_perusahaan ?? 'Vendor' }}</span>
            </div>
        </header>

        <!-- Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5 mb-4 mt-0">
            <!-- Card 1 -->
            <div
                class="bg-white rounded-2xl p-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] flex items-center gap-4 border border-gray-100 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                <div
                    class="w-[52px] h-[52px] rounded-xl bg-[#c5d5ca] flex items-center justify-center text-gray-600 transition-transform group-hover:rotate-3">
                    <i class="fa-solid fa-file-invoice text-2xl opacity-70"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-black leading-tight mb-0.5">{{ count($batches) }}</h3>
                    <p class="text-gray-500 font-medium text-sm">Quotation aktif</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div
                class="bg-white rounded-2xl p-4 shadow-[0_2px_10px_rgba(0,0,0,0.04)] flex items-center gap-4 border border-gray-100 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                <div
                    class="w-[52px] h-[52px] rounded-xl bg-[#fce5be] flex items-center justify-center transition-transform group-hover:rotate-3">
                    <i class="fa-solid fa-hourglass-half text-2xl text-[#d97706] opacity-70"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-black leading-tight mb-0.5">0</h3>
                    <p class="text-gray-500 font-medium text-sm">Menunggu review</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div
                class="bg-white rounded-2xl p-5 shadow-[0_2px_10px_rgba(0,0,0,0.04)] flex items-center gap-5 border border-gray-100 transition-all duration-300 hover:scale-[1.01] hover:shadow-md cursor-pointer group">
                <div
                    class="w-[52px] h-[52px] rounded-xl bg-[#f6b4b4] flex items-center justify-center transition-transform group-hover:rotate-3">
                    <i class="fa-solid fa-circle-check text-2xl text-[#dc2626] opacity-70"></i>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-black leading-tight mb-0.5">0</h3>
                    <p class="text-gray-500 font-medium text-sm">Selesai</p>
                </div>
            </div>
        </div>

        <!-- Pengumuman Card -->
        <div
            class="bg-[#4039c9] rounded-2xl p-6 md:p-7 lg:p-8 mb-4 text-white relative overflow-hidden shadow-lg min-h-[140px] md:min-h-[160px] flex items-center transition-all duration-300 hover:scale-[1.01] hover:shadow-xl cursor-pointer group">
            <div class="relative z-10 w-full md:w-3/4">
                <p
                    class="text-[10px] md:text-[11px] font-black uppercase tracking-widest mb-2 md:mb-3 text-white/70">
                    PENGUMUMAN</p>
                <h2 class="text-lg md:text-2xl lg:text-[30px] font-bold mb-3 md:mb-4 leading-tight tracking-tight">
                    Ketuk untuk melihat
                    Pengumuman<br class="hidden sm:block">Pengadaan Barang hari ini</h2>
                <p class="text-white/80 text-xs md:text-sm lg:text-base font-medium">Pastikan semua dokumen
                    quotation telah
                    dilengkapi sebelum batas waktu</p>
            </div>
            <!-- Decorative Circles -->
            <div
                class="hidden md:block absolute right-[-5%] top-[-10%] w-64 h-64 bg-white/5 rounded-full mix-blend-overlay">
            </div>
            <!-- Banner Icon Area -->
            <div
                class="hidden md:flex absolute right-12 lg:right-20 top-1/2 transform -translate-y-1/2 w-24 h-24 lg:w-32 lg:h-32 bg-[#2d4ddd]/65 rounded-full items-center justify-center">
                <img src="/gambar/pengumuman.png" alt="Banner Icon" class="w-16 h-16 object-contain" />
            </div>
        </div>

        <!-- Daftar Quotation Header -->
        <div class="mb-3 mt-0">
            <div class="inline-flex items-center gap-3 bg-[#d7dfec] px-4 py-2.5 rounded-xl shadow-sm">
                <div class="w-8 h-8 rounded-full border-[1.5px] border-black flex items-center justify-center">
                    <i class="fa-regular fa-file-lines text-black text-sm"></i>
                </div>
                <h2 class="text-lg font-bold text-black pr-2">Daftar Quotation</h2>
            </div>
        </div>

        <!-- Quotation Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5 pb-20">
            @forelse($batches as $batch)
            <!-- Quotation Item -->
            <div
                class="bg-white rounded-2xl overflow-hidden shadow-[0_2px_10px_rgba(0,0,0,0.04)] border border-gray-100 flex flex-col transition-all duration-300 ease-in-out hover:-translate-y-1 hover:scale-[1.01] hover:shadow-xl hover:border-gray-300 cursor-pointer">

                @php
                $colors = [
                ['bg' => '#e4e9e5', 'icon' => '#609966', 'iconClass' => 'fa-pen-nib'],
                ['bg' => '#fbf0dc', 'icon' => '#e5b83b', 'iconClass' => 'fa-couch'],
                ['bg' => '#fbd4d4', 'icon' => '#ce3030', 'iconClass' => 'fa-mobile-screen'],
                ['bg' => '#e0e7ff', 'icon' => '#4338ca', 'iconClass' => 'fa-box-open']
                ];
                $theme = $colors[$loop->index % count($colors)];
                @endphp

                <div class="h-[120px] bg-[{{ $theme['bg'] }}] flex items-center justify-center relative overflow-hidden" style="background-color: {{ $theme['bg'] }};">
                    <i class="fa-solid {{ $theme['iconClass'] }} text-[80px]" style="color: {{ $theme['icon'] }};"></i>
                </div>
                <div class="p-5 flex flex-col flex-grow">
                    <h3 class="text-[15px] font-bold text-black mb-3 leading-tight tracking-tight mt-1">
                        Pengadaan Barang
                    </h3>

                    <div class="bg-[#faebca] border border-[#ecd5a0] rounded-md p-2.5 mb-4 shadow-sm w-full">
                        <p class="text-[9px] font-extrabold text-[#7a5712] mb-0.5 tracking-wider">BATAS WAKTU</p>
                        <p class="text-xs font-bold text-[#7a5712]">{{ \Carbon\Carbon::parse($batch->waktu_selesai)->translatedFormat('d F Y, H.i') }} WIB</p>
                    </div>

                    <p id="timer_{{ $batch->id_batch }}" class="text-[#d71919] font-extrabold text-[11px] mb-5"></p>

                    <a href="{{ route('vendor-buat_quotation', $batch->id_batch) }}" class="mt-auto block w-full bg-[#1e40ff] text-white text-center font-bold text-sm py-3 rounded-lg hover:bg-blue-700 transition" wire:navigate>
                        Buka Quotation
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-white rounded-xl border border-gray-200 p-8 text-center text-gray-500 shadow-sm mt-4">
                <i class="fa-regular fa-folder-open text-4xl mb-3 text-gray-300"></i>
                <p>Belum ada daftar quotation (pengadaan barang) yang tertuju pada Anda.</p>
            </div>
            @endforelse
        </div>

    </main>

    @if(count($batches) > 0)
    <script>
        const timers = [
            @foreach($batches as $batch) {
                id: 'timer_{{ $batch->id_batch }}',
                deadline: '{{ \Carbon\Carbon::parse($batch->waktu_selesai)->format("Y-m-d\TH:i:s") }}'
            },
            @endforeach
        ];

        function updateTimers() {
            const now = new Date();

            timers.forEach(({
                id,
                deadline
            }) => {
                const el = document.getElementById(id);
                if (!el) return;

                const diff = new Date(deadline) - now;

                if (diff <= 0) {
                    el.textContent = 'Waktu habis!';
                    el.classList.remove('text-[#d71919]');
                    el.classList.add('text-gray-400');
                    return;
                }

                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);

                el.textContent = `${d}d : ${h}h : ${m}m : ${s}s`;
            });
        }

        updateTimers();
        setInterval(updateTimers, 1000);
    </script>
    @endif
</div>
